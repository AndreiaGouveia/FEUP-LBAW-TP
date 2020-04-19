<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function show()
        {

                $data_question = DB::table('question')
                        ->select('member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->join('photo', 'photo.id', '=', 'member.id_photo')
                        ->join('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->groupBy('member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('publication.date')
                        ->get();
                
                $popular_tags = DB::table('tag_question')
                                ->select('tag.name')
                                ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                                ->take(10)
                                ->get();

                return view('pages.home', ['questions' => $data_question, 'popular_tags' => $popular_tags]);
        }
}
