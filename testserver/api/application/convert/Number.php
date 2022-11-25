<?php

error_reporting(0);

class Number {

 public $number, $out, $inn;

public function __construct( $number,  $out,  $inn){
    $this->number = $number;
    $this->out = $out;
    $this->inn = $inn;
}


// перевод в римские цифры
function GoToRim(){
$a = $this->number;
$str = strrev((string)$a); 
$res = "";

// функция для разбиения на разряды
function razryad($b){
    if($b)
        return $b;
    else 
        return 0;
}
$a1 = razryad($str[0]);// единицы
$a2 = razryad($str[1]);// десятки
$a3 = razryad($str[2]);// сотни
$a4 = floor($a / 1000);// тысячи

// функция для перевода единиц/десятков/сотен
function number(&$res, $a1, $let1, $let5){
    if($a1 >= 5)
  {
  $res=$res.$let5;//echo($let5);
  for($i = 0; $i < $a1 - 5; $i++)
  $res=$res.$let1;//echo($let1);
  }
    else if ($a1 == 4)
    $res=$res.$let1.$let5;//echo($let1.$let5);
    else 
    for($i = 0; $i < $a1; $i++)
    $res=$res.$let1;//echo($let1);

     //print_r($res);
}

$I = 'I'; $V = 'V';// единицы
$X = 'X'; $L = 'L';// десятки
$C = 'C'; $D = 'D';// сотни

for($i = 0; $i < $a4; $i++)
$res=$res."M";//echo('M');
number($res, $a3, $C, $D);
number($res, $a2, $X, $L);
number($res, $a1, $I, $V);
//print_r($res);
return $res;
}


// перевод римских в арабские
function OutFromRim(){

$str = $this->number;

$s = 0;

for($i = 0; $i < strlen($str); )
{
    // тысячи
if($str[$i] == 'M')
$s += 1000;

// сотни
else  if($str[$i] == 'C' && $str[$i+1] == 'D')
{$s+= 400; $i+=1;}
else if($str[$i] == 'C')
$s+= 100;
else if($str[$i] == 'D')
$s += 500;

// десятки
else  if($str[$i] == 'X' && $str[$i+1] == 'L')
{$s+= 40; $i+=1;}
else if($str[$i] == 'X')
$s+= 10;
else if($str[$i] == 'L')
$s += 50;

// единицы
else  if($str[$i] == 'I' && $str[$i+1] == 'V')
{$s+= 4;  $i+=1;}
else if($str[$i] == 'I')
$s+= 1;
else if($str[$i] == 'V')
$s += 5;

$i++;
}
return $s;
}


// перевод системы счисления 
function convert(){
    if ($this->out !="rim" &&  $this->inn !="rim")
    
    {
    //print_r(base_convert($this->number,  $this->out,  $this->inn));
    return base_convert($this->number,  $this->out,  $this->inn);
    }

    else if ($this->out == "rim")
    {
       //print_r(base_convert($this->OutFromRim(),  10,  $this->inn));
       return base_convert($this->OutFromRim(),  10,  $this->inn);
    }
    
    else if($this->inn == "rim")
    {
        $this->number = base_convert($this->number,  $this->out,  10);
       return $this->GoToRim();
    }
    
    
}

}
