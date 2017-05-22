<?php
// Source: http://www.phpdevtips.com/2011/06/the-php-time-ago-function/

function time_ago( $date )
{
    if(empty($date)){
        return "No date provided";
    }

    $periods = array("second", "minuut", "uur", "dag", "week", "maand", "jaar", "eeuw");
    $lengths = array("60","60","24","7","4.35","12","10");
    $now = time();
    $unix_date = strtotime( $date );

    // check validity of date
    if(empty($unix_date)){
        return "Incorrect date";
    }

    // is it future date or past date
    if($now > $unix_date){
        $difference = $now - $unix_date;
        $tense = "geleden";
    }else{
        $difference = $unix_date - $now;
        $tense = "vanaf nu";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++){
        $difference /= $lengths[$j];
    }

    $difference = round( $difference );

    if($difference != 1){
        $periods = array("second", "minut", "ur", "dag", "wek", "maand", "jar", "eeuw");
        $periods[$j].= "en";
    }

    return "$difference $periods[$j] {$tense}";
}