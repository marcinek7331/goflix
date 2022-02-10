<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

class TVShowsController extends Controller
{

    public function index($page) {
      $tv = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/discover/tv?page='.$page.'&language=pl-PL&region=pl&certification_country=PL&sort_by=popularity.desc&vote_count.gte=600')->json();
      $tv = new LengthAwarePaginator($tv['results'], $tv['total_results'], 20, $page, ['path' => URL::current()]);
      return $tv;
    }
    public function getPopular() {
      $movies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/popular?language=pl-PL')->json();
      return $movies;
    }
    public function show($id) {
      $tv = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/'.$id.'?language=pl-PL&append_to_response=credits')->json();
      $trailer = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/'.$id.'/videos?language=pl-PL')->json();
      if(empty($trailer['results'])) {
        $trailer = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/'.$id.'/videos')->json();
      }
      $tv['video'] = $trailer['results'][0]['key'];
      return $tv;
    }

    public function sliders() {
      $sliders = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/tv/popular?language=pl-PL')->json();
      return $sliders;
    }

}
