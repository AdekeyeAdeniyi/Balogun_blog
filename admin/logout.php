<?php
    require_once ('../includes/config.php');

    // log out user
    $user->logout();

    header('Location: index.php');

?>