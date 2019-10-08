<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constellation;

class ConstellationController extends Controller
{
	public $constellations_url = [
		'http://astro.click108.com.tw/daily_0.php?iAstro=0',
		'http://astro.click108.com.tw/daily_1.php?iAstro=1',
		'http://astro.click108.com.tw/daily_2.php?iAstro=2',
		'http://astro.click108.com.tw/daily_3.php?iAstro=3',
		'http://astro.click108.com.tw/daily_4.php?iAstro=4',
		'http://astro.click108.com.tw/daily_5.php?iAstro=5',
		'http://astro.click108.com.tw/daily_6.php?iAstro=6',
		'http://astro.click108.com.tw/daily_7.php?iAstro=7',
		'http://astro.click108.com.tw/daily_8.php?iAstro=8',
		'http://astro.click108.com.tw/daily_9.php?iAstro=9',
		'http://astro.click108.com.tw/daily_10.php?iAstro=10',
		'http://astro.click108.com.tw/daily_11.php?iAstro=11',
	];

    public function index() {

    	$constellations = Constellation::where('today_date', '=', date("Y-m-d"))->get();

    	return view('Constellation.index', compact('constellations'));

    }

    public function store() {

    	$curl = curl_init();
    	for($i=0; $i<12; $i++) {
    		curl_setopt($curl, CURLOPT_URL, $this->constellations_url[$i]);
   			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   			$htmlresult = curl_exec($curl);
   			preg_match_all('/<h3>今日(.*?)解析<\/h3>\\r\\n/', $htmlresult, $name);
   			preg_match_all('!<span class="txt_green">(.*?)：<\/span>!', $htmlresult, $a_score);
    		preg_match_all("!：<\/span><\/p><p>(.*?)<\/p>\\r\\n!", $htmlresult, $description);
    		preg_match_all('/<span class="txt_pink">(.*?)：<\/span>/', $htmlresult, $l_score);
    		preg_match_all('/<span class="txt_blue">(.*?)：<\/span>/', $htmlresult, $w_score);
    		preg_match_all('/<span class="txt_orange">(.*?)：<\/span>/', $htmlresult, $f_score);
    		Constellation::create([
    			'today_date' => date("Y-m-d"),
    			'constellation_name' => $name[1][0],
    			'all_score' => $a_score[1][0],
    			'all_description' => $description[1][0],
    			'love_score' => $l_score[1][0],
    			'love_description' => $description[1][1],
    			'work_score' => $w_score[1][0],
   				'work_description' => $description[1][2],
    			'fortune_score' => $f_score[1][0],
    			'fortune_description' => $description[1][3]
    		]);
    	}

    }

}
