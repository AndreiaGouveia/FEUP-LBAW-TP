<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {

      //TODO contar o numero de likes
      //COUNT(nullif(likes.likes, false)), COUNT(nullif(likes.likes, true))

      $data = DB::table('question')
              ->select('member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
              ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
              ->join('person', 'publication.id_owner', '=', 'person.id')
              ->join('member', 'person.id' ,'=', 'member.id_person')
              ->join('photo', 'photo.id', '=', 'member.id_photo')
              ->groupBy('member.name', 'photo.url', 'publication.id', 'publication.date', 'question.title', 'publication.description')
              ->get();
  
      /*$data = DB::table('question')
              ->join('publication', 'publication.id', '=', 'question.id_commentable_publication')
              ->join('person', 'publication.id_owner', '=', 'person.id')
              ->join('member', 'person.id' ,'=', 'member.id_person')
              ->join('question', 'publication.id', '=', 'question.id_commentable_publication')
              ->leftJoin('likes', 'likes.id_commentable_publication', '=', 'question.id_commentable_publication')
              ->groupBy('member.name', 'publication.date', 'question.title', 'publication.description')
              ->select('member.name', 'publication.date', 'question.title', 'publication.description', DB::raw('COUNT(nullif(likes.likes, false))'), DB::raw('COUNT(nullif(likes.likes, true)'))
              ->get();*/



      //TODO: organize correctly

      return view('pages.home', ['questions' => $data]);
    }

}
