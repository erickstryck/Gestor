<?php

class DataIntervalo
{

    function __construct()
    {

    }


    public static function dias($date)
    {
        return date('Y/m/d', strtotime('+1 day', strtotime($date)));
    }

    public static function semanas($date)
    {
        return date('Y/m/d', strtotime('+1 week', strtotime($date)));
    }

    public static function quinzenas($date)
    {
        return date('Y/m/d', strtotime('+15 days', strtotime($date)));
    }

    public static function meses($date)
    {
        return date('Y/m/d', strtotime('+1 month', strtotime($date)));
    }

    public static function bimestres($date)
    {
        return date('Y/m/d', strtotime('+2 months', strtotime($date)));
    }

    public static function trimestres($date)
    {
        return date('Y/m/d', strtotime('+3 months', strtotime($date)));
    }

    public static function semestres($date)
    {
        return date('Y/m/d', strtotime('+6 months', strtotime($date)));
    }

    public static function anos($date)
    {
        return date('Y/m/d', strtotime('+1 year', strtotime($date)));
    }

}