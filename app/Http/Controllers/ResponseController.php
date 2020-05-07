<?php

namespace App\Http\Controllers;

use App\Commentable_publication;
use App\Publication;
use App\Response;
use App\Question;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);


        try {
            DB::beginTransaction();


            if (!Question::find($id)) {
                return response()->json(['error' => "No question was found with id equal to " . $id], 404);
            }

            $publication = Publication::create([
                "description" => $request->input('description'),
                "id_owner" => Auth::user()->id
            ]);

            $commentable_publication = Commentable_publication::create(["id_publication" => $publication->id]);

            $question = Question::find($id);
            if ($question == null) {
                DB::rollBack();

                return response()->json(['error' => 'Question not found!'], 404);
            }

            $answer = Response::create([
                "id_commentable_publication" => $commentable_publication->id_publication,
                "id_question" => $id
            ]);

            DB::commit();

            $member = Member::find(Auth::user()->id);
            $full_publication = Publication::find($publication->id);
            return response()->json(['answer' => $answer, 'publication' => $full_publication, 'person' => $member, 'photo' => $member->photo]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}