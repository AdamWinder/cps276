<?php

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;

	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "phone": return $this->phone($value); break;
			case "address": return $this->address($value); break;
			case "city": return $this->city($value); break;
            case "email": return $this->email($value); break;
            case "dob": return $this->dob($value); break;
            case "passwd": return $this->passwd($value); break;
		}
	}


		
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		return $this->setError($match);
	}

	private function phone($value){
		$match = preg_match('/^\d{3}\.\d{3}.\d{4}$/', $value);
		return $this->setError($match);
	}

    private function address($value){
        $match = preg_match("/^[0-9]+ [a-z-]+ [a-z-\.]+$/i", $value);
        return $this->setError($match);
    }

    private function city($value){
        $match = preg_match("/^[a-z-]+$/i", $value);
        return $this->setError($match);
    }

    private function email($value){
        $match = preg_match("/^\w+[+.w-]*@([w-]+.)*\w+[w-]*.([a-z]{2,4}|\d+)$/i", $value); //Regular expression came from https://www.formget.com/regular-expression-for-email/.
        return $this->setError($match);
    }

    private function dob($value){
        $match = preg_match("/^(?:0[1-9]|1[012])(?:[\/])(?:0[1-9]|[12]\d|3[01])(?:[\/])(?:19|20)\d\d$/", $value); //Lightly-edited version of regular expression found here: https://regexpattern.com/date-of-birth/.
        return $this->setError($match);
    }

    private function passwd($value){
        $match = preg_match("/^[a-zA-Z0-9!@#$%&*.,-_=+]{5,25}$/", $value);
        return $this->setError($match);
    }

	
	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}


	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
}