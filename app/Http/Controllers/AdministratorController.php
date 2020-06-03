<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Administrator;
use App\Publication;
use App\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\welcomeMail ;

class AdministratorController extends Controller
{

    public function panel()
    {

        $popular_tags = DB::table('tag_question')
            ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
            ->select('tag.name', DB::raw('count(tag.id) as count'))
            ->groupBy('tag.name', 'id_tag')
            ->orderByRaw('count(id_tag) DESC')
            ->take(5)
            ->get();

        $popular_tags_legend = array();
        $popular_tags_info = array();

        foreach ($popular_tags as $tag) {
            array_push($popular_tags_legend, $tag->name);
            array_push($popular_tags_info, $tag->count);
        }

        $select = "count(*) as count, to_char(date,'mon') as mon,
        extract(year from date) as yyyy ";

        $monthly_activity = Publication::select(DB::raw($select))
            ->whereRaw('date > date_trunc(\'month\', CURRENT_DATE) - INTERVAL \'1 year\'')
            ->groupBy('mon', 'yyyy')
            ->get();

        $monthly_activity_legend = array();
        $monthly_activity_info = array();

        foreach ($monthly_activity as $activity) {
            array_push($monthly_activity_info, $activity->count);
            array_push($monthly_activity_legend, $activity->mon);
        }

        return view('pages.admin_panel',  ['popular_tags_legend' => $popular_tags_legend, 'popular_tags_info' => $popular_tags_info, 'monthly_activity_info' => $monthly_activity_info, 'monthly_activity_legend' => $monthly_activity_legend]);
    }

    public function edit_about_us()
    {
        $aboutUs = AboutUs::select('description')->orderBy('date', 'desc')->first();

        return view('pages.edit_about',  ['description' => ($aboutUs != null) ? $aboutUs->description : ""]);
    }

    public function update_about_us(Request $request)
    {

        AboutUs::create([
            'id_admin' => Auth::user()->id,
            'description' => ($request->input('description') == null) ? "" : $request->input('description')
            ]);

        return redirect()->route('about');
    }

    public function about() {

        $aboutUs = AboutUs::select('description')->orderBy('date', 'desc')->first();

        return view('pages.about',  ['description' => ($aboutUs != null) ? $aboutUs->description : ""]);

    }

    public function email() {
        return new welcomeMail();
    }
}
