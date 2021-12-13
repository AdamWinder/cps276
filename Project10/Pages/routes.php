<?php


$path = "index.php?page=login";
session_start();
if(!isset($_GET['page']) || $_GET['page'] == "login"){
    $_SESSION['Access'] = "";
    require_once('Pages/login.php');
    $nav = "<header><h1>Login</h1></header>";
    $result = init();
}
else if((isset($_GET['page'])) && ($_SESSION['Access'] === "Granted")){

    $nav=<<<HTML
    <nav>
        <ul class="inline-list">
            <li><a href="index.php?page=welcome">Welcome</a></li>
            <li><a href="index.php?page=addContact">Add Contact</a></li>
            <li><a href="index.php?page=deleteContacts">Delete contact(s)</a></li>

HTML;

    if($_SESSION['uStatus'] === "Staff"){
        $nav .= '<li><a href="index.php?page=logout">Logout</a></li></ul></nav>';
    }
    else if($_SESSION['uStatus'] === "Admin"){
        $nav .= '<li><a href="index.php?page=addAdmin">Add Admin</a></li><li><a href="index.php?page=deleteAdmins">Delete Admin(s)</a></li><li><a href="index.php?page=logout">Logout</a></li></ul></nav>';
    }

    if($_GET['page'] === "welcome"){
        require_once('Pages/welcome.php');
        $result = init();

    }

    else if($_GET['page'] === "addContact"){
        require_once('Pages/addContact.php');
        $nav .= "<header><h1>Add Contact</h1></header>";
        $result = init();
    }
    
    else if($_GET['page'] === "deleteContacts"){
        require_once('Pages/deleteContacts.php');
        $nav .= "<header><h1>Delete Contact(s)</h1></header>";
        $result = init();
    }

    else if(($_GET['page'] === "addAdmin") && $_SESSION['uStatus'] === "Admin"){
        require_once('Pages/addAdmin.php');
        $nav .= "<header><h1>Add Admin</h1></header>";
        $result = init();

    }

    else if(($_GET['page'] === "addAdmin") && $_SESSION['uStatus'] === "Staff"){
        require_once('logout.php');
        $result = init();

    }

    else if(($_GET['page'] === "deleteAdmins") && $_SESSION['uStatus'] === "Admin"){
        require_once('Pages/deleteAdmins.php');
        $nav .= "<header><h1>Delete Admin(s)</h1></header>";
        $result = init();

    }

    else if(($_GET['page'] === "deleteAdmins") && $_SESSION['uStatus'] === "Staff"){
        require_once('logout.php');
        $result = init();

    }

    else if($_GET['page'] === "logout"){
        require_once('logout.php');
        $result = init();

    }

    else{
        require_once('Pages/welcome.php');
        $result = init();
    }
}
else{
    require_once('Pages/login.php');
    $nav = "<header><h1>Login</h1></header>";
    $result = init();
}



?>