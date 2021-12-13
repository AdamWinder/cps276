<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('Classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */

    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    require_once('Classes/PdoMethods.php');

    $result = "";
    $pdo = new PdoMethods();
    $sql = "SELECT uEmail FROM admins WHERE uEmail = '{$_POST["uEmail"]}'";

    $result = $pdo->selectNotBinded($sql);
  
    if($result == "error"){
      return getForm("<p>Could not validate email address</p>", $elementsArr);
    }
    else if(count($result) > 0){
      return getForm("<p>An administrator already exists with this email address</p>", $elementsArr);
    }

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      return addData($_POST);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
      return getForm("",$postArr);
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
	"uName"=>[
	    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Gary Adminson",
		"regex"=>"name"
	],
    "uEmail"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Gary@this.net",
        "regex"=>"email"
    ],
    "Passwd"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank and must be a valid password.</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"garbage",
        "regex"=>"passwd"
    ],
    "uStatus"=>[
        "type"=>"select",
        "options"=>["Staff"=>"Staff", "Admin"=>"Admin"],
        "selected"=>"Staff",
        "regex"=>"name"
    ]
/*  "financial"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select at least one financial option</span>",
    "errorOutput"=>"",
    "type"=>"checkbox",
    "action"=>"required",
    "status"=>["cash"=>"", "check"=>"", "credit"=>""]
  ],
  "eyeColor"=>[
    "action"=>"notRequired",
    "type"=>"radio",
    "value"=>["blue"=>"", "brown"=>"", "hazel"=>"", "green"=>"", "other"=>""]
  ]*/
];


/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){
  global $elementsArr;  
  /* IF EVERYTHING WORKS ADD THE DATA HERE TO THE DATABASE HERE USING THE $_POST SUPER GLOBAL ARRAY */
      //print_r($_POST);

      $pdo = new PdoMethods();
      $sql = "INSERT INTO admins ( uName, uEmail, Passwd, uStatus ) VALUES (:name, :email, :passwd, :status)";

      /* THIS TAKE THE ARRAY OF CHECK BOXES AND PUT THE VALUES INTO A STRING SEPERATED BY COMMAS  */
      /*if(isset($_POST['financial'])){
        $financial = "";
        foreach($post['financial'] as $v){
          $financial .= $v.",";
        }
        $financial = substr($financial, 0, -1); //Remove the last comma from the contacts.
      }

      if(isset($_POST['eyeColor'])){
        $eyeColor = $_POST['eyeColor'];
      }
      else {
        $eyeColor = "";
      }*/

      /*if(isset($_POST['cCont'])){
        $contact = "";
        foreach($post['cCont'] as $v){
          $contact .= $v.",";
        }
        $contact = substr($contact, 0, -1); //Remove the last comma from the contact preferences.
      }

      if(isset($_POST['cRange'])){
          $range = $_POST['cRange'];
      }
      else{
          $range = "";
      }*/

      $bindings = [
        [':name',$post['uName'],'str'],
        [':email',$post['uEmail'],'str'],
        [':passwd',$post['Passwd'],'str'],
        [':status',$post['uStatus'], 'str']
        //[':financial',$financial,'str'],
        //[':eye',$eyeColor,'str']
      ];

      $result = $pdo->otherBinded($sql, $bindings);

      if($result == "error"){
        return getForm("<p>There was a problem processing your form</p>", $elementsArr);
      }
      else {
        return getForm("<p>Contact Information Added</p>", $elementsArr);
      }
      
}
   

/*THIS IS THEGET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['uStatus']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=addAdmin">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['uName']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="uName" value="{$elementsArr['uName']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">Email Address{$elementsArr['uEmail']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="uEmail" value="{$elementsArr['uEmail']['value']}" >
    </div>
    <div class="form-group">
      <label for="passwd">Password{$elementsArr['Passwd']['errorOutput']}</label>
      <input type="password" class="form-control" id="passwd" name="Passwd" value="{$elementsArr['Passwd']['value']}" >
    </div>
    <div class="form-group">
        <label for="status">Status</label>
	    <select class="form-control" name="uStatus" id="status">
			$options
		</select>
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