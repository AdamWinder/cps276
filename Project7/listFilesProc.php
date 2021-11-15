<?php
require_once 'PdoMethods.php';

class listFilesProc{
    private $DBR = array();
    private $out = "<ul>";
    private $sql = "SELECT * FROM files";
    
    public function retrieve(){
        $PM = new PdoMethods;
        $this->DBR = $PM->selectNotBinded($this->sql);
        foreach($this->DBR as $row){
            $this->out .= '<li><a target="_blank" href="http://russet.wccnet.edu/'.$row["fPath"].'">'.$row["fName"].'</a></li>';
        }
        return $this->out."</ul>";
    }
}
?>