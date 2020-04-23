<?php

namespace App\Http\Controllers;

use Flash;
use App\Commentable_publication;
use App\Publication;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $question = Question::find($id);
        $publication = Publication::find($id);

        //$this->authorize('view', Person::class, $question);

        return view('pages.question',  ['question' => $question, 'publication' => $publication]);
    }

    public function create()
    {
        return view('pages.add_question');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $inputs = $request->all();

        DB::beginTransaction();

        $publication = Publication::create([
            'description' => $inputs['description'],
            'id_owner' => $user->id
        ]);

        if ($publication == null) {
            Flash::error('Error adding question!');
            DB::rollBack();
            return redirect()->route('add.questions');
        }

        $commentable_publication = Commentable_publication::create([
            'id_publication' => $publication->id
        ]);

        if ($commentable_publication == null) {
            Flash::error('Error adding question!');
            DB::rollBack();
            return redirect()->route('add.questions');
        }

        $question = Question::create([
            'id_commentable_publication' => $commentable_publication->id_publication,
            'title' => $inputs['title']
        ]);

        if ($question == null) {
            Flash::error('Error adding question!');
            DB::rollBack();
            return redirect()->route('add.questions');
        }

        DB::commit();
        Flash::success('Question added successfully.');

        return redirect()->route('show.question', ['id' => $question->id_commentable_publication]);
    }
}
