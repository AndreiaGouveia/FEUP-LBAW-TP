<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Publication;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);


        DB::beginTransaction();

        $publication = Publication::create([
            "description" => $request->input('description'),
            "id_owner" => Auth::user()->id
        ]);

        if ($publication == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating publication!'], 400);
        }

        $comment = Comment::create([
            "id_publication" => $publication->id,
            "id_commentable_publication" => $request->input('id_publication')
        ]);


        if ($comment == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating comment!'], 400);
        }


        DB::commit();

        $member = Member::find(Auth::user()->id);

        return response()->json(['comment' => $comment, 'publication' => $publication, 'person' => $member, 'photo' => $member->photo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
