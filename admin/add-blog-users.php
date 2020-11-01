<?php
    //if form has been subitted
    if(isset($_POST['submit'])){
        extract($_POST);

        if($username == ''){
            $error[] = 'Please enter the username';
        }

        if($password == ''){
            $erroe[] = 'Please enter the password';
        }

        if($passwordConfirm == ''){
            $error[] = 'Please confrim the password';
        }

        if($password != $passwordConfirm){
            $error[] = 'Password do not match';
        }

        if(!isset($error)){
            $hashedpassword = $user->create_hash($password);

            try{

                //insert into database
                $stmt = $db->prepare('INSERT INTO `balogun_blog_users` `(username, password,email)` VALUES `(:username, :password, :email)`');
                $stmt->execute(array(
                    ':username' => $username,
                    ':password' => $password,
                    ':email' => $email
                ));

                //redirect to blog user page
                header('Location: blog-users.php?action=added');
                exit;
            }catch(PDOException $e){
                echo $e->getMeaasge();
            }
        }
    }