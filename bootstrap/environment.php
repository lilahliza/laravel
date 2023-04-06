<?php

/*
|--------------------------------------------------------------------------
| Detect The Application Environment
|--------------------------------------------------------------------------
|
| Laravel takes a dead simple approach to your application environments
| so you can just specify a machine name for the host that matches a
| given environment, then we will automatically detect it for you.
|
*/



$envPrefix = '';

// form artisan
if (app()->runningInConsole()) {
    // 运行在命令行下
    foreach ($_SERVER['argv'] as $strArg) {
        if (preg_match("/--env=(.+)/", $strArg, $match) && !empty($match[1])) {
            $envPrefix = $match[1];
            break;
        }
    }
} else {
    // form server
    if (key_exists('SUBDOMAIN', $_SERVER)) {
        $envPrefix = $_SERVER['SUBDOMAIN'];
    }
}

// var_dump('==envPrefix=='.$envPrefix);
// var_dump('==envPrefix-->>env=='.env($envPrefix));

// //判断是否在白名单内
// if (empty($envPrefix) || empty(env($envPrefix))) {
//     //运行在命令行
//     if (app()->runningInConsole()) {
//         die('[error] no environment');
//     } else {
//         $e = '{
//             "code": "0",
//             "msg": "请求不在白名单内"
//         }';
//         die($e);
//     }
// }


$envForme = '.' . $envPrefix . '.env';
//判断文件是否存在
$envPath = __DIR__ . '/../env';
$envPathName = $envPath . '/' . $envForme;

// var_dump('==envPathName==' . $envPathName);
if (file_exists($envPathName)) {

} else {
    //运行在命令行
    if (app()->runningInConsole()) {
        die('[error] no environment');
    } else {
        $e = '{
            "code": "0",
            "msg": "请求不在白名单内"
        }';
        die($e);
    }
}

//自定义env文件路径
$app->useEnvironmentPath(realpath($envPath));

# $app->loadEnvironmentFrom('.prod.env');
$app->loadEnvironmentFrom($envForme);

/**
//加载完整个框架之前重载【指定项目的env】配置文件
$app->afterLoadingEnvironment(function () use ($app) {
    $envPrefix = '';

    // form artisan
    if (app()->runningInConsole()) {
        // 运行在命令行下
        foreach ($_SERVER['argv'] as $strArg) {
            if (preg_match("/--env=(.+)/", $strArg, $match) && !empty($match[1])) {
                $envPrefix = $match[1];
                break;
            }
        }
    } else {
        // form server
        if (key_exists('SUBDOMAIN', $_SERVER)) {
            $envPrefix = $_SERVER['SUBDOMAIN'];
        }
    }

    // if ($_SERVER['SCRIPT_NAME'] == 'artisan') {
    //     foreach ($_SERVER['argv'] as $strArg) {
    //         if (preg_match("/--env=(.+)/", $strArg, $match) && !empty($match[1])) {
    //             $envPrefix = $match[1];
    //             break;
    //         }
    //     }
    // } else {
    //     // form server
    //     if (key_exists('SUBDOMAIN', $_SERVER)) {
    //         $envPrefix = $_SERVER['SUBDOMAIN'];
    //     }
    // }
    var_dump('==envPrefix=='.$envPrefix);
    var_dump('==envPrefix-->>env=='.env($envPrefix));
    //判断是否在白名单内
    if (empty($envPrefix) || empty(env($envPrefix))) {
        //运行在命令行
        if (app()->runningInConsole()) {
            die('[error] no environment');
        } else {
            $e = '{
                "code": "0",
                "msg": "请求不在白名单内"
            }';
            die($e);
        }
    }

    //判断文件是否存在
    $envPath = __DIR__ . '/../env/.' . $envPrefix . '.env';
    if (file_exists($envPath)) {
        $envFile = ".$envPrefix.env";
    } else {
        //运行在命令行
        if (app()->runningInConsole()) {
            die('[error] no environment');
        } else {
            $e = '{
                "code": "0",
                "msg": "请求不在白名单内"
            }';
            die($e);
        }
    }
    //重载env配置文件
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/../env/', $envFile);
    var_dump('==dotenv==',$dotenv);
    $dotenv->overload();
});

*/

