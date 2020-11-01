<?php
    ob_start();
    session_start();

    //Database details
    define ('DBHOST', 'localhost');
    define ('DBUSER', 'root');
    define ('DBPASS', '');
    define ('DBNAME', 'balogun_blog');

    //Create database connection
    $db = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //set timezone- West Africa Standard Time
    // date_default_timezone_set('West Africa Standard Time');


    //autoload
                             
    function __autoload($className){

        $className = strtolower($className);

        //if call within assets adjust the path
        $classpath = 'classes/class.'. $className . '.php';
        if(file_exists($classpath)){
            require_once($classpath);
        }

        //if call within admin adjust the path
        $classpath = '../classes/class.'. $className .'.php';
        if(file_exists($classpath)){
            require_once($classpath);
        }

        //if call within assets adjust the path
        $classpath = '../../classes/class.'. $className . '.php';
        if(file_exists($classpath)){
            require_once($classpath);
        }

    };

    $user = new User($db);

?>
