<?php

namespace App\Http\Controllers;

use App\Publication;
use App\Reported;
use App\Question;
use App\Comment;
use App\Response;
use App\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PublicationController extends Controller
{


    /**
     * Report a Publication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request, $id)
    {

        DB::beginTransaction();


        if (!Publication::find($id)) {
            return response()->json(['error' => "No publication was found with id equal to " . $id], 404);
        }

        $this->authorize('report', Publication::find($id));

        try {

            $reported = Reported::where([
                "id_publication" => $id,
                "id_member" => Auth::user()->id,
                "motive" => $request->input('motive')
            ])->first();

            if ($reported != null) {

                $reported = DB::update('update reported set resolved = false where id_publication = ? AND id_member = ?', [$id, Auth::user()->id]);

                DB::commit();

                return response()->json(200);
            }

            $reported = Reported::create([
                "id_publication" => $id,
                "id_member" => Auth::user()->id,
                'motive' => $request->input('motive')
            ]);

            DB::commit();

            return response()->json(200);
        } catch (\Exception $e) {

            DB::rollBack();

            ErrorFile::outputToFile($e->getMessage(), date('Y-m-d H:i:s'));

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function delete($id)
    {
        
        DB::beginTransaction();

        if (!Publication::find($id)) {
            return response()->json(['error' => "No publication was found with id equal to " . $id], 404);
        }


        $this->authorize('delete', Publication::find($id));

        try {
            $delete_publication = DB::table('publication')->where('id', $id)->update(['visible' => false]);
            DB::commit();
            return response()->json(200);
        } catch (\Exception $e) {

            DB::rollBack();
            ErrorFile::outputToFile($e->getMessage(), date('Y-m-d H:i:s'));
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    function view_reports()
    {

        $reportedQuestions = Question::whereHas('reported')->get();
        $reportedResponses = Response::whereHas('reported')->get();
        $reportedComments = Comment::whereHas('reported')->get();

        return view('pages.reports', ['questions' => $reportedQuestions, 'answers' => $reportedResponses, 'comments' => $reportedComments]);
    }

    function resolve_report(Request $request, $id)
    {

        if (!Publication::find($id)) {
            return response()->json(['error' => "No publication was found with id equal to " . $id], 404);
        }

        DB::beginTransaction();

        DB::update('update reported set resolved = ? where id_publication = ?', [$request->input('resolved'), $id]);

        DB::commit();
    }
}
