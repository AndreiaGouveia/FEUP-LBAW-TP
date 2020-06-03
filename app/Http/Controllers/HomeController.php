<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
                        ->selectRaw('ts_rank_cd(question.tsv, plainto_tsquery(?)) as rank', [$query])
                        ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                        ->join('person', 'publication.id_owner', '=', 'person.id')
                        ->join('member', 'person.id', '=', 'member.id_person')
                        ->leftJoin('photo', 'photo.id', '=', 'member.id_photo')
                        ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                        ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')
                        ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
                        ->whereRaw('to_tsquery(?) @@ tsv', [$query])
                        ->groupBy('person.id', 'member.name', 'person.visible', 'person.ban', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description', 'question.tsv');
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
                $questions = $this->getSearchQuestionsWithTopic($input);

                switch (Input::get('filter', 'relevant')) {

                        case 'recent':
                                $questions = $questions
                                        ->orderBy('publication.date', 'desc');

                                break;
                        case 'mostLiked':
                                $questions = $questions
                                        ->orderBy('likes', 'desc')
                                        ->orderBy('dislikes')
                                        ->orderBy('publication.date', 'desc');
                                break;
                        case 'leastLiked':
                                $questions = $questions
                                        ->orderBy('dislikes', 'desc')
                                        ->orderBy('likes')
                                        ->orderBy('publication.date', 'desc');
                                break;
                        case 'relevant':
                                $questions = $questions
                                        ->orderBy('likes', 'desc')
                                        ->orderBy('dislikes')
                                        ->orderBy('publication.date', 'desc');

                                break;
                }

                switch (Input::get('time')) {
                        case 'lastHour':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 hour\'');
                                break;
                        case 'lastDay':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 day\'');
                                break;

                        case 'lastWeek':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 week\'');
                                break;

                        case 'lastMonth':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 month\'');
                                break;
                }


                return view('pages.search_topic',  ['search' => $input, 'questions' => $questions->simplePaginate($this->posts_per_page), 'filter' => Input::get('filter', 'relevant'), 'time' => Input::get('time')]);
        }

        public function search($query)
        {
                $topics = $this->getSearchTopics($query)
                        ->simplePaginate($this->posts_per_page);

                $questions = $this->getSearchResults($query);

                switch (Input::get('filter', 'relevant')) {

                        case 'recent':
                                $questions = $questions
                                        ->orderBy('publication.date', 'desc')
                                        ->orderBy('rank', 'desc');

                                break;
                        case 'mostLiked':
                                $questions = $questions
                                        ->orderBy('likes', 'desc')
                                        ->orderBy('dislikes')
                                        ->orderBy('rank', 'desc')
                                        ->orderBy('publication.date', 'desc');
                                break;
                        case 'leastLiked':
                                $questions = $questions
                                        ->orderBy('dislikes', 'desc')
                                        ->orderBy('likes')
                                        ->orderBy('rank', 'desc')
                                        ->orderBy('publication.date', 'desc');
                                break;
                        case 'relevant':
                                $questions = $questions
                                        ->orderBy('rank', 'desc')
                                        ->orderBy('likes', 'desc')
                                        ->orderBy('dislikes')
                                        ->orderBy('publication.date', 'desc');

                                break;
                }

                if (Input::get('tag', 0) != 0) {
                        $questions = $questions->whereIn('question.id_commentable_publication', (DB::table('question')
                                ->select('publication.id')
                                ->where('tag.id', '=', Input::get('tag'))
                                ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag_question', 'tag_question.id_question', '=', 'question.id_commentable_publication')
                                ->leftJoin('tag', 'tag.id', "=", 'tag_question.id_tag')));
                }

                switch (Input::get('time')) {
                        case 'lastHour':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 hour\'');
                                break;
                        case 'lastDay':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 day\'');
                                break;

                        case 'lastWeek':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 week\'');
                                break;

                        case 'lastMonth':
                                $questions = $questions
                                        ->whereRaw('date > CURRENT_DATE - INTERVAL \'1 month\'');
                                break;
                }

                return view('pages.search',  ['search' => $query, 'questions' => $questions->simplePaginate($this->posts_per_page), 'topics' => $topics, 'filter' => Input::get('filter', 'relevant'), 'time' => Input::get('time'), 'tag' => Input::get('tag', 0)]);
        }
}
