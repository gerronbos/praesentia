<?php

function trueorfalse($bool){
    if($bool){
        return '<span class="label label-success">Ja</span>';
    }
    return '<span class="label label-danger">Nee</span>';


}

function presenttrueorfalse($bool){
    if($bool){
        return '<span class="label label-success">Aanwezig</span>';
    }
    return '<span class="label label-danger">Afwezig</span>';


}