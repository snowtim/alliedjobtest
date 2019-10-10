<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class TestLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:Log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[測試] Log 檔案';

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
        // 檔案紀錄在 storage/test.log
        $log_file_path = storage_path('test.log');

        // 記錄當時的時間
        $log_info = [
            'date'=>date('Y-m-d H:i:s')
        ];

        // 記錄 JSON 字串
        $log_info_json = json_encode($log_info) . "\r\n";

        // 記錄 Log
        File::append($log_file_path, $log_info_json);
    }
}
