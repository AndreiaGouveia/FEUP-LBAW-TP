<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Likes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $favotires_input = Favorite::where([
            "id_commentable_publication" => $request->input('id_publication'),
            "id_member" => Auth::user()->id
        ])->first();

        if ($favotires_input != null) {

            return;
        }

        $favotires_input = DB::insert('insert into favorite(id_commentable_publication, id_member) values (?, ?)', [$request->input('id_publication'), Auth::user()->id]);

        if (!$favotires_input) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating favorite!'], 400);
        }


        DB::commit();

        return response()->json(200);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $delete_favorite = DB::delete('delete from favorite where (id_commentable_publication = ? AND id_member = ?)', [$request->input('id_publication'), Auth::user()->id]);

        if ($delete_favorite == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in deleting like!'], 400);
        }

        DB::commit();

        return response()->json(200);
    }
    
}
