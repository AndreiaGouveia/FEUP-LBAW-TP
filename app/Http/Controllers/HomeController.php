<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function show()
        {
                $data_question = DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'))
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('publication.date')
                        ->get();

                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();

                return view('pages.home', ['questions' => $data_question, 'popular_tags' => $popular_tags]);
        }

        public function search($query)
        {
                $topics = DB::table('tag')
                        ->select('tag.name')
                        ->where('tag.name', 'ilike', '%' . $query . '%')
                        ->get();

                $questions = DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                        ->where('question.title', 'ilike', '%' . $query . '%')
                        ->orWhere('publication.description', 'ilike', '%' . $query . '%')
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('likes', 'desc')
                        ->orderBy('dislikes', 'desc')
                        ->get();

                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();

                $filter = 0;

                return view('pages.search',  ['search' => $query, 'questions' => $questions, 'topics' => $topics, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }

        public function searchTopic($input)
        {
                $questions = DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
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
                        ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                        ->orderBy('publication.date')
                        ->get();


                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();

                $filter = 0;

                return view('pages.search_topic',  ['search' => $input, 'questions' => $questions, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }


        public function home()
        {
                return redirect('home');
        }

        public function postSearch(Request $request)
        {
                $query = $request->input('search');

                return redirect()->route('search', [$query]);
        }


        public function filteredSearchTopic($input, $filter)
        {
                if ($filter == 'relevant') {
                        $filter = 0;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
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
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes', 'desc')
                                ->get();
                } else if ($filter == 'recent') {
                        $filter = 1;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
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
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('publication.id', 'desc')
                                ->get();
                } else if ($filter == 'mostLiked') {
                        $filter = 2;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
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
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes')
                                ->get();
                } else if ($filter == 'leastLiked') {
                        $filter = 3;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
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
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('dislikes', 'desc')
                                ->orderBy('likes')
                                ->get();
                }

                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();


                return view('pages.search_topic',  ['search' => $input, 'questions' => $questions, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }

        public function filteredSearch($query, $filter)
        {
                $topics = DB::table('tag')
                        ->select('tag.name')
                        ->where('tag.name', 'ilike', '%' . $query . '%')
                        ->get();

                if ($filter == 'recent') {
                        $filter = 1;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                                ->where('question.title', 'ilike', '%' . $query . '%')
                                ->orWhere('publication.description', 'ilike', '%' . $query . '%')
                                ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                                ->join('person', 'publication.id_owner', '=', 'person.id')
                                ->join('member', 'person.id', '=', 'member.id_person')
                                ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                                ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                                ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('publication.id', 'desc')
                                ->get();
                } else if ($filter == 'mostLiked') {
                        $filter = 2;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                                ->where('question.title', 'ilike', '%' . $query . '%')
                                ->orWhere('publication.description', 'ilike', '%' . $query . '%')
                                ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                                ->join('person', 'publication.id_owner', '=', 'person.id')
                                ->join('member', 'person.id', '=', 'member.id_person')
                                ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                                ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                                ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes')
                                ->get();
                } else if ($filter == 'leastLiked') {
                        $filter = 3;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                                ->where('question.title', 'ilike', '%' . $query . '%')
                                ->orWhere('publication.description', 'ilike', '%' . $query . '%')
                                ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                                ->join('person', 'publication.id_owner', '=', 'person.id')
                                ->join('member', 'person.id', '=', 'member.id_person')
                                ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                                ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                                ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('dislikes', 'desc')
                                ->orderBy('likes')
                                ->get();
                } else {
                        $filter = 0;

                        $questions = DB::table('question')
                                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                                ->where('question.title', 'ilike', '%' . $query . '%')
                                ->orWhere('publication.description', 'ilike', '%' . $query . '%')
                                ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                                ->join('person', 'publication.id_owner', '=', 'person.id')
                                ->join('member', 'person.id', '=', 'member.id_person')
                                ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                                ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                                ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes', 'desc')
                                ->get();
                }

                $topics = DB::table('tag')
                        ->select('tag.name')
                        ->where('tag.name', 'ilike', '%' . $query . '%')
                        ->get();

                $popular_tags = DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->take(10)
                        ->get();


                return view('pages.search',  ['search' => $query, 'questions' => $questions, 'topics' => $topics, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }
}
