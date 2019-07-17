<?php

class Dog
{
    public static $name = '小花';
    const age = 12;
}

Dog::$name = '小草';
echo Dog::$name;
echo Dog::age;

?>
