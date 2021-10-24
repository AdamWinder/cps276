<?php

class Directories{

    public function check(){
        if(is_dir("directories/{$_POST['dir']}")){
            return 1; //Returning 1 means that the directory already exists.
        }
        else if(!mkdir("directories/{$_POST['dir']}/", 0777, true)){
            return 2; //Returning 2 means that the directory could not be created.
        }
        $file = fopen("./directories/{$_POST['dir']}/readme.txt", "w");
        fwrite($file, $_POST["cont"]);
        fclose($file);
        return $_POST['dir'];
    }
}


?>