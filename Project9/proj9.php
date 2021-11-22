<?php
    require_once 'Classes/noteAddProc.php';
    date_default_timezone_set('UTC');
    $out = "";

    if(count($_POST) > 0){
        $AP = new noteAddProc;
        $out = $AP->addNote();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Project 9</title>
</head>
<body>
    <div class="container">
        <header><h1>Add Note</h1></header>
        <p><a href="noteList.php">Display Notes</a></p>
        <p><?php echo $out; ?></p>
        <form method="post" action="#">
            <label for="dataTime" class="form-label">Date and Time</label>
            <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
            <br>
            <label for="note" class="form-label">Note</label>
            <textarea class="form-control" id="note" name="note" style="height: 500px;"></textarea>
            <br>
            <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
        </form>
    </div>
</body>