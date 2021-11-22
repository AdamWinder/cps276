<?php
require_once 'PdoMethods.php';
date_default_timezone_set('UTC');

class noteAddProc{
    private $out = "";
    public function addNote(){
        $PM = new PdoMethods;
        $TS = strtotime($_POST['dateTime']);
        $Note = $_POST['note'];
        $SQL = "INSERT INTO note_list ( DT, Note ) values ( {$TS}, '{$Note}' );";

        $this->out = $PM->otherNotBinded($SQL);
        if($this->out == "error"){
            return "Could not add note.";
        }
        else{
            return "Note has been added.";
        }
    }
}

?>