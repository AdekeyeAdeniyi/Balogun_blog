<?php
    require_once('../includes/config.php');

    if(!$user->is_logged_in()){
        header('Location: login.php');
    }