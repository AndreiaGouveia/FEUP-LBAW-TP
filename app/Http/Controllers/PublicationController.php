<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
   
    protected function create(array $data)
    {

        $publication = Publication::create([
            'description' => $data['description'],
        ]);

        return $publication;
    }


}
