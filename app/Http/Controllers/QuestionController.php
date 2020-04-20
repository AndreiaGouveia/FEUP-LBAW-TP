<?php

namespace App\Http\Controllers;

use App\Commentable_publication;
use App\Publication;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function create()
    {
        if(!Auth::check())
            return redirect()->route('login');

        return view('pages.add_question');
    }

    public function store(Request $request)
    {
        if(!Auth::check())
            return redirect()->route('login');

        $user = Auth::user();

        $inputs = $request->all();
        $publication = Publication::create([
            'description' => $inputs['description'],
            'id_owner' => $user->id
        ]);

        $commentable_publication = Commentable_publication::create([
            'id_publication' => $publication->id
        ]);

        $question = Question::create([
            'id_commentable_publication' => $commentable_publication->id_publication,
            'title' => $inputs['title']
        ]);

        return redirect()->route('home');;
    }
}
