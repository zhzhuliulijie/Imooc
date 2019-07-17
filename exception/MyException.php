<?php

class MyException extends Exception{}

class Test
{
    const THROW_NONE = 0;
    const THROW_CUSTOM = 1;
    const THROW_DEFAULT = 2;

    public function run()
    {
        try{
//            throw new MyException('',self::THROW_NONE);
            throw new MyException('文件没有权限',1);
        }catch (MyException $e){
            switch ($e->getCode()){
                case self::THROW_NONE:
                    echo '';
                case self::THROW_CUSTOM:
                    echo $e->getMessage();
                case self::THROW_DEFAULT:
                    echo $e->getTraceAsString();
            }
        }
    }
}

$tt = new Test();

$tt->run();

