<?php
namespace App;


class Storage{
    private static $dir = null;

    public static function put($fileName, $fileContent){
        $dir = self::$dir . $fileName;
        file_put_contents($dir, $fileContent);
    }


    public static function get($fileName){
        return file_get_contents(self::$dir . $fileName);
    }

    public static function init(){
        self::$dir = __DIR__ . '/../../../app/storage/app/';
    }

    public static function exists($fileName){
        return file_exists(self::$dir . $fileName);
    }

    public static function delete($fileName){
        unlink(self::$dir . $fileName);
    }

    public static function getDir(){
        return self::$dir;
    }

    public static function listDir($dir = ''){
        if ($dir == ''){
            return glob(substr(self::$dir, 0, strlen(self::$dir) - 1));
        }
        return glob(self::$dir . $dir);
    }

    public static function deleteDir($dir){
        deleteDir(self::$dir . $dir);
    }
}