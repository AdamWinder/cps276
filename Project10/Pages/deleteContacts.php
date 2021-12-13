<?php
function init(){

    require_once('Classes/PdoMethods.php');

    if(isset($_POST['delete'])){
        if(isset($_POST['chkbx'])){
            $error = false;
            foreach($_POST['chkbx'] as $id){
                $pdo = new PdoMethods();

                $sql = "DELETE FROM contacts WHERE ID=:id";
                
                $bindings = [
                    [':id', $id, 'int'],
                ];


                $result = $pdo->otherBinded($sql, $bindings);

                if($result === 'error'){
                    $error = true;
                    break;
                }
            }
        }
    }
    
    $output = "";
    
    $pdo = new PdoMethods();

    /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
    $sql = "SELECT * FROM contacts";

    $records = $pdo->selectNotBinded($sql);

    if(count($records) === 0){
        $output = "<p>There are no records to display</p>";
        return [$output,""];
    }
    else {
        $output = "<form method='post' action='index.php?page=deleteContacts'>";
        $output .= "<input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
    <thead>
        <tr>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Phone</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Contact</th>
        <th>Age</th>
        <th>Delete</th>
        </tr>
    </thead><tbody>";

    foreach($records as $row){
        $output .= "<tr><td>{$row['cName']}</td>
        <td>{$row['cAdd']}</td>
        <td>{$row['cCity']}</td>
        <td>{$row['cState']}</td>
        <td>{$row['cPhone']}</td>
        <td>{$row['cEmail']}</td>
        <td>{$row['cDOB']}</td>
        <td>{$row['cCont']}</td>
        <td>{$row['cRange']}</td>
        <td><input type='checkbox' name='chkbx[]' value='{$row['ID']}' /></td></tr>";
    }

    $output .= "</tbody></table></form>";

    if(isset($error)){
        if($error){
            $msg = "<p>Could not delete the contact(s)</p>";
        }
        else {
            $msg = "<p>Contact(s) deleted</p>";
        }
    }
    else {
        $msg="";
    }
    return [$msg, $output];
    }
}