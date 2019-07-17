<?php

class A
{
    public function func1(){
        echo 'OK';
    }
}

class B
{
    public function text(A $m){
        echo "好的";
    }
}

class C extends A
{

}

$obja = new A();
$objc = new C();
$obj = new B();
$obj -> text($objc);
