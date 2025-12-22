<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("test",function () {
    $data = ['name' => 'Laravel', 'version' => '10.x'];
    // 方式1：直接 echo/print
    echo "数组内容：" . print_r($data, true) . PHP_EOL;

    // 方式2：使用 Laravel 命令行输出方法（推荐，带颜色）
    $this->info('格式化输出数组：');
    // $this->table(['键', '值'], $data); // 表格化输出
    $this->line(print_r($data, true)); // 普通输出 
});
