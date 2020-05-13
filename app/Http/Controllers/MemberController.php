<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Location;
use App\Member;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getActivity($id)
    {
        $member = Member::find($id);

        if ($member == null)
            return;

        $info = array(); //info to be sent

        $questions = DB::table('question')
            ->join('commentable_publication', 'commentable_publication.id_publication', '=', 'question.id_commentable_publication')
            ->join('publication', 'publication.id', '=', 'commentable_publication.id_publication')
            ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
            ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
            ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
            ->where('publication.id_owner', '=', $id)
            ->groupBy('question.id_commentable_publication', 'publication.id', 'publication.date', 'publication.description', 'question.title')
            ->orderBy('publication.id')
            ->get(array('question.id_commentable_publication','publication.id', 'publication.date', 'publication.description', 'question.title', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes')));

        foreach ($questions as $question) {
            $question->type = 'question';
        }

        $member->questions = count($questions);

        $comments = DB::table('comment')
            ->join('publication', 'publication.id', '=', 'comment.id_publication')
            ->where('publication.id_owner', '=', $id)
            ->groupBy('publication.id', 'publication.date', 'comment.id_publication')
            ->orderBy('publication.id')
            ->get(array('publication.date', 'publication.description', 'comment.id_commentable_publication'));

        foreach ($comments as $comment) {
            $temp = array();
            $temp = DB::table('response')
                ->join('question', 'question.id_commentable_publication', '=', 'response.id_question')
                ->where('response.id_commentable_publication', '=', $comment->id_commentable_publication)
                ->get(array('question.title', 'question.id_commentable_publication'));
            $comment->type = 'commentreply';

            if (empty($temp[0])) {
                $temp = DB::table('question')
                    ->where('question.id_commentable_publication', '=', $comment->id_commentable_publication)
                    ->get(array('question.title', 'question.id_commentable_publication'));
                $comment->type = 'comment';
            }

            $comment->commentable_publication = $temp->toArray()[0]->title;
            $comment->id_commentable_publication = $temp->toArray()[0]->id_commentable_publication;
        }

        $member->comments = count($comments);

        $replies = DB::table('response')
            ->join('question', 'question.id_commentable_publication', '=', 'response.id_question')
            ->join('commentable_publication', 'commentable_publication.id_publication', '=', 'response.id_commentable_publication')
            ->join('publication', 'publication.id', '=', 'commentable_publication.id_publication')
            ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'response.id_commentable_publication')
            ->where('publication.id_owner', '=', $id)
            ->groupBy('publication.id', 'response.id_question', 'question.id_commentable_publication', 'publication.date', 'publication.description', 'question.title')
            ->orderBy('publication.id')
            ->get(array('publication.id', 'publication.date', 'publication.description', 'response.id_question','question.id_commentable_publication', 'question.title', DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes')));

        foreach ($replies as $rep) {
            $rep->type = 'reply';
        }


        $member->reply = count($replies);

        $info = array_merge($comments->toArray(), $questions->toArray(), $replies->toArray());

        usort($info, array($this, 'date'));
        return $info;
    }

    public function favorites($id)
    {
        $favorites = DB::table('favorite')
            ->where('favorite.id_member', '=', $id)
            ->get('favorite.id_commentable_publication');


        $info = array();

        foreach ($favorites as $favorite) {
            array_push($info, $favorite->id_commentable_publication);
        }

        $questions = DB::table('question')
            ->select('person.id as memberId', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
            ->whereIn('publication.id', $info)
            ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
            ->join('person', 'publication.id_owner', '=', 'person.id')
            ->join('member', 'person.id', '=', 'member.id_person')
            ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
            ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
            ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
            ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
            ->groupBy('person.id', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
            ->orderBy('likes', 'desc')
            ->orderBy('dislikes', 'desc')
            ->get();

        $replies = DB::table('response')
            ->select('response.id_commentable_publication', 'response.id_question', 'person.id as memberId', 'photo.url', 'member.name', 'photo.url', 'publication.date', 'publication.description', DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
            ->whereIn('publication.id', $info)
            ->join('publication', 'publication.id', '=', 'response.id_commentable_publication')
            ->join('person', 'publication.id_owner', '=', 'person.id')
            ->join('member', 'person.id', '=', 'member.id_person')
            ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
            ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'response.id_commentable_publication')
            ->groupBy('response.id_commentable_publication', 'response.id_question', 'person.id', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'publication.description')
            ->orderBy('likes', 'desc')
            ->orderBy('dislikes', 'desc')
            ->get();

        foreach ($replies as $reply) {
            $temp = array();
            $temp = DB::table('question')
                ->select('question.title')
                ->where('question.id_commentable_publication', '=', $reply->id_question)
                ->get();

                $reply->title = $temp->toArray()[0]->title;
        }

        return view('pages.favorites',  ['responses' => $replies, 'questions' => $questions, 'favorites' => $info]);
    }


    public function content($id)
    {
        $member = Member::find($id);

        if ($member == null)
            return;

        $info = MemberController::getActivity($id);

        return view('pages.content',  ['member' => $member, 'info' => $info]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);

        if ($member == null)
            return;

        $info = MemberController::getActivity($id);

        return view('pages.profile',  ['member' => $member, 'info' => $info]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check())
            return redirect()->route('login');

        $member = Member::find($id);
        $person = Person::find($id);

        $this->authorize('update', $member);

        return view('pages.settings', ['member' => $member, 'person' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check())
            return redirect()->route('login');

        $member = Member::find($id);
        $person = Person::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            Rule::unique('person')->ignore($id, 'id')
        ]);

        $this->authorize('update', $member);

        $inputs = $request->all();
        $member->name = $inputs['name'];
        $member->biography = $inputs['biography'];
        $person->email = $inputs['email'];

        if ($inputs['location'] > 0)
            $member->id_location = $inputs['location'];
        else
            $member->id_location = null;

        $member->save();
        $person->save();


        return redirect()->route('members', $id);

        //TODO: location and profile image
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $member = Member::find($id);
        $person = Person::find($id);

        $validatedData = $request->validate([
            'old_password' => [function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('A palavra-passe está errada!');
                }
            }],
            'password' => 'required|string|min:6|confirmed'
        ]);

        $inputs = $request->all();

        $this->authorize('delete', $member);

        $person->password =  Hash::make($inputs['password']);

        $person->save();

        return redirect()->route('members', $id);
    }

    /**
     * Deactivate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id)
    {
        $member = Member::find($id);
        $person = Person::find($id);

        $this->authorize('delete', $member);

        $person->visible = false;

        return redirect()->route('logout');
    }

    public function date($a, $b)
    {
        return ($a->date > $b->date) ? -1 : 1;
    }
}
