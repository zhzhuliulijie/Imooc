<?php


class Cat
{
    public $name = "咪咪";
    public $gender = null;

    public function jiao()
    {
        echo "喵~喵~~~喵~~~~~~";
    }

    public function pao()
    {
        echo '你来追我呀~~~';
    }

    public function show()
    {
        echo '我叫'.$this->name;
        echo $this->jiao();
        echo $this->pao();
    }
}

$c1 = new Cat();

//var_dump($c1);
//$c1->pao();
//echo $c1 -> name;
//$c1 -> gender = '女';
//echo $c1 -> gender;
//$c1 -> jiao();
//$c1 -> pao();
$c1 -> show();
