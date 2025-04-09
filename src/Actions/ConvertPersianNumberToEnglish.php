<?php

namespace Rp76\LaravelPack\Actions;

class ConvertPersianNumberToEnglish
{

  public  function handle($string): array|string
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);

        return str_replace($arabic, $num, $convertedPersianNums);
    }
}