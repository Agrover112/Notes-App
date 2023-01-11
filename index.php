<?php

require_once('includes/db.php');

$sql = "SELECT * FROM notes";
$notes = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html>

<head >
<link href="https://fonts.googleapis.com/css?family=Alex+Brush|Allura|Arizonia|Bad+Script|Berkshire+Swash|Calligraffitti|Caveat|Cedarville+Cursive|Clicker+Script|Cookie|Courgette|Damion|Dancing+Script|Gloria+Hallelujah|Great+Vibes|Herr+Von+Muellerhoff|Indie+Flower|Italianno|Just+Another+Hand|Kaushan+Script|Leckerli+One|Marck+Script|Merienda|Merienda+One|Montez|Mr+Dafoe|Niconne|Nothing+You+Could+Do|Pacifico|Parisienne|Petit+Formal+Script|Pinyon+Script|Rancho|Rochester|Sacramento|Satisfy|Shadows+Into+Light|Tangerine|Yellowtail|Yesteryear|PT+Sans" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Notes</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <header>
        Notes
    </header>
    <div class="back">
        <div>
            <a class="nav-link" href="new.php"><i class="fa fa-plus" aria-hidden="true"></i></a>
        </div>
        <?php
        while ($note = mysqli_fetch_assoc($notes)) {


        ?>
            <div class="note">
                <div class="titleContainer">
                    <span class="nt-title"><?php echo $note['title']; ?></span>
                    <div class="nt-links">
                        <a class="nt-link" href=<?php echo 'edit.php?id=' . $note['id'];  ?>><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="nt-link" href=<?php echo 'delete.php?id=' . $note['id'];  ?>><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="nt-content">
                    <?php 
                    if ($note['important']) 
                    {
                        echo "<span class='fa fa-star' aria-hidden='true'></span> <br>";
                    }
                    else { 
                        echo "<i class='fa fa-star-o' aria-hidden='true'></i><br>";
                    }
                     ?>
                    <?php
                    echo $note['content'];
                    ?>
                </div>
            </div>
        <?php }
        mysqli_free_result($notes);
        ?>
    </div>
</body>

</html>

<?php

require_once('includes/footer.php')
?>