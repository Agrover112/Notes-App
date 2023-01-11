<?php

require_once('includes/db.php');
require_once('includes/functions.php');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = prep_data($_POST['title']);
        $content = prep_data($_POST['content']);
        $important = prep_data($_POST['important']);

        $sql = "INSERT IGNORE INTO notes (title,content,important) VALUES('";
        $sql .= $title . "','" . $content . "','" . $important . "')";

        //echo $sql; 

        if (mysqli_query($conn, $sql)) {
            //echo "Insertion successful";
        }
    }
} catch (Exception $e) {
    echo "Insertion failed " . $e->getMessage();
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
    New Note
</header>

<div class="titleDiv">
    <div class="backLink"><a class="nav-link" href="index.php"> <i class="fa fa-home" aria-hidden="true"></i></a></div>
</div>
<form action="new.php" method="post">

    <span class="label"></span>
    <input type="text" name="title" />

    <span class="label"></span>
    <textarea name="content"> </textarea>

    <div class="chkgroup">
        <span class="label-in">Important</span>
        <input type="hidden" name="important" value="0" />
        <input type="checkbox" name="important" value="1" />
    </div>

    <input type="submit" />

</html>