<?php

if ( ! function_exists('numeric_format')) {
    function numeric_format($val)
    {
        $number = str_replace(",", "", $val);

        if (is_numeric($number)) {
            $number = number_format($number, 8);
            $number = preg_replace('/\.0+$/', '', $number);
            $number = preg_replace('/(\.[0-9]*?)0+$/', "$1", $number);
        }
        return $number;
    }
}
