<?php 
/**
 * There have some custom functions in this file  
 */

// Set the default timezone
date_default_timezone_set('Asia/Dhaka');

/**
 *  In form this will return the Old value of a input
 *
 * @param string $key
 * @param object|null $object
 * @return string
 */
function get_old_value(string $key, $object = null  ){
    if (isset($_POST[$key])) {
        return esc($_POST[$key]);
    }elseif(is_object($object)){
        return esc($object->$key);
    }
    return '';
}

/**
 * In form this function returns 'selected' as string if the $key is selected by $value 
 * 
 * @param string $key
 * @param string $value
 * @param object|null $object
 * @return string
 */
function get_selected( $key, $value, $object = null ){
    if ( isset($_POST[$key])) {
        if ( $_POST[$key] == $value) {
            return 'selected';
        }
    }elseif(is_object($object)){
        $object->$key;
        if ($object->$key == $value ) {
            return 'selected';
        }
    }
    return '';
}

/**
 * In form this will return the error of the input field 
 * 
 * @param array $errors
 * @param string $key
 * @return string
 */
function get_error( $errors, $key){
    if ( isset($errors[$key])) {
        return  $errors[$key];

    }else{
        return '';
    }
}

/**
 * This will retun a random string which length is $length 
 *
 * @param integer $length
 * @return string
 */
function random_string( $length){

    $array = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
    $text = '';

    for ($i=0; $i < $length; $i++) { 
        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}

/**
 * This will returns a human readable date
 *
 * @param string $date
 * @return string 
 */
function get_date($date){

    return date( 'jS M, Y h:i:sa' , strtotime($date));
}

/**
 * This will return string of a data which is in DB. But it will be in htmlspecialchars() function
 *
 * @param string $var
 * @return string 
 */
function esc(string $var){
    return htmlspecialchars($var);
}

/**
 * In url which item user is visiting currently the item will be defined as active.
 * So this function will return 'active' as string to put it in class attributes.
 *
 * @param string $url
 * @return string
 */
function get_active_item(string $url){
    if ( isset($_GET['url']) && ($_GET['url'] == $url) ) {
        return 'active';
    }
    return '';
}

/**
 * Somewhere it may have some tabs. But to specify the tab it is needed to have something.
 * So this function will return 'active' as string to put it in class attributes. 
 *
 * @param string $thisTab
 * @param string $currentTab
 * @return string
 */
function get_active_tab(string $thisTab, string $currentTab ){
    if ($thisTab == $currentTab) {
        return 'active';
    }
    return '';
}

/**
 * This returns the full path of view file.
 * @param string $view Write only the file name.
 * @return string 
 */
function view_path($view){
    if (file_exists('private/views/'.$view.'.view.php')) {
        return 'private/views/'.$view.'.view.php';
    }else {
        return 'private/views/404.view.php';
    }
}

/**
 * Get image link by providing name only
 *
 * @param string $image_name
 * @param object|null $user
 * @return string
 */
function get_image( $image_name, $user = null ){
    $image_file = 'assets/uploads/'.$image_name ;
    if ((!file_exists($image_file)) || ($image_name == '') ) {
        if (is_object($user)) {
            if ($user->gender == 'male') {
                $image = ROOT.'assets/img/user_male.jpg';
            }else {
                $image = ROOT.'assets/img/user_female.jpg';
            }
        }else{
            // $image = 
        }
    }else{
        $image = ROOT. 'assets/uploads/'.$image_name;
    }

    return $image;
}