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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Response::class);

        DB::beginTransaction();

        $publication = Publication::create([
            "description" => $request->input('response_text'),
            "id_owner" => Auth::user()->id
        ]);

        if ($publication == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating publication!'], 400);
        }

        $commentable_publication = Commentable_publication::create(["id_publication" => $publication->id]);
        
       
        if ($commentable_publication == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating commentable publication!'], 400);
        }

        
        $question = Question::find($request->input('id_question'));
        if ($question == null) {
            DB::rollBack();

            return response()->json(['error' => 'Question not found!'], 404);
        }

        $answer = Response::create([
            "id_commentable_publication" => $commentable_publication->id_publication,
            "id_question" => $request->input('id_question')
        ]);

       
        if ($answer == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating answer!'], 400);
        }
        

        DB::commit();

        $member = Member::find(Auth::user()->id);
        $full_publication = Publication::find($publication->id);
        return response()->json(['answer' => $answer, 'publication' => $full_publication, 'person' => $member, 'photo' => $member->photo]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
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
