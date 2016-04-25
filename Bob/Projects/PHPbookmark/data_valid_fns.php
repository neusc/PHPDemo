<?php
function filledOut($array){
    //test that each variable has a value
    foreach ($array as $key=>$value){
        if (!isset($key) || $value = ""){
            return false;
        }
    }
    return true;
}
function validEmail($address){
    //check that the email is possibly valid
    if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9\-\.]+$', $address)) {
        return true;
    }else {
        return false;
    }
}
