<?php

$id=1496747;
$appid='1cea8275b0bac40fc1699eadff2b0435';
$units="metric";
$ip="api.openweathermap.org/data/2.5/weather";

$f=$ip.'?id='.$id.'&APPID='.$appid.'&units='.$units;
$date=date("j. m. Y");

function startup($f)
  {
	  $dataset=file_get_contents("http://$f");
	file_put_contents('cache.txt', $dataset);
  }

startup($f);

$datum= file_get_contents('cache.txt');
$data=json_decode($datum, true);


$sky=$data['weather'][0]['main'];
switch($sky):
    case 'Clouds':
        ?><img src='clouds.jpeg'><br/><?php
        $sky=' Облочно';
        break;
    case 'Rain':
        ?><img src='rain.jpg'><br/><?php
        $sky= 'Дождь';
        break;
    case 'Clear':
        ?><img src='clear.jpg'><br/><?php
        $sky=' Ясно';
        break;
endswitch;
 
 $tempData=$data['main']['temp'];
$temp=null;
  if($tempData>0){
      $temp= '+'.$tempData;
 }else{
      $temp= $tempData;
 };
  
 $press=$data['main']['pressure'];
 $pres=floor($press/1.333224);//перевод гПА в мм.рт.ст

include "weather.html";
