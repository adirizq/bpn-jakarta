<?php
function checkNull($value)
{
    if (isset($value)) {
        return $value;
    } else {
        return "No Data";
    }
}

function checkNullCategory($value)
{
    if (isset($value)) {
        return $value->name;
    } else {
        return "No Data";
    }
}

function checkNullData($value)
{
    if (isset($value)) {
        return $value->id;
    } else {
        return null;
    }
}
