<?php

$rows = 15;
$cells = 5;

function bld_tbl($r,$c){
    $str_out = '<table border ="1">';
    for($i=1;$i<=$r;$i++){
        $str_out .= "<tr>";
        for($j=1;$j<=$c;$j++){
            $str_out .= "<td>Row {$i} Cell {$j}</td>";
        }
        $str_out .= "</tr>";
    }
    $str_out .= "</table>";
    return $str_out;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Exercise 3</title>
</head>
<body>
    <?php echo bld_tbl($rows,$cells); ?>
</body>