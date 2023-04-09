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
        echo "--file--" . $file . PHP_EOL;
        $infoFile = pathinfo($file);
        var_dump( '-pathinfo-' , $infoFile);
//         array(4) {
//           ["dirname"]=>
//           string(4) "./sh"
//           ["basename"]=>
//           string(11) "exec_env.sh"
//           ["extension"]=>
//           string(2) "sh"
//           ["filename"]=>
//           string(8) "exec_env"
//         }
        $time = time();
        $prex = 'zhu_wannian@163.com';
        
        $file_tmp_path = $infoFile['dirname'] . DIRECTORY_SEPARATOR . md5($time . $prex ) . $infoFile['basename'];

        $rowData = $this->readFileRows($file);
        foreach($rowData as $line=>$v){
            var_dump( $line . '====>>>>>>>' . $v);
            echo '-手动换行-' . PHP_EOL;
            file_put_contents($file_tmp_path, $v . PHP_EOL,FILE_APPEND);
        }
        unlink($file);
        rename($file_tmp_path,$file);
        
        
        
    }
    public function readFileRows($filePath)
    {
        $rowsList = [];
        //打开一个文件
        $file = fopen($filePath,"r");
        $i = 0;
        //检测指正是否到达文件的未端
        while(!feof($file))
        {
            $i ++;
            $rowLine = trim(fgets($file));
            # yield 生成一个键值对 https://www.twle.cn/c/yufei/phpmiss/phpmiss-basic-yield.html
            yield $i => $rowLine;
            # $rowsList[] = $rowLine;
        }
        //关闭被打开的文件
        fclose($file);
        echo "-关闭被打开的文件-" . PHP_EOL;
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
