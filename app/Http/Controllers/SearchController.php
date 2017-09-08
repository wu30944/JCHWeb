<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct(fellowshipRepository $fellowshipRepository)
    {
        $this->fellowshipRepository=$fellowshipRepository;
    }

}