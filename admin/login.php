<?php
    require_once('../includes/config.php');


    if($user->is_logged_in()){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" type="text/css" href="assests/style.css" />

</head>
<body>
    <form action="#" method="post" class="adminForm" id="adminForm">
        <div class="form-group">
            <lable for="username"> Username: </label>
            <input type="text" name="username" value="" required />
        </div>
        <div class="form-group">
            <lable for="password"> Password: </label>
            <input type="password" name="password" value="" required />
        </div>

        <input type="submit" name="submit" value="Sign In" />
    </form>
</body>
</html>

<?php
    //Login form for submit
    if(isset($_POST['submit'])){

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if($user->login($username, $password)){

            //If logged in, the redirect to index page
            header('Location: index.php');
        }else{
            $message = '<p class ="invalid"> Invalid username or password </p>';
        }
    }

    if(isset($message)){
        echo $message;
    }
?>