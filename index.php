<?php
require __DIR__ . "/vendor/loader.php";
require __DIR__ . "/vendor/apploader.php";


$views = __DIR__ . '/app/views';
$cache = __DIR__ . '/app/storage/cache';
$blade = new bladeone\BladeOne($views,$cache);
App\View::init($blade);


App\Request::init();
Route::start();
