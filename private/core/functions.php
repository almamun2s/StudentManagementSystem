<?php 

function get_old_value($key){
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return '';
}

function get_selected($key, $value){
    if ( isset($_POST[$key])) {
        if ( $_POST[$key] == $value) {
            return 'selected';
        }
    }
    return '';
}

function get_error(array $errors,  $key){
    if ( isset($errors[$key])) {
        return  $errors[$key];

    }else{
        return '';
    }
}

function random_string(int $length){

    $array = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
    $text = '';

    for ($i=0; $i < $length; $i++) { 
        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}