<?php

namespace App\Http\Controllers;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $member = Member::find($id);

        $info = array();//info to be sent

        $questions = DB::table('question')
                    ->join('commentable_publication','commentable_publication.id_publication','=','question.id_commentable_publication')
                    ->join('publication','publication.id','=','commentable_publication.id_publication')
                    ->orderBy('publication.date')
                    ->get(array('publication.date','publication.description','question.title'));
        foreach($questions as $question){
            $question->type='question';
        }

        $comments = DB::table('comment')
                    ->join('commentable_publication','commentable_publication.id_publication','=','comment.id_commentable_publication')
                    ->join('publication','publication.id','=','comment.id_publication')
                    ->orderBy('publication.date')
                    ->get(array('publication.date','publication.description','comment.id_commentable_publication'));


        foreach($comments as $comment){
                $temp = array();
                $temp = DB::table('response')
                ->select('question.title')
                ->join('question','question.id_commentable_publication','=','response.id_question')
                ->where('response.id_commentable_publication' , '=' , $comment->id_commentable_publication)
                ->get();
                $comment->type ='comment';

                if(empty($temp[0])){
                    $temp = DB::table('question')
                    ->where('question.id_commentable_publication' , '=' , $comment->id_commentable_publication)
                    ->get('question.title');
                    $comment->type ='commentreply';
                }

                $comment->id_commentable_publication = $temp->toArray()[0]->title;

        }

        $reply = DB::table('response')
                    ->join('question','question.id_commentable_publication','=','response.id_question')
                    ->join('commentable_publication','commentable_publication.id_publication','=','response.id_commentable_publication')
                    ->join('publication','publication.id','=','commentable_publication.id_publication')
                    ->orderBy('publication.date')
                    ->get(array('publication.date','publication.description','question.title'));

        foreach($reply as $rep){
            $rep->type='reply';
        }

        $info = array_merge($comments->toArray() , $questions->toArray() , $reply->toArray());

         usort($info, array($this , 'date'));

        return view('pages.profile',  ['member' => $member , 'info' => $info]);
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

    public function date($a,$b)
    {
        return ($a->date > $b->date) ? -1 : 1;
    }
}
