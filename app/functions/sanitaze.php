<?php

function sanitaze($value){
    return strip_tags($value);
}
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
