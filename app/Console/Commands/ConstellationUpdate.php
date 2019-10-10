<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Constellation;
use App\Http\Controllers\ConstellationController;

class ConstellationUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update information of constellation every hour';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $curl = curl_init();
        $c_url = new ConstellationController;
        for($i=0; $i<12; $i++) {
            curl_setopt($curl, CURLOPT_URL, $c_url->constellations_url[$i]);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $htmlresult = curl_exec($curl);
            preg_match_all('/<h3>今日(.*?)解析<\/h3>\\r\\n/', $htmlresult, $name);
            preg_match_all('!<span class="txt_green">(.*?)：<\/span>!', $htmlresult, $a_score);
            preg_match_all("!：<\/span><\/p><p>(.*?)<\/p>\\r\\n!", $htmlresult, $description);
            preg_match_all('/<span class="txt_pink">(.*?)：<\/span>/', $htmlresult, $l_score);
            preg_match_all('/<span class="txt_blue">(.*?)：<\/span>/', $htmlresult, $w_score);
            preg_match_all('/<span class="txt_orange">(.*?)：<\/span>/', $htmlresult, $f_score);

            Constellation::where('constellation_name', '=', $name[1][0])->update([
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
