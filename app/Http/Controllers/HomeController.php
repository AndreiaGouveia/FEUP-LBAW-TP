<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

        var $posts_per_page = 15;

        public function home()
        {
                return redirect('home');
        }

        public function postSearch(Request $request)
        {
                $query = $request->input('search');

                return redirect()->route('search', [$query]);
        }

        public function getPopularTopics()
        {

                return DB::table('tag_question')
                        ->select('tag.name')
                        ->join('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->groupBy('tag.name', 'id_tag')
                        ->orderByRaw('count(id_tag) DESC')
                        ->take(10)
                        ->get();
        }

        public function getSearchResults($query)
        {

                return DB::table('question')
                        ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->whereRaw('to_tsquery(?) @@ to_tsvector( question.title || \' \') OR to_tsquery(?) @@ to_tsvector( publication.description || \' \')', [$query, $query])
                        ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description');
        }

        public function getSearchTopics($query)
        {

                return DB::table('tag')->selectRaw('tag.name, ts_rank_cd(textsearch, query) AS rank')
                        ->fromRaw('tag, to_tsquery(?) AS query, to_tsvector( name) AS textsearch', [$query])
                        ->whereRaw('query @@ textsearch')
                        ->orderBy('rank', 'desc');
        }

        public function getSearchQuestionsWithTopic($topic)
        {

                return DB::table('question')
                ->select('person.id as memberId', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', DB::raw('array_to_json(array_agg(tag.name)) tags'), DB::raw('COUNT(nullif(likes.likes, false)) likes'), DB::raw('COUNT(nullif(likes.likes, true)) dislikes'))
                ->whereIn('question.id_commentable_publication', (DB::table('question')
                        ->select('publication.id')
                        ->where('tag.name', '=', $topic)
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
                ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description');
        }

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
                        ->orderBy('publication.date', 'desc')
                        ->simplePaginate($this->posts_per_page);

                $popular_tags = $this->getPopularTopics();

                return view('pages.home', ['questions' => $data_question, 'popular_tags' => $popular_tags]);
        }

        public function searchTopic($input)
        {
                $questions = $this->getSearchQuestionsWithTopic($input)
                        ->orderBy('publication.date')
                        ->simplePaginate($this->posts_per_page);


                $popular_tags = $this->getPopularTopics();


                $filter = 0;

                return view('pages.search_topic',  ['search' => $input, 'questions' => $questions, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }


        public function filteredSearchTopic($input, $filter)
        {
                if ($filter == 'relevant') {
                        $filter = 0;

                        $questions = $this->getSearchQuestionsWithTopic($input)
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes', 'desc')
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                } else if ($filter == 'recent') {
                        $filter = 1;

                        $questions = $this->getSearchQuestionsWithTopic($input)
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                } else if ($filter == 'mostLiked') {
                        $filter = 2;

                        $questions = $this->getSearchQuestionsWithTopic($input)
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes')
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                } else if ($filter == 'leastLiked') {
                        $filter = 3;

                        $questions = $this->getSearchQuestionsWithTopic($input)
                        ->orderBy('dislikes', 'desc')
                                ->orderBy('likes')
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                }

                $popular_tags = $this->getPopularTopics();


                return view('pages.search_topic',  ['search' => $input, 'questions' => $questions, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }

        public function search($query)
        {
                $topics = $this->getSearchTopics($query)
                        ->orderBy('rank', 'desc')
                        ->simplePaginate($this->posts_per_page);

                $questions = $this->getSearchResults($query)
                        ->orderByRaw('ts_rank_cd(to_tsvector(question.title || \' \'), ?), ts_rank_cd(to_tsvector(publication.description || \' \'), ?), likes, dislikes, publication.date desc', [$query, $query])
                        ->simplePaginate($this->posts_per_page);


                $popular_tags = $this->getPopularTopics();

                $filter = 0;

                return view('pages.search',  ['search' => $query, 'questions' => $questions, 'topics' => $topics, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }

        public function filteredSearch($query, $filter)
        {
                $topics =  $this->getSearchTopics($query)
                ->orderBy('rank', 'desc')
                ->simplePaginate($this->posts_per_page);

                if ($filter == 'recent') {
                        $filter = 1;

                        $questions = $this->getSearchResults($query)
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                } else if ($filter == 'mostLiked') {
                        $filter = 2;

                        $questions = $this->getSearchResults($query)
                                ->orderBy('likes', 'desc')
                                ->orderBy('dislikes')
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                } else if ($filter == 'leastLiked') {
                        $filter = 3;

                        $questions = $this->getSearchResults($query)
                                ->orderBy('dislikes', 'desc')
                                ->orderBy('likes')
                                ->orderBy('publication.date', 'desc')
                                ->simplePaginate($this->posts_per_page);
                } else {
                        $filter = 0;

                        $questions = $this->getSearchResults($query)
                                ->orderByRaw('ts_rank_cd(to_tsvector(question.title || \' \'), ?), ts_rank_cd(to_tsvector(publication.description || \' \'), ?), likes, dislikes, publication.date desc', [$query, $query])
                                ->simplePaginate($this->posts_per_page);
                }

                $topics = $this->getSearchTopics($query)->simplePaginate($this->posts_per_page);

                $popular_tags = $this->getPopularTopics();


                return view('pages.search',  ['search' => $query, 'questions' => $questions, 'topics' => $topics, 'popular_tags' => $popular_tags, 'filter' => $filter]);
        }
}
