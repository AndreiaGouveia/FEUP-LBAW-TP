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

        $info = array();

        $info = array_merge($member->questions->toArray(),$member->answers->toArray(), $member->comments->toArray());
        var_dump($member);

        //usort($info, array($this, 'date'));
        return $info;
    }

    public function favorites($id)
    {
        $member = Member::find($id);

        //TODO: change this to a proper error
        if ($member == null)
            return;

        return view('pages.favorites',  ['answers' => $member->favoriteAnswers, 'questions' => $member->favoriteQuestions]);
    }


    public function content($id)
    {
        $member = Member::find($id);

        //TODO: change this to a proper error
        if ($member == null)
            return;

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

        //TODO: change this to a proper error
        if ($member == null)
            return;

        $info = MemberController::getActivity($id);

        //var_dump($info);

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
        return ($a->publication->date > $b->publication->date) ? -1 : 1;
    }
}
