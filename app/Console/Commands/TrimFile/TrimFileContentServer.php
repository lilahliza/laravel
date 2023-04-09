<?php

namespace App\Console\Commands\TrimFile;


use Illuminate\Console\Command;
# use Illuminate\Support\Str;
# use Illuminate\Support\Facades\Cache;
# use Illuminate\Support\Facades\Redis;


class TrimFileContentServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:trim_file_content_server {--env=} {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '你猜';

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
     * @return int
     */
    public function handle()
    {

        // php artisan command:trim_file_content_server
        $file = $this->option('file') ?$this->option('file'):'';
        echo "--file--" . $file;
        
        
    }
    

    public function writerLogRecorcd($file_path='',$fileName='',$data){
        $fileTypePath = 'env_';
        $file_path = storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d'). DIRECTORY_SEPARATOR . $fileTypePath);
        $fileName =  'env.log';
        if (!is_dir($file_path)) {
            mkdir($file_path, 0755, true);
            chmod($file_path, 0755);
        }
        $filePath = $file_path. DIRECTORY_SEPARATOR .$fileName;
        file_put_contents($filePath, date('Y-m-d H:i:s') . '  ' . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . PHP_EOL,FILE_APPEND);
    }



}
