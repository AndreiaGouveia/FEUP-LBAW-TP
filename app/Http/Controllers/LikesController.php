<?php

namespace App\Http\Controllers;

use App\Commentable_publication;
use App\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
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


            if (!Commentable_publication::find($id)) {
                return response()->json(['error' => "No answer or question was found with id equal to " . $id], 404);
            }

            $likes_input = Likes::where([
                "id_commentable_publication" => $id,
                "id_member" => Auth::user()->id
            ])->first();

            if ($likes_input != null) {

                $likes_input = DB::update('update likes set likes = ? where id_commentable_publication = ? AND id_member = ?', [$request->input('like'), $id, Auth::user()->id]);

                DB::commit();

                return response()->json(200);
            }


            $likes_input = DB::insert('insert into likes  values (?, ?, ?)', [$id, Auth::user()->id, $request->input('like')]);

            DB::commit();

            return response()->json(200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $delete_likes = DB::delete('delete from likes where (id_commentable_publication = ? AND id_member = ? AND likes = ?)', [$id, Auth::user()->id, $request->input('like')]);

        if ($delete_likes == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in deleting like!'], 400);
        }

        DB::commit();

        return response()->json(200);
    }
}
