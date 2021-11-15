<?php
$output = "";

if(count($_POST) > 0){
    require_once 'fileUploadProc.php';
    $UP = new fileUploadProc;
    $output = $UP->check();
}
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
            <h1>File Upload</h1>
        </header>
        <a href="http://russet.wccnet.edu/~awinder/Project7/flist.php">Show File List</a>
        <br>
        <p><?php echo $output; ?></p>
        <form method="post" action="#" enctype="multipart/form-data">
            <div>
                <label for="fname" class="form-label">File Name</label>
                <input type="text" class="form-control" name="fname" id="fname">
                <br>
                <input type="file" class="form-control" include=".pdf" name="infile">
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>