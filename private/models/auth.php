<?php
/**
 * Auth model
 */

class Auth{
    public static function authenticate($row){
        $_SESSION['user'] = $row;
    }

    public static function logout(){
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    public static function is_logged_in(){
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public static function user(){
        if (self::is_logged_in()) {
            return $_SESSION['user'];
        }
        return 'Unknown';
    }
}