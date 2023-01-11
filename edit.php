<?php
require_once('includes/db.php');
require_once('includes/functions.php');
try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {                                       // This updates the data sent via POST method
        $title = prep_data($_POST['title']);
        $content = prep_data($_POST['content']);
        $important = prep_data($_POST['important']);
        $id = prep_data($_POST['id']);

        $sql = "UPDATE notes SET ";
        $sql .= "title ='" . $title . "', ";
        $sql .= "content ='" . $content . "', ";
        $sql .= "important ='" . $important . "' ";
        $sql .= "WHERE id ='" . $id . "'";
        $sql .= "LIMIT 1";


        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
        }
    }
} catch (Exception $e) {
    echo "Update failed " . $e->getMessage();
}
try {
    if (!isset($_GET['id'])) {
        header("Location: index.php");
    }
} catch (Exception $e) {
    echo "Redirect failed " . $e->getMessage();
}
try {
    $id = $_GET['id'];   // Get this from index.php before the form is submitted
    $sql = "SELECT * FROM notes WHERE id = '" . $id . "' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $note = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
} catch (Exception $e) {
    echo "Query execution failed " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Notes</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<header>
    Notes
</header>

<div class="titleDiv">
    <div class="backLink"><a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></div>
</div>
<form action="edit.php" method="post">
    <input type="hidden" name="id" value=<?php echo $note['id']; ?>>
    <span class="label"></span>
    <input type="text" name="title" value=<?php echo $note['title'];
                                            ?> />

    <span class="label"></span>
    <textarea name="content"><?php echo $note['content'];
                                ?>
            </textarea>

    <div class="chkgroup">
        <span class="label-in">Important</span>
        <input type="hidden" name="important" value="0" />
        <input type="checkbox" name="important" value="1" <?php if ($note['important']) {
                                                                echo "checked";
                                                            }  ?> />
    </div>

    <input type="submit" />

</html>