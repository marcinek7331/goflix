<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class SearchController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index($query) {
      $search = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/multi?language=pl-PL&page=1&region=pl-PL&include_adult=false&query='.$query)->json();
      $results = [];
      if(count($search['results']) > 0) {
        foreach ($search['results'] as $result) {
          if(isset($result['vote_count']) && $result['vote_count'] > 80) {
            $results[] = $result;
          }
        }
        $search['results'] = $results;
      }
      return $search;
  }

  public function test() {
    $sources = Http::get('https://streamtape.site/v/jb3A762WyaCzeZy/464052.mp4');
    return $sources;
    // $id = $sources['result']['files'][0]['linkid'];
    // $sources = Http::get('https://api.streamtape.com/file/dlticket?file='.$id.'&login=5c85545946efe219c2d8&key=XkBKwJJmkxsDvWR')->json();
    // sleep($sources['result']['wait_time']);
    // $sources = Http::get('https://api.streamtape.com/file/dl?file='.$id.'&ticket='.$sources['result']['ticket'].'&login=5c85545946efe219c2d8&key=XkBKwJJmkxsDvWR')->json();
    // return $sources['result']['url'];
  }

}
