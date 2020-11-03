<?php 
    require_once('../includes/config.php'); 

    if(!$user->is_logged_in()){
        header('Location: login.php');
    }
?>

<?php include('head.php'); ?>
    <title> Update Article- Balogun Blog</title>
<?php include('header.php'); ?>

<div class="content">
    <h2> Edit Article </h2>
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
                    $stmt = $db->prepare('UPDATE balogun_blog_ SET articleTitle = :articleTitle, articleDes = :articleDes, articleContent = :articleContent WHERE id = :id');
                    $stmt->execute(array(
                        ':articleTitle' => $articleTitle,
                        ':articleDes'   => $articleDes,
                        ':articleContent'   =>  $articleContent,
                        ':id'   => $id
                    ));

                    header('Location: index.php?action=update');
                    exit;

                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }
    ?>

    <?php
        if(isset($errors)){
            foreach($errors as $error){
                echo'</p>'. $error . '</p>';
            }
        }

        try{
            $stmt = $db->prepare('SELECT id, articleTitle, articleDes, articleContent FROM balogun_blog_ WHERE id = :id');
            $stmt->execute(array( ':id' => $_GET['id']));
            $row = $stmt->fetch();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    ?>

    <form action="#" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="articleTitle"> Article Title </label>
            <input type="text" name="articleTitle" value="<?php echo $row['articleTitle']; ?>">
        </div>
        <div class="form-group">
            <label for="articleDes"> Article Desccription </label>
            <textarea type="text" name="articleDes" cols="60" rows="4"><?php echo $row['articleDes']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="articleContent"> Article Content </label>
            <textarea type="text" name="articleContent" cols="60" rows="8"> <?php echo $row['articleContent']; ?></textarea>
        </div>

        <input type="submit" name="submit" value="Update" />
    </form>
</div>

<?php include('footer.php'); ?>


