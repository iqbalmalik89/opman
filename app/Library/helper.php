<?php


function p($data, $die = 1)
{
    echo "<pre>";
    print_r($data);
    if($die)
        die();
}