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
    public function store(Request $request, $id)
    {

        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);


        try {
            DB::beginTransaction();

            $publication = Publication::create([
                "description" => $request->input('description'),
                "id_owner" => Auth::user()->id
            ]);

            $comment = Comment::create([
                "id_publication" => $publication->id,
                "id_commentable_publication" => $id
            ]);

            DB::commit();

            $member = Member::find(Auth::user()->id);

            return response()->json(['comment' => $comment, 'publication' => $publication, 'person' => $member, 'photo' => $member->photo]);
        
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 400);
        }
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
