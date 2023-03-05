<?php

interface TimeToWordConvertingInterface
{
    public function convert(int $hours, int $minutes):string;
}

 class TimeToWordConverter implements TimeToWordConvertingInterface
 {
    public function convert(int $hours, int $minutes):string
    {   $arrHOUR = ['Один', 'Два', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь', 'Восемь', 'Девять', 'Десять', 'Одиннадцать', 'Двенадцать'];
        $arrMIN = ['Одна', 'Две', 'Три', 'Четыре', 'Пять', 'Шесть', 'Семь', 'Восемь', 'Девять', 'Десять', 'Одиннадцать', 'Двенадцать', 'Тринадцать',
                   'Четырнадцать', 'Пятнадцать', 'Шестнадцать', 'Семнадцать', 'Восемнадцать', 'Девятнадцать', 'Двадцать'];
        $arrMINpart = ['одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'];
        $arrHOURnum = ['первого', 'второго', 'третьего', 'четвертого', 'пятого', 'шестого', 'седьмого', 'восьмого', 'девятого', 'десятого', 'одиннадцатого', 'двенадцатого'];
        $arrHOURpart = ['одного', 'двух', 'трех', 'четырех', 'пяти', 'шести', 'семи', 'восьми', 'девяти', 'десяти', 'одиннадцати', 'двенадцати'];

        switch ($minutes) {
         case 0:
            if ($hours == 1) $str = $arrHOUR[$hours  - 1].' час';
            if (1 < $hours && $hours < 5 ) $str = $arrHOUR[$hours - 1].' часа';
            if (4 < $hours) $str = $arrHOUR[$hours  - 1].' часов';
            $num = $hours.':00';
            break;
         case  15:
         case  30:
            if ($minutes == 15) {
              $str = 'Четверть ';
              $num = $hours.':15';
            }  else {
                $str = 'Половина  ';
                $num = $hours.':30';
               }
            if ($hours == 12) $str .= $arrHOURnum[0];
                else $str .= $arrHOURnum[$hours];
            break;
         default:
            if (9 < $minutes) $num = $hours.':'.$minutes;    
              else $num = $hours.':0'.$minutes; 

            if ($minutes < 21) {
                $minute = $minutes;
                $str = $arrMIN[$minutes - 1];
            } elseif ((60 - $minutes) < 21 ) {
                  $minute = 60 - $minutes;
                  $str = $arrMIN[59 - $minutes];
                  if ($hours == 12) $hours = 0;
                } elseif ($minutes < 30) {
                    $minute = $minutes % 10;
                    $str = $arrMIN[19].' '.$arrMINpart[$minute - 1];
                   } else {
                      $minute = (60 - $minutes) % 10;
                      $str = $arrMIN[19].' '.$arrMINpart[$minute - 1];
                      if ($hours == 12) $hours = 0;
                     }

            if ($minute == 1) $str .= ' минута';
            if (1 < $minute && $minute < 5 ) $str .= ' минуты';
            if (4 < $minute) $str .= ' минут';
            if ($minutes < 30) $str .= ' после '. $arrHOURpart[$hours - 1];
              else $str .= ' до '. $arrHOURpart[$hours];
        }

       $str = $num.' - '.$str.'.';
       return $str;
    }
}

$h = readline();
$m = readline();
$obj = new TimeToWordConverter;
printf($obj->convert($h, $m));