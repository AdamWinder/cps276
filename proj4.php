<?php

$output = "";

if(count($_POST) > 0){
    require_once 'Names.php';
    $NL = new nameList;
    $output = $NL->doStuff();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Project 4</title>
</head>
<body>
    <div class="container">
        <header><h1>Add Names</h1></header>
        <form method="post" action="#">
            <div>
                <button type="submit" class="btn btn-primary" name="add">Add Name</button>
                <button type="submit" class="btn btn-primary" name="clear">Clear Names</button>
            </div>
            <label for="name" class="form-label">Enter Name</label>
            <input type="text" class="form-control" id="name" name="name">
            <label for="namelist">List of Names</label>
         <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php echo $output; ?></textarea>
        </form>
    </div>
</body>