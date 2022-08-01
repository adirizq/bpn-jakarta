<?php
function checkNull($value) {
    if(isset($value)){
        return $value;
    } else {
        return "No Data";
    }
}

function checkNullCategory($value) {
    if(isset($value)){
        return $value->name;
    } else {
        return "No Data";
    }
}