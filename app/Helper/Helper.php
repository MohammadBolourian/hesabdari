<?php

use App\Lib\Jdf;
use Morilog\Jalali\Jalalian;

function myTime()
{
    $Jdf = new Jdf();
    $time = [$Jdf->jdate('l'),
        $Jdf->jdate('j'),
        $Jdf->jdate('F'),
        $Jdf->jdate('Y'),];
    return $time;
}


function jalaliDate($date, $format = '%A, %d %B %Y')
{
    return Jalalian::forge($date)->format($format);
}




