<?php 
    require_once('includes/config.php');

    $stmt = $db->prepare('SELECT id, articleTitle, articleDes, articleContent, articleDate FROM balogun_blog_ WHERE id = :id');
    $stmt->execute(array(
        ':id' => $_GET['id']
    ));
    $row = $stmt->fetch();

    if($row['id'] == ''){
        header('Location: index.php');
        exit;
    }

    include('admin/head.php');
?>

    <title> <?php echo $row['articleTitle']; ?> -Balogun Blog </title>

<?php include('admin/header.php'); ?>

    <div class="container">
        <div class="content">
            <?php
                echo'<div>';
                    echo '<h1>' . $row['articleTitle'] . '</h1>';
                    echo '<p>' .date('jS M Y', strtotime($row['articleDate'])) . '</p>';
                    echo '<p>' . $row['articleContent'] . '</p>';
                echo '</div>';
            ?>
        </div>
    </div>
<?php include('admin/footer.php'); ?>