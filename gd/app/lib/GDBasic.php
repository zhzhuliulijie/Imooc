<?php

namespace app\lib;

class GDBasic
{
    protected static $_check;

    public static function check()
    {
        if (static::$_check){
            return true;
        }

        //检查但钱GD库是否存在
        if (!function_exists("gd_info")){
            throw new \Exception('GD is not exists');
        }

        //检查当前GD库版本
        $version = "";
        $info = gd_info(); //2.1.0
        if (preg_match('/\\d+\\.\\d+(?:\\.\\d+)?/', $info['GD Version'], $match)){
            $version = $match[0];
        }

        // 判断当前本版是否小于2.0.1
        if (!version_compare($version, '2.0.1', '>=')){
            throw new \Exception("GD requeires GD version '2.0.1' or greater, you have ".$version);
        }

        self::$_check = true;
        return self::$_check;
    }
}

