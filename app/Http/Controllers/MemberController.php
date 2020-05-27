<?php

namespace App\Http\Controllers;
use App\Member;
use App\Person;
use App\Photo;
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

        $info = array();
        $questions = $member->questions;
        $answers = $member->answers;
        $comments = $member->comments;

        /*var_dump(count($questions->toArray()));
        var_dump(count($answers->toArray()));
        var_dump(count($comments->toArray()));*/

        $merge = $questions->merge($answers);
        $final_merge = $comments->merge($merge);
        $info = $final_merge->all();

        usort($info, array($this, 'date'));
        return $final_merge;
    }

    public function favorites($id)
    {
        $member = Member::find($id);

        $this->authorize('favorites', $member);

        return view('pages.favorites',  ['answers' => $member->favoriteAnswers, 'questions' => $member->favoriteQuestions]);
    }


    public function content($id)
    {
        $member = Member::find($id);

        $this->authorize('content', $member);

        return view('pages.content',  ['questions' => $member->questions, 'answers' => $member->answers, 'comments' => $member->comments]);
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

        if ($member == null || !$member->person->visible)
            abort(403, 'Access denied');

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

        if ($request->hasFile('photo')) {
            
            $path = $request->file('photo')->storeAs(
                'public/images', $id . "." . $request->file('photo')->extension()
            );

            $photo = Photo::create(['url' => "images/" . $id . ".". $request->file('photo')->extension()]);

            $member->id_photo = $photo->id;
        }

        $member->save();
        $person->save();

        return redirect()->route('members', $id);
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

        $this->authorize('activate', $member);

        $person->visible = false;
        $person->save();

        return redirect()->route('logout');
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_activate($id)
    {

        $member = Member::find($id);
        $this->authorize('activate', $member);

        return view('pages.activate_account', ['id' => $id]);
    }

    /**
     * Activate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $member = Member::find($id);
        $person = Person::find($id);

        $this->authorize('delete', $member);

        $person->visible = true;
        $person->save();

        return redirect()->route('home');
    }

    public function date($a, $b)
    {
        return ($a->publication->date > $b->publication->date) ? -1 : 1;
    }
}
