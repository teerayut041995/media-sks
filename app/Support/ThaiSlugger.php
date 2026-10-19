<?php

namespace App\Support;

class ThaiSlugger
{
    public static function slug($string, $separator)
    {
        $string = preg_replace('/[^a-z0-9ก-๙เแ]/i', '-', $string);
        $string = preg_replace('/-+/', '-', $string);

        return preg_replace('/-$|^-/', '', $string);
    }
}
