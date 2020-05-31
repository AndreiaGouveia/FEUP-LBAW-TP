<?php

namespace App\Http\Controllers;

use Flash;
use App\Commentable_publication;
use App\Publication;
use App\Question;
use App\TagQuestion;
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

        if ($question == null)
            abort(404);

        $publication = Publication::find($id);

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

        try {
            DB::beginTransaction();


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

            if (array_key_exists('tags', $inputs)) {
                foreach ($inputs['tags'] as &$value) {

                    TagQuestion::create([
                        'id_tag' => $value,
                        'id_question' => $commentable_publication->id_publication
                    ]);
                }
            }

            DB::commit();
            Flash::success('Question added successfully.');

            return redirect()->route('show.question', ['id' => $question->id_commentable_publication]);
        } catch (\Exception $e) {

            DB::rollBack();

            ErrorFile::outputToFile($e->getMessage(), date('Y-m-d H:i:s'));

            Flash::error('Error adding question!');
            return redirect()->route('add.questions');
        }
    }
}
