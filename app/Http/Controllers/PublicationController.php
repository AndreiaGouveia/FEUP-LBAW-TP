<?php

namespace App\Http\Controllers;

use App\Reported;
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
        if (!Auth::check())
            return response()->json(['error' => 'User not authenticated!'], 403);

        DB::beginTransaction();

        $reported = Reported::where([
            "id_publication" => $id,
            "id_member" => Auth::user()->id
        ])->first();

        if ($reported != null) {

            $reported = DB::update('update reported set motive = ? where id_publication = ? AND id_member = ?', [$request->input('motive'), $id, Auth::user()->id]);

            if (!$reported) {
                DB::rollBack();

                return response()->json(['error' => 'Error in creating report!'], 400);
            }

            DB::commit();

            return response()->json(200);
        }

        $reported = Reported::create([
            "id_publication" => $id,
            "id_member" => Auth::user()->id,
            'TYPE' => $request->input('type')
        ]);

        if (!$reported) {
            DB::rollBack();

            return response()->json(['error' => 'Error in creating report!'], 400);
        }


        DB::commit();

        return response()->json(200);
    }

}
