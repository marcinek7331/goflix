<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

class SlidersController extends Controller {

    public function index($type) {
      if($type=='movies') {
        $type = 'movie/now_playing';
      }
      else if($type=='tv'){
        $type = 'tv/popular';
      }
      $sliders = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/'.$type.'?language=pl-PL')->json();
      return $sliders;
    }

}
