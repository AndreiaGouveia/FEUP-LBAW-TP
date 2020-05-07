<?php

namespace App\Http\Controllers;

use App\Publication;
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
        

        if (!Publication::find($id)){
            return response()->json(['error' => "No publication was found with id equal to ".$id], 404);
        }

        try {

            $reported = Reported::where([
                "id_publication" => $id,
                "id_member" => Auth::user()->id
            ])->first();

            if ($reported != null) {

                $reported = DB::update('update reported set motive = ? where id_publication = ? AND id_member = ?', [$request->input('motive'), $id, Auth::user()->id]);

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

            return response()->json(['error' => $e->getMessage()], 400);

        }
    }
    
}