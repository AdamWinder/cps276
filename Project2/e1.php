<?php

$ml = 4;
$sl = 5;

function nst_lst($m,$s){
    $str_out = "<ul>";
    for($i=1;$i<=$m;$i++){
        $str_out .= "<li>{$i}<ul>";
        for($j=1; $j<=$s; $j++){
            $str_out .= "<li>{$j}</li>";
        }
        $str_out .= "</ul></li>";
    }
    $str_out .= "</ul>";
    return $str_out;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Exercise 1</title>
</head>
<body>
    <?php echo nst_lst($ml,$sl); ?>
</body>