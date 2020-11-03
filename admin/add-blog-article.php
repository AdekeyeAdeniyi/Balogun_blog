<?php
    require_once('../includes/config.php');

    if(!$user->is_logged_in()){
        header('Location: login.php');
    }

?>

    <?php include('head.php'); ?>
        <title> Add New Article </title>
    <?php include('header.php'); ?>
<div class="content">
    <?php
        if(isset($_POST['submit'])){

            extract($_POST);

            if($articleTitle == ''){
                $errors[] = 'Please enter title';
            }
            if($articleDes == ''){
                $errors[] = 'Please enter description';
            }
            if($articleContent == ''){
                $errors[] = 'Please enter content';
            }

            if(!isset($errors)){
                try{
                    $stmt = $db->prepare('INSERT INTO balogun_blog_ (articleTitle,articleDes,articleContent,articleDate) VALUES (:articleTitle,:articleDes,:articleContent,:articleDate)');
                    $stmt->execute(array(
                        ':articleTitle' => $articleTitle,
                        ':articleDes' => $articleDes,
                        ':articleContent' => $articleContent,
                        ':articleDate' => date('Y-m-d H:i:s')
                    ));

                    header('Location: index.php?action=added');
                    exit;
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        if(isset($errors)){
            foreach($errors as $error){
                echo '</p>' . $error . '</p>';
            }
        }
    ?>

    <form action="#" method="post">
        <div class="form-group">
            <label for='articleTitle'> Article Title: </label>
            <input type="text" name="articleTitle" value="<?php if(isset($errors)){ echo $_POST['articleTitle']; }?>"/>
        </div>
        <div class="form-group">
            <label for='articleDes'> Article Description: </label>
            <textarea type="text" name="articleDes" cols="60" rows="4" value="<?php if(isset($errors)){ echo $_POST['articleDes']; }?>"></textarea>
        </div>
        <div class="form-group">
            <label for='articleContent'> Article Content: </label>
            <textarea type="text" name="articleContent" cols="60" rows="8" value="<?php if(isset($errors)){ echo $_POST['articleContent']; }?>"></textarea>
        </div>

        <input type="submit" name="submit" value="Submit" >
    </form>
</div>

<?php include('footer.php'); ?>


    

    