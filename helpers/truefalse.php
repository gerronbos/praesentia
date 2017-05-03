<?php

function trueorfalse($bool){
    if($bool){
        return '<span class="label label-success">Ja</span>';
    }
    return '<span class="label label-danger">Nee</span>';


}