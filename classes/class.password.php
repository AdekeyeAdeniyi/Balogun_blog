<?php
    if(!defined('PASSWORD_DEFAULT')){
        define('PASSWORD_BCRYPT', 1);
        define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);
    }

    class Password{
        public function __construct(){}

        function password_hash($password, $algo, array $options = array()){
            if(!function_exists('crypt')){
                trigger_error('Crypt must be loaded for password_hash to function', E_USER_WARNING);
                return null;
            }

            if(!is_string($password)){
                trigger_error('Password_hash(): Password must be a string', E_USER_WARNING);
                return null;
            }
        }
    }