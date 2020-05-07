<?php

namespace App\Http\Controllers;

use App\Commentable_publication;
use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {

        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        try {
            DB::beginTransaction();


            if (!Commentable_publication::find($id)) {
                return response()->json(['error' => "No answer or question was found with id equal to " . $id], 404);
            }

            $favotires_input = Favorite::where([
                "id_commentable_publication" => $id,
                "id_member" => Auth::user()->id
            ])->first();

            if ($favotires_input != null) {

                DB::rollBack();
                return response()->json(200);
            }

            DB::insert('insert into favorite(id_commentable_publication, id_member) values (?, ?)', [$id, Auth::user()->id]);

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
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $delete_favorite = DB::delete('delete from favorite where (id_commentable_publication = ? AND id_member = ?)', [$id, Auth::user()->id]);

        if ($delete_favorite == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in deleting like!'], 400);
        }

        DB::commit();

        return response()->json(200);
    }
}
