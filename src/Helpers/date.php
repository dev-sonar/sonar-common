<?php
use Carbon\Carbon;

if ( ! function_exists('strtodate') ) {
    function strtodate($date,$format='Y/m/d')
    {
        if ( $date ) {
            return date($format,strtotime($date));
        }
        return null;
    }
}

if ( ! function_exists('ym') ) {
    function ym($ym)
    {
        if ( $ym && $ym > 190001 ) {
            return (floor($ym/100)) . '年' . ( floor($ym%100)) . '月';
        }
        return null;
    }
}

if ( ! function_exists('elapse_days') ) {
    function elapse_days($timestamp)
    {
        return Carbon::createFromTimeStamp($timestamp)->diffInDays(Carbon::now(),false);
    }
}
