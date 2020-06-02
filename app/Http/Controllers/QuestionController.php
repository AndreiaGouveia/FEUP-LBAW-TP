<?php

namespace App\Http\Controllers;

use Flash;
use App\Commentable_publication;
use App\Publication;
use App\Question;
use App\TagQuestion;
use App\Tag;
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

        $search_results =  DB::table('question')
        ->select('question.title', 'publication.id')
        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
        ->where("publication.visible", "=", "true")
        ->where("publication.id", "!=", $id)
        ->take(10)
        ->get();

        if(!$publication->visible)
            abort(404);

            
        return view('pages.question',  ['question' => $question, 'publication' => $publication, 'similar_questions' => $search_results]);
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

    public function edit($id){

        $question = Question::find($id);

        $temp = Tag::get();

        $locations = array();
        array_push($locations, ' ');

        foreach ($temp as &$value) {
            $new_location_array = array();

            if (isset($value->name))
                array_push($new_location_array, $value->city);

            array_push($locations, $value->name);
        }

        $tags = array();
        $temp = $question->tags;
        foreach($temp as $tagElement){
            array_push($tags , $tagElement->main_tag->name);
        }

        return view('pages.edit_question' ,  ['question' => $question , "id" => $id , "locations" =>$locations , "tags" =>$tags]);
    }

    public function update(Request $request , $id){

    $user = Auth::user();

            $inputs = $request->all();
            //title, description and tags
           try {
                DB::beginTransaction();

                $question = Question::find($id);

                $question->title = $inputs['title'];
                $question->save();
                $publication = Publication::find($question->publication['id']);
                $publication->description =  $inputs['description'];
                $publication->save();

                TagQuestion::where('id_question',$id)->delete();

                if(array_key_exists('tags' , $inputs))
                foreach($inputs['tags'] as &$tag){
                    TagQuestion::create([
                        'id_tag' => $tag,
                        'id_question' => $question->id_commentable_publication
                    ]);
                }

                DB::commit();
                Flash::success('Question edited successfully.');

                return redirect()->route('show.question', ['id' => $question->id_commentable_publication]);

            } catch (\Exception $e) {

                DB::rollBack();

                ErrorFile::outputToFile($e->getMessage(), date('Y-m-d H:i:s'));

                Flash::error('Error editing question!');
                return redirect()->route('edit.question' , [$id]);
            }
    }
}
