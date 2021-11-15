<?php
require_once 'listFilesProc.php';
$out = "";
$FP = new listFilesProc;
$out = $FP->retrieve();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Project 7</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>List Files</h1>
        </header>
        <a href="http://russet.wccnet.edu/~awinder/Project7/proj7.php">Add File</a>
        <br>
        <?php echo $out; ?>
    </div>
</body>