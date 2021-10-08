<?php 

class Calculator{

    public function calc($op, $varA="", $varB=""){
        if(is_string($op) == false || is_int($varA) == false || is_int($varB) == false){
            return "You must enter a string and two numbers.<br>";
        }
        if($op != "+" && $op != "-" && $op != "*" && $op != "/"){
            return "Invalid operator.";
        }
        switch($op)
        {
            case"+":
                return "The sum of the numbers is ".($varA + $varB).".<br>";
            case"-":
                return "The difference of the numbers is ".($varA - $varB).".<br>";
            case"*":
                return "The product of the numbers is ".($varA * $varB).".<br>";
            case"/":
                if($varB == 0){
                    return "Cannot divide by zero.<br>";
                }
                else{
                    return "The division of the numbers is ".($varA / $varB).".<br>";
                }
        }
    }
}

?>