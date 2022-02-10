<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;
use App\Models\MoviesSources;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Options;
use App\Models\JavaScriptUnpacker;
use FFMpeg;

class MoviesController extends Controller
{
    public function test() {
        $url = 'https://vidoza.net/embed-nkjakhrgqeen.html';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $html = curl_exec($ch);
        curl_close($ch);
        $html = base64_encode($html);
        $host = "vidoza";
        $api_endpoint = "http://62.171.133.46:1339/api/v1/$host";
        $auth = '{"auth":"","skk":"test"}';
        $auth = base64_encode($auth);
        $params = array(
            "source" => $html,
            "auth" => $auth
        );
        $params = json_encode($params);
        $ch = curl_init($api_endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params)
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        if ($result)
        {
            $result = json_decode($result);
            $url = $result->url;
            return $url;
            // ini_set('memory_limit', '1024M');
            // set_time_limit(3600);
            // ob_start();
            // if (isset($_SERVER['HTTP_RANGE'])) $opts['http']['header'] = "Range: " . $_SERVER['HTTP_RANGE'];
            // $opts['http']['method'] = "HEAD";
            // $conh = stream_context_create($opts);
            // $opts['http']['method'] = "GET";
            // $cong = stream_context_create($opts);
            // $out[] = file_get_contents($url, true, $conh);
            // $out[] = $http_response_header;
            // ob_end_clean();
            // array_map("header", $http_response_header);
            // readfile($url, false, $cong);
        }
    }

    public function index($page)
    {
        $movies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/discover/movie?page=' . $page . '&language=pl-PL&region=pl&certification_country=PL&sort_by=popularity.desc&vote_count.gte=600')->json();
        $movies = new LengthAwarePaginator($movies['results'], $movies['total_results'], 20, $page, ['path' => URL::current() ]);
        return $movies;
    }

    public function getGrabMovieList(Request $request)
    {
        $html = new Dom;
        $link = Http::get('https://filman.cc/filmy-online-pl/sort:view/?page=' . $request->page);
        $html->loadStr($link->getBody());
        $list = $html->find('#item-list');
        $list = $list->find('.col-xs-6');
        $links = array();
        $movies = array();
        foreach ($list as $item)
        {
            $year = $item->find('.film_year')->text;
            $title = $item->find('.film_title')->text;
            $link = $item->find('.poster a')->href;
            $poster = 'https://goflix.pl/api/grab/getMoviePoster?link=' . $item->find('.poster a img')->src;
            $movie = array(
                'title' => $title,
                'year' => $year,
                'poster' => $poster,
                'link' => $link,
                'added' => false
            );
            array_push($movies, $movie);
            array_push($links, $link);
        }
        $links = MoviesSources::whereIn('link', $links)->pluck('link');
        foreach ($movies as $key => $movie)
        {
            foreach ($links as $link)
            {
                if ($movie['link'] == $link)
                {
                    $movies[$key]['added'] = true;
                }
            }
        }
        $movies = new LengthAwarePaginator($movies, 24 * 940, 24, $request->page, ['path' => URL::current() ]);
        return $movies;
    }

    public function getGrabMoviePoster(Request $request)
    {
        $link = Http::get($request->link);
        return $link;
    }

    public function getGrabMovie(Request $request)
    {
        $html = new Dom;
        $link = Http::get($request->link);
        $html->loadStr($link->getBody());
        $links = $html->find('#links');
        $links = $links->find('tbody .visible-1');
        $sources = array();
        foreach ($links as $item)
        {
            $version = $item->find('td') [1]->text;
            $quality = $item->find('td') [2]->text;
            $src = json_decode(base64_decode($item->find('td a')->{'data-iframe'}))->src;
            $source = array(
                'version' => $version,
                'quality' => $quality,
                'src' => $src
            );
            array_push($sources, $source);
        }
        $title = explode('/', $html->find('span[itemprop=title]')
            ->text);
        $year = $html->find('.info ul li', 1)->text;
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?language=pl-PL&query=' . $title[0] . '&year=' . $year)->json();
        if (empty($movie['results']))
        {
            $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?language=pl-PL&query=' . $title[0])->json();
        }
        if (empty($movie['results']))
        {
            $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?language=pl-PL&query=' . $title[1])->json();
        }
        if (empty($movie['results']))
        {
            return response()->json("error", 500);
        }
        MoviesSources::updateOrCreate(['id' => $movie['results'][0]['id'], 'link' => $request->link, 'sources' => base64_encode(json_encode($sources)) ]);
        return response()->json($sources, 200);
    }

    public function getPopular()
    {
        $movies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing?language=pl-PL')
            ->json();
        return $movies;
    }

    public function show($id)
    {
        $movies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $id . '?language=pl-PL&append_to_response=casts')->json();
        $trailer = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $id . '/videos?language=pl-PL')->json();
        if (!$trailer['results'])
        {
            $trailer = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $id . '/videos')->json();
        }
        $movies['video'] = $trailer['results'][0]['key'];
        $movies['sources'] = MoviesSources::where('id', $id)->pluck('sources')
            ->first();
        return $movies;
    }

    public function sliders()
    {
        $sliders = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing?language=pl-PL')
            ->json();
        return $sliders;
    }

    public function store(Request $request)
    {
        MoviesSources::create(['id' => $request->id, 'sources' => base64_decode($request->sources) ]);
    }

    private function checkSource($link)
    {
        $availables = ['fembed', 'aparat', 'clipwatching', 'filesim', 'hxfile', 'ninjastream', 'rumble', 'solidfiles.com', 'streamable', 'streamsb', 'vidlox', 'vidoza', 'vup', 'yourupload', 'v2.zplayer'];
        foreach ($availables as $available)
        {
            if ($available == $link)
            {
                return true;
            }
        }
        return false;
    }

    private function prepareVariables($link)
    {
        $host = str_replace('www.', null, $link['host']);
        if ($host == 'mixdrop.to' || $host == 'files.fm' || $host == 'files.im')
        {
            $host = str_replace('.', null, $host);
        }
        $host = explode('.', $host) [0];
        $id = $link['path'];
        $test = explode('/', $id);
        if (count($test) > 2)
        {
            if ($id[1] == 'f' || $id[1] == 'v' || $id[1] == 'd' || $id[1] == 'w' || $id[1] == 'u')
            {
                $id = substr($id, 3, strlen($id));
            }
        }
        else
        {
            $id = explode('/', $id);
            if (count($id) == 4)
            {
                $id = $id[2];
            }
            else if (count($id) == 2)
            {
                $id = $id[1];
            }
        }
        $id = str_replace('/', null, $id);
        return array(
            $host,
            $id
        );
    }

    public function getSources(Request $request)
    {
        $link = parse_url($request->link);
        $variable = $this->prepareVariables($link);
        if ($this->checkSource($variable[0]))
        {
            $html = new Dom;
            $link = str_replace('embed.php', 'download.php', Http::get('https://okplay.top//embed2.php?host=' . $variable[0] . '&id=' . $variable[1] . '&onlylink=yes'));
            $link = Http::get($link);
            return $link;
            if ($link->status() == 200 && !strpos($link->getBody() , 'Fatal error'))
            {
                $html->loadStr($link->getBody());
                if (!count($html->find('.btn-download')))
                {
                    $link = $html->find('.btn-watch')->href;
                    $html->loadFromUrl($link, (new Options())->setRemoveScripts(false));
                    $link = $html->find('body script not:([src])') [0];
                    $link = substr($link, 0, strpos($link, '}});') + 2);
                    $link = json_decode(substr($link, strpos($link, 'vp.setup') + 9) , true);
                    return response()->json(['status' => 'ok', 'src' => $link['sources'][0]['file'], 'type' => 'hls'], 200);
                }
                $link = $html->find('.btn-download')->href;
                return response()
                    ->json(['status' => 'ok', 'src' => $link], 200);
            }
            return response()->json(['status' => 'error', 'message' => 'We do not support this source'], 404);
        }
        return response()
            ->json(['status' => 'error', 'message' => 'We do not support this site'], 404);

    }
}
