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
	"cName"=>[
	    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Joe Randy",
		"regex"=>"name"
	],
    "cAdd"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Cannot be blank and must be a valid address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"123 Street St.",
        "regex"=>"address"
    ],
    "cCity"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>City cannot be blank and must be a standard city</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"Backwash",
        "regex"=>"city"
    ],
    "cState"=>[
        "type"=>"select",
        "options"=>["Michigan"=>"Michigan","Hawaii"=>"Hawaii","New York"=>"New York","Washington"=>"Washington","Oklahoma"=>"Oklahoma"],
        "selected"=>"Michigan",
        "regex"=>"name"
    ],
	"cPhone"=>[
		"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a valid phone number</span>",
        "errorOutput"=>"",
        "type"=>"text",
	    "value"=>"123.456.7890",
		"regex"=>"phone"
    ],
    "cEmail"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email address</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"jrandy@mail.com",
        "regex"=>"email"
    ],
    "cDOB"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Date of birth cannot be blank and must be a valid date</span>",
        "errorOutput"=>"",
        "type"=>"text",
        "value"=>"12/21/1987",
        "regex"=>"dob"
    ],
    "cCont"=>[
        "action"=>"notRequired",
        "type"=>"checkbox",
        "status"=>["Newsletter"=>"", "Email Updates"=>"", "Text Updates"=>""]
    ],
    "cRange"=>[
        "errorMessage"=>"<span style='color: red; margin-left: 15px;'>You must select an age range.</span>",
        "errorOutput"=>"",
        "action"=>"required",
        "type"=>"radio",
        "value"=>["10-18"=>"", "19-30"=>"", "30-50"=>"", "51 +"=>""]
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
      require_once('Classes/PdoMethods.php');

      $pdo = new PdoMethods();

      $sql = "INSERT INTO contacts ( cName, cAdd, cCity, cState, cPhone, cEmail, cDOB, cCont, cRange ) VALUES (:name, :address, :city, :state, :phone, :email, :dob, :cont, :range)";

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

      $contact = "";
      if(isset($_POST['cCont'])){
        foreach($post['cCont'] as $v){
          $contact .= $v.", ";
        }
        $contact = substr($contact, 0, -1); //Remove the last comma from the contact preferences.
      }

      if(isset($_POST['cRange'])){
          $range = $_POST['cRange'];
      }
      else{
          $range = "";
      }

      $bindings = [
        [':name',$post['cName'],'str'],
        [':address',$post['cAdd'],'str'],
        [':city',$post['cCity'],'str'],
        [':state',$post['cState'],'str'],
        [':phone',$post['cPhone'],'str'],
        [':email',$post['cEmail'],'str'],
        [':dob',$post['cDOB'],'str'],
        [':cont',$contact, 'str'],
        [':range',$range, 'str']
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
$options = $stickyForm->createOptions($elementsArr['cState']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADD THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=addContact">
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['cName']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="cName" value="{$elementsArr['cName']['value']}" >
    </div>
    <div class="form-group">
      <label for="address">Address (just number and street){$elementsArr['cAdd']['errorOutput']}</label>
      <input type="text" class="form-control" id="address" name="cAdd" value="{$elementsArr['cAdd']['value']}" >
    </div>
    <div class="form-group">
      <label for="city">City{$elementsArr['cCity']['errorOutput']}</label>
      <input type="text" class="form-control" id="city" name="cCity" value="{$elementsArr['cCity']['value']}" >
    </div>
    <div class="form-group">
        <label for="state">State</label>
	    <select class="form-control" name="cState" id="state">
			$options
		</select>
    </div>
    <div class="form-group">
      <label for="phone">Phone (format 999.999.9999) {$elementsArr['cPhone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="cPhone" value="{$elementsArr['cPhone']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">Email Address{$elementsArr['cEmail']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="cEmail" value="{$elementsArr['cEmail']['value']}" >
    </div>
    <div class="form-group">
      <label for="dob">Date of birth{$elementsArr['cDOB']['errorOutput']}</label>
      <input type="text" class="form-control" id="dob" name="cDOB" value="{$elementsArr['cDOB']['value']}" >
    </div>

    <p>Please check all contact types you would like (optional):</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="cCont[]" id="newsletter" value="Newsletter" {$elementsArr['cCont']['status']['Newsletter']}>
      <label class="form-check-label" for="newsletter">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="cCont[]" id="email updates" value="Email Updates" {$elementsArr['cCont']['status']['Email Updates']}>
      <label class="form-check-label" for="email updates">Email Updates</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="cCont[]" id="text updates" value="Text Updates" {$elementsArr['cCont']['status']['Text Updates']}>
      <label class="form-check-label" for="text updates">Text Updates</label>
    </div>

    <p>Please select an age range (you must select one):{$elementsArr['cRange']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cRange" id="10-18" value="10-18"  {$elementsArr['cRange']['value']['10-18']}>
      <label class="form-check-label" for="10-18">10-18</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cRange" id="19-30" value="19-30"  {$elementsArr['cRange']['value']['19-30']}>
      <label class="form-check-label" for="19-30">19-30</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cRange" id="30-50" value="30-50"  {$elementsArr['cRange']['value']['30-50']}>
      <label class="form-check-label" for="30-50">30-50</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cRange" id="51 +" value="51 +"  {$elementsArr['cRange']['value']['51 +']}>
      <label class="form-check-label" for="51 +">51 +</label>
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