<?php

namespace App\Http\Controllers;

use App\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
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
    public function create()
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
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $likes_input = Likes::where([
            "id_commentable_publication" => $request->input('id_publication'),
            "id_member" => Auth::user()->id
        ])->first();

        if ($likes_input != null) {

            $likes_input = DB::update('update likes set likes = ? where id_commentable_publication = ? AND id_member = ?', [$request->input('like'), $request->input('id_publication'), Auth::user()->id]);

            if (!$likes_input) {
                DB::rollBack();

                return response()->json(['error' => 'Error in creating publication!'], 400);
            }

            DB::commit();

            return response()->json(200);
        }

        $likes_input = DB::insert('insert into likes  values (?, ?, ?)', [$request->input('id_publication'), Auth::user()->id, $request->input('like')]);

        if (!$likes_input) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating publication!'], 400);
        }



        DB::commit();

        return response()->json(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function show(Likes $likes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $delete_likes = DB::delete('delete from likes where (id_commentable_publication = ? AND id_member = ? AND likes = ?)', [$request->input('id_publication'), Auth::user()->id, $request->input('like')]);

        if ($delete_likes == null) {
            DB::rollBack();

            return response()->json(['error' => 'Error in deleting like!'], 400);
        }

        DB::commit();

        return response()->json(200);
    }
}
