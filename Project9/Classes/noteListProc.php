<?php
require_once 'PdoMethods.php';
date_default_timezone_set('UTC');

class noteListProc{
    private $out = "";

    public function listNotes(){
        $DBR = array();
        $GD = array();
        $Beg = strtotime($_POST['begDate']);
        $End = strtotime($_POST['endDate']);
        $PM = new PdoMethods;
        $SQL = "SELECT * FROM note_list WHERE DT BETWEEN {$Beg} AND {$End};";

        $DBR = $PM->selectNotBinded($SQL);

        if($DBR == "error"){
            return "<p>Error listing notes.</p>";
        }
        else if(empty($DBR)){
            return "<p>No notes to display.</p>";
        }
        else{
            $this->out .= "<table border='1' class='table table-bordered table-striped'><tr><th>Date and Time</th><th>Note</th>";
            foreach($DBR as $Row){
                $GD = getdate($Row['DT']);
                $this->out .= "<tr><td>{$GD['mon']}/{$GD['mday']}/{$GD['year']} ";

                if($GD['hours'] > 12){
                    $GD['hours'] -= 12;
                    $this->out .= "{$GD['hours']}:{$GD['minutes']} pm</td><td>{$Row['Note']}</td></tr>";
                }
                else if($GD['hours'] == 12){
                    $this->out .= "{$GD['hours']}:{$GD['minutes']} pm</td><td>{$Row['Note']}</td></tr>";
                }
                else{
                    $this->out .= "{$GD['hours']}:{$GD['minutes']} am</td><td>{$Row['Note']}</td></tr>";
                }
            }
            $this->out .= "</table>";
            return $this->out;
        }
    }
}

?>