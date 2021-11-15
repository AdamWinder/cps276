<?php
require_once 'PdoMethods.php';

class fileUploadProc{
    private $out = "";
    public function check(){
        if(filesize($_FILES["infile"]["tmp_name"]) > 100000){
            return "File is too big.";
        }
        else if(mime_content_type($_FILES["infile"]["tmp_name"]) != "application/pdf"){
            return "File must be PDF type.";
        }
        $PM = new PdoMethods;
        $sql = "INSERT INTO files ( fName, fPath ) values ( '{$_POST['fname']}', '~awinder/Project7/Files/newsletterorform1.pdf' )";
        $this->out = $PM->otherNotBinded($sql);

        if($this->out == "error"){
            return "There was an error accessing the database.";
        }
        else{
            return "File has been added";
        }
    }
}

?>