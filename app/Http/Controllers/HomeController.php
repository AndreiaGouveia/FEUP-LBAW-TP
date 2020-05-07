<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function show()
        {
                $data_question = DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->groupBy('person.id', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('publication.date')
                        ->get();

                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();

                return view('pages.home', ['questions' => $data_question, 'popular_tags' => $popular_tags]);
        }

        public function search(Request $request)
        {
                $inputs = $request->all();
                $search = $inputs['search'];

                $topics = DB::table('tag')
                        ->select('tag.name')
                        ->where('tag.name', 'ilike', '%' . $search . '%')
                        ->get();

                $questions = DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                        ->where('question.title', 'ilike', '%' . $search . '%')
                        ->orWhere('publication.description', 'ilike', '%' . $search . '%')
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->groupBy('person.id', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('publication.date')
                        ->get();

                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();

                return view('pages.search',  ['search' => $search, 'questions' => $questions, 'topics' => $topics, 'popular_tags' => $popular_tags]);
        }

        public function search_topic($input)
        {
                $questions = DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                        ->whereIn('question.id_commentable_publication', (DB::table('question')
                                ->select('publication.id')
                                ->where('tag.name', '=', $input)
                                ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')))
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->groupBy('person.id', 'member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('publication.date')
                        ->get();


                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();

                return view('pages.search_topic',  ['search' => $input, 'questions' => $questions, 'popular_tags' => $popular_tags]);
        }


        public function home()
        {
                return redirect('home');
        }
}