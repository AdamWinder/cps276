<?php

class nameList{
    private $names = array();

    private function addName(){
        $person = array(
            "fname" => "",
            "lname" => "",
        );
        $this->names = explode("\n", $_POST["namelist"]);
        list($person["fname"], $person["lname"]) = explode(" ", $_POST["name"]);
        $person["lname"] .= ", ".$person["fname"];
        array_push($this->names, $person["lname"]);

        if(array_count_values($this->names) > 1){
            sort($this->names);
        }
    }

    private function clearNames(){
        $empty = array();
        $this->names = $empty;
    }

    public function doStuff(){
        if(isset($_POST["add"])){
            $this->addName();
        }
        if(isset($_POST["clear"])){
            $this->clearNames();
        }
        $out = "\0";
        foreach($this->names as $ind){
            $out .= $ind."\n";
        }
        return $out;
    }
}

?>