<?php

require_once('Classes/StickyForm.php');
$stickyForm = new StickyForm();

function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    if($postArr['masterStatus']['status'] == "error"){
        return getForm("",$postArr);
  
    }

    require_once('Classes/PdoMethods.php');

    $result = array();
    $pdo = new PdoMethods();
    $sql = "SELECT * FROM admins WHERE uEmail = '{$_POST['uEmail']}'";
    $stuff = "";

    $result = $pdo->selectNotBinded($sql);

    if($result == "error"){
        return getForm("<p>There was a problem validating the email address</p>", $elementsArr);
    }
    else if(empty($result)){
        return getForm("<p>Login credentials incorrect</p>", $elementsArr);
    }
    else if($result[0]['Passwd'] === $_POST['Passwd']){
        //return getForm("<p>Yep</p>", $elementsArr);
        session_start();
        $_SESSION['Access'] = "Granted";
        $_SESSION['uStatus'] = $result[0]['uStatus'];
        $_SESSION['uName'] = $result[0]['uName'];
        header('location: index.php?page=welcome');
    }
    else{
        return getForm("<p>Login credentials incorrect</p>", $elementsArr);
    }
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
    else {
      return getForm("", $elementsArr);
    } 
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
    "masterStatus"=>[
      "status"=>"noerrors",
      "type"=>"masterStatus"
    ],
    "uEmail"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"adm1n@crimes.biz",
        "regex"=>"email"
    ],
    "Passwd"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank and must be a valid password.</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"b@dpassword",
        "regex"=>"passwd"
    ]
];

/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=login">
        <div class="form-group">
            <label for="email">Email{$elementsArr['uEmail']['errorOutput']}</label>
            <input type="text" id="email" class="form-control" name="uEmail" value="{$elementsArr['uEmail']['value']}">
        </div>
        <div class="form-group">
            <label for="password">Password{$elementsArr['Passwd']['errorOutput']}</label>
            <input type="password" id="password" class="form-control" name="Passwd" value="{$elementsArr['Passwd']['value']}">
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    
HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>