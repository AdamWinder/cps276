<?php

$output = "";

if(count($_POST) > 0){
    require_once 'Directories.php';
    $ND = new Directories;
    $output = $ND->check();

    switch ($output){
        case 1:
            $output = "A directory already exists with that name.";
            break;
        case 2:
            $output = "Could not create directory.";
            break;
        default:
            $output = 'File and directory were created.</p><p><a href="http://137.184.79.158/cps276/Project5/directories/'.$output.'/readme.txt">Path where file is located</a>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Project 5</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>File and Directory Assignment</h1>
            <p>Enter a folder name and the contents of a file. Folder names should contain alpha numeric characters only.</p>
            <p><?php echo $output?></p>
        </header>
        <form method="post" action="#">
            <div>
                <label for="dir" class="form-label">Folder Name</label>
                <input type="text" class="form-control" id="dir" name="dir">
                <br>
                <label for="cont" class="form-label">File Content</label>
                <textarea style="height: 250px;" class="form-control" id="cont" name="cont"></textarea>
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>