<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Pbmedia\LaravelFFMpeg\FFMpeg;
class StreamController extends Controller {

    public function index(Request $request) {
      $link = $request->link;
      $supported = array('vidoza', 'mixdrop', 'clipwatching', 'highstream', 'wolfstream', 'upstream', 'streamtape', 'voe');
      $host = explode('.', parse_url($link)['host'])[0];
      if(in_array($host, $supported)) {
        $stream = $this->sendRequstToStream($link, $host);
        $stream = json_decode($stream);
        if($stream != null && $stream->status == "ok" ) {
          if(str_contains($stream->url, 'mp4')) {
            return $stream->url;
            return $this->createStreamMP4($stream->url);
          }
          return $this->createStreamHLS($stream->url);
        }
        else {
          return response()->json(['status'=> 'error']);
        }
      }
      else {
        return "nie obsluguje takiego";
      }
    }
    public function testujemy() {

    }
    private function sendRequstToStream($url, $host) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      curl_setopt($ch, CURLOPT_REFERER, $url);
      $html = curl_exec($ch);
      curl_close($ch);
      $html = base64_encode($html);
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
      if ($result) {
          return $result;
      }
    }

    private function createStreamHLS($url) {
      header("Content-type: application/x-mpegURL");
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Headers: *");
      $handle = fopen($url, "r");
      while(($line = fgets($handle)) !== FALSE) {
        if(strpos($line,"https") !== FALSE) {
          $url = trim($line);
          break;
        }
      }
      $perseurl = parse_url($url);
      $host = $perseurl['host'];
      $path = explode('/',$perseurl['path']);
      $return = array();
      $i = 0;
      $handle = fopen($url, "r");
      while(($line = fgets($handle)) !== FALSE) {
              if(strpos($line,"#EXTINF") !== FALSE) {
                  $return['data'][$i]['inf'] = str_replace(array("#EXTINF:",",","\r","\n"),array("","","",""),$line);
              }
              if(strpos($line,".ts") !== FALSE) {
                  $return['data'][$i]['ts'] = "https://goflix.marcinwas.pl/api/streamts?link=https://".$host.'/'.$path[1].'/'.$path[2].'/'.str_replace(array(".ts","segment","\r","\n"),array("","","",""),$line);
                  $i++;
              }
              if(strpos($line,"TARGETDURATION") !== FALSE) {
                  $return['duration'] = str_replace(array("#EXT-X-TARGETDURATION:","\r","\n"),array("","","",""),$line);
              }
          }
          $retorno = "#EXTM3U\n#EXT-X-VERSION:3\n#EXT-X-MEDIA-SEQUENCE:0\n#EXT-X-ALLOW-CACHE:YES\n#EXT-X-TARGETDURATION:".$return['duration']."\n";
          $vence = "+".floor($return['duration'] / 60)." minutes";
          foreach($return['data'] as $k=>$v) {
               $retorno .= "#EXTINF:".$v['inf'].",\n";
               $retorno .= $v['ts'].".ts"."\n";
           }
           $retorno .= "#EXT-X-ENDLIST\n";
        return $retorno;
    }


    public function createStreamTS(Request $request) {
      // header("Access-Control-Allow-Origin: *");
      // header("Access-Control-Allow-Headers: *");
      @readfile($request->link);
    }
    public function test() {
      return $this->playFromRemote('https://s755.highstream.tv/zx5xrmdtjv2dxcne4zpd3bxjyhveun5j7fxo473rxbll4vpxtrwcejiql3eqzyl4vpxtrwmukqwhx7a/v.mp4');
    }




    public function playFromRemote () {
      echo file_get_contents('https://hideip.me/en/proxy/socks5list');
    }
    private function createStreamMP4($url) {
          echo $this->index($url);

          // ini_set('max_execution_time', 0);
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

    public function createStreamMP44(Request $request) {
      $url = $request->link;
      $url = json_decode($this->sendRequstToStream($url, 'vidoza'));
      $url = $url->url;
      ob_start();
  $opts = array();
  header('Accept-Ranges: bytes');
  header('Developed-by: CodySeller');

  $opts['http']['header'] = 'Connection: keep-alive';
  $opts['http']['header'] = 'Cache-Control: no-cache';
  $opts['http']['header'] = 'Pragma: no-cache';



      // ini_set('max_execution_time', 0);
      // set_time_limit(0);
      //
      //
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
      // $fp = fopen($url, 'rb', false, $cong);
    	// 	while (!feof($fp)) {
    	// 		echo fread($fp, 1024 * 1024 * 7);
    	// 		flush();
    	// 		ob_flush();
    	// 	}
    	// 	fclose($fp);
    }
      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, $request->url);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      // curl_setopt($ch, CURLOPT_REFERER, $url);
      // $html = curl_exec($ch);
      // curl_close($ch);
      // $html = base64_encode($html);
      //
      // $host = "voe";
      // $api_endpoint = "http://62.171.133.46:1339/api/v1/$host";
      // $auth = '{"auth":"","skk":"test"}';
      // $auth = base64_encode($auth);
      // $params = array(
      //     "source" => $html,
      //     "auth" => $auth
      // );
      // $params = json_encode($params);
      // $ch = curl_init($api_endpoint);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLINFO_HEADER_OUT, true);
      // curl_setopt($ch, CURLOPT_POST, true);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
      // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      //     'Content-Type: application/json',
      //     'Content-Length: ' . strlen($params)
      // ));
      // $result = curl_exec($ch);
      // curl_close($ch);
      // if ($result)
      // {
      //     $result = json_decode($result);
      //     $url = $result->url;
      //     return $url;
      //
      // }


}
