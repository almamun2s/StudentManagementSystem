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