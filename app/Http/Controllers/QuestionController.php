<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
   
    protected function create(array $data)
    {

        $commentable_publication = app('App\Http\Controllers\CommentablePublicationController')->create();

        $question = Question::create([
            'id_commentable_publication' => $commentable_publication->id,
            'title' => $data['title']
        ]);

        return $person;
    }


}
