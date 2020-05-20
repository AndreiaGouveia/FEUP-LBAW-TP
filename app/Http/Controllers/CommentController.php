<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Commentable_publication;
use App\Publication;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

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


            if (!Commentable_publication::find($id)) {
                return response()->json(['error' => "No answer or question was found with id equal to " . $id], 404);
            }

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

            ErrorFile::outputToFile($e->getMessage(), date('Y-m-d H:i:s'));

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
