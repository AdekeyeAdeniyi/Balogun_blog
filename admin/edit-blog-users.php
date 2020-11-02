<?php   
    require_once('../includes/config.php');

    if(!$user->is_logged_in()){
        header('Location: login.php');
    }
?>

<?php include('head.php'); ?>
    <title> Edit User- Balogun Blog </title>
    <?php include('header.php'); ?>

    <div class="content">
        <h2> Edit User </h2>

            <?php
                if(isset($_POST['submit'])){

                    extract($_POST);

                    if($username == ''){
                        $errors[] = 'Please enter the username';
                    }

                    if(strlen($password) > 0){
                        if($password == ''){
                            $errors[] = 'Please enter the password';
                        }

                        if($passwordConfirm == ''){
                            $errors[] = 'Please confirm the password';
                        }

                        if($password != $passwordConfirm){
                            $errors[] = 'Passwords do not match';
                        }
                    }

                    if($email == ''){
                        $errors[] = 'Please enter thr email address';
                    }

                   if(!isset($error)){
                       try{
                            if(isset($password)){
                                $hashedpassword = $user->create_hash($password);

                                $stmt = $db->prepare('UPDATE balogun_blog_users SET username = :username, password = :password, email = :email WHERE id = :id');
                                $stmt->execute(array(
                                    ':username' => $username,
                                    ':password' => $hashedpassword,
                                    ':email' => $email,
                                    ':id' => $id
                                ));
                            }else{

                                $stmt = $db->prepare('UPDATE balogun_blog_users SET username = :username, email = :email WHERE id = :id');
                                $stmt->execute(array(
                                    ':username' => $username,
                                    ':email' => $email,
                                    ':id' => $id
                                ));
                            }

                            header('Location: blog-users.php?action=updated');
                            exit;
                       } catch(PDOException $e){
                           echo $e->getMessage();
                       }
                   }
                }
            ?>

            <?php
                if(isset($errors)){
                    foreach($errors as $error){
                        echo $error . '<br>';
                    }
                }

                try {

                    $stmt = $db->prepare('SELECT id, username, email FROM balogun_blog_users WHERE id = :id');
                    $stmt->execute(array('id' => $_GET['id']));
                    $row = $stmt->fetch();
                } catch(PDOException $e){
                    echo $e->getMessage();
                }
            ?>
        <form action="#" method="post">
                <div class="form-group">
                    <input type="hidden" name='id' value="<?php echo $row['id']; ?>">
                </div>
                <div class="form-group">
                    <label for="username"> Username </label>
                    <input type="text" name="username" value="<?php echo $row['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="password"> Password (only to change) </label>
                    <input type="password" name="password" value="">
                </div>
                <div class="form-group">
                    <label for="password"> Confirm Password </label>
                    <input type="password" name="passwordConfirm" value="">
                </div>
                <div class="form-group">
                    <label for="email"> Confirm Password </label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>">
                </div>

                <input type="submit" name="submit" value="Update" >
        </form>
    </div>

    <?php include('footer.php'); ?>