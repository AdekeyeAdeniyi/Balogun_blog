<?php
    require_once('../includes/config.php');

    if(!$user->is_logged_in()){
        header('Location: login.php');
    }
?>
<?php include('head.php'); ?>
    <title> Balogun Blog </title>
    <?php include('header.php'); ?>
    
<div class="content">
    <h2> Add User </h2>

    <?php
        //if form has been subitted
        if(isset($_POST['submit'])){
            extract($_POST);

            if($username == ''){
                $errors[] = 'Please enter the username';
            }

            if($password == ''){
                $errors[] = 'Please enter the password';
            }

            if($passwordConfirm == ''){
                $errors[] = 'Please confrim the password';
            }

            if($password != $passwordConfirm){
                $errors[] = 'Password do not match';
            }

            if(!isset($errors)){
                $hashedpassword = $user->create_hash($password);
                
                try{

                    //insert into database
                    $stmt = $db->prepare('INSERT INTO balogun_blog_users (username,password,email) VALUES (:username, :password, :email)');
                    $stmt->execute(array(
                        ':username' => $username,
                        ':password' => $hashedpassword,
                        ':email' => $email
                    ));
                    //redirect to blog user page
                    header('Location: blog-users.php?action=added');
                    exit;
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        if(isset($errors)){
            foreach($errors as $error){
                echo '<p class="message"> '. $error . '</p>';
            }
        }
    ?>

    <form action="#" method="post">
        <div class="form-group">
            <label for="username"> Username: </label>
            <input type="text" name="username" value="<?php if(isset($error)){ echo $_POST['username']; }?>" />
        </div>
        <div class="form-group">
            <label for="password"> Password: </label>
            <input type="password" name="password" value="<?php if(isset($error)){ echo $_POST['password']; }?>" />
        </div>
        <div class="form-group">
            <label for="passwordConfirm"> Confirm Password: </label>
            <input type="password" name="passwordConfirm" value="<?php if(isset($error)){ echo $_POST['passwordConfirm']; }?>" />
        </div>
        <div class="form-group">
            <label for="email"> email: </label>
            <input type="text" name="email" value="<?php if(isset($error)){ echo $_POST['email']; }?>" />
        </div>

        <input type="submit" name="submit" value="Add User" />
    </form>
</div>
<?php include('footer.php'); ?>