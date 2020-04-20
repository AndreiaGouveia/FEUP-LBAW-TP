<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CommentablePublicationController extends Controller
{
   
    protected function create(array $data)
    {
        $publication = app('App\Http\Controllers\PublicationController')->create();
        $commentable_publication = Publication::create([
            'id_publication' => $publication->id,
        ]);

        return $commentable_publication;
    }


}
