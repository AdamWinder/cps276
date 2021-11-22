<?php
require_once 'Classes/noteListProc.php';
date_default_timezone_set('UTC');
$out = "";

if(count($_POST) > 0){
    $LP = new noteListProc;
    $out = $LP->listNotes();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Display Notes</title>
</head>
<body>
    <div class="container">
        <header><h1>Display Notes</h1></header>
        <p><a href="proj9.php">Add Note</a></p>
        <form method="post" action="#">
            <label for="begDate" class="form-label">Beginning Date</label>
            <input type="date" class="form-control" id="begDate" name="begDate">
            <br>
            <label for="endDate" class="form-label">Ending Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
            <br>
            <button type="submit" class="btn btn-primary" name="submit">Get Notes</button>
            <br>
        </form>
        <div>
            <?php echo $out; ?>
        </div>
    </div>
</body>