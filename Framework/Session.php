<?php 

namespace Framework;

class Session{

    public static function start_session(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;

    }

    public static function get($key, $default=null){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;

    }

    public static function has($key){
        return isset($_SESSION[$key]);
    }

    public static function clear($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }

    public static function clearAll(){
        session_unset();
        session_destroy();
    }

    public static function isOwner($id){
        //check if there is a user and an array of user
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['user'])) {
            return false;
        }
        
        // create variable
        $session_user = $_SESSION['user']['user'];

        // check if is false
        if (!isset($session_user->user_id)) {
            return false;
        }

        // check id's
        return (int)$session_user->user_id === (int)$id;
        
    }
}


?>