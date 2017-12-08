<?php
require_once __DIR__ . "/../app/routes.php";
mphj_import([__DIR__ . '.!.app.http.controller.*']);
mphj_import([__DIR__ . '.!.app.http.middleware.*']);





App\Config::init();
App\Storage::init();
try {
    DB::init();
}catch (\Exception $e) {
}
?>
