<?php
/**
 * Auth model
 */

class Auth{
    /**
     * Main Login function
     * @param array $row
     */
    public static function authenticate($row){
        $_SESSION['user'] = $row;
    }

    /**
     * Main Logout function
     */
    public static function logout(){
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
    }

    /**
     * Checks if user is logged in or not
     *
     * @return boolean
     */
    public static function is_logged_in(){
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    /**
     * Gives logged in user's data
     *
     * @return object|array|string
     */
    public static function user(){
        if (self::is_logged_in()) {
            return $_SESSION['user'];
        }
        return 'Unknown';
    }

    /**
     * Access function
     * It limits user access by their role
     * The lowest rank is 'student'
     * 
     * @param string $role write your role here
     * @return boolean
     */
    public static function access( $role = 'student' ){
        if (!self::is_logged_in()) {
            return false;
        }
        
        $RANK['super']      = ['super', 'admin', 'reception', 'lecturer', 'student'];
        $RANK['admin']      = ['admin', 'reception', 'lecturer', 'student'];
        $RANK['reception']  = ['reception', 'lecturer', 'student'];
        $RANK['lecturer']   = ['lecturer', 'student'];
        $RANK['student']    = ['student'];

        if (!isset($RANK[self::user()->role])) {
            return false;
        }
        if (in_array($role, $RANK[self::user()->role])) {
            return true;
        }
        return false;
    }
}