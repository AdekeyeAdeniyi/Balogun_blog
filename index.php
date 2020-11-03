<?php 
    require_once('includes/config.php'); 
    
    include('admin/head.php');
?>

    </title> Balogun Blog </title>

<?php include('admin/header.php'); ?>

    <div class="container">
        <div class="content">
            <?php
                try{
                    $stmt = $db->query('SELECT id, articleTitle, articleDes, articleContent, articleDate FROM balogun_blog_ ORDER BY id DESC');
                    while($row = $stmt->fetch()){
                        echo '<div>';
                            echo '<h1><a href="show.php?id=' . $row['id'] . '">'. $row['articleTitle'] . '</a></h1>';
                            echo '<p> Posted on ' .date('jS M Y', strtotime($row['articleDate'])) . '</p>';
                            echo '</p>'. $row['articleDes'] .'</p>';
                            echo '<button><a href="show.php?id='. $row['id'] .'"> Read More </a></button>';
                        echo '</div>';
                    }
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
            ?>
        </div>
    </div>
<?php include('admin/footer.php');
