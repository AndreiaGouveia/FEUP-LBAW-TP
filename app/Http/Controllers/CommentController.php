<?php

namespace App\Http\Controllers;

use Flash;
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

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('pages.edit_comment' ,  ['comment' => $comment , "id" => $id]);
    }

    public function update(Request $request , $id)
    {
        $user = Auth::user();

        $inputs = $request->all();
        //title, description and tags
        try {
            DB::beginTransaction();

            $comment = Comment::find($id);

            $publication = Publication::find($comment->publication['id']);
            $publication->description =  $inputs['description'];
            $publication->save();

            DB::commit();
            Flash::success('Comentário Editado com Sucesso.');

            if($comment->commentsResponse != NULL)
            return redirect()->route('show.question', ['id' => $comment->commentsResponse->id_question]);

            return redirect()->route('show.question', ['id' => $comment->id_commentable_publication]);

        } catch (\Exception $e) {

             DB::rollBack();

             ErrorFile::outputToFile($e->getMessage(), date('Y-m-d H:i:s'));

             Flash::error('Erro ao Editar o Comentário!');
             return redirect()->route('edit.comment' , [$id]);
        }
    }
}
