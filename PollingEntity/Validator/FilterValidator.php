<?php
namespace PollingEntity\Validator;
try {
	if(file_exists("/vendor/autoload.php"))
		require "/vendor/autoload.php";
	else{
		if(file_exists("../vendor/autoload.php"))
		require "../vendor/autoload.php";
	}

} catch (Exception $e) {
}
use Zend\Filter;
use Zend\Validator;

class FilterValidator {

	private $genericFilter;

	public function __construct(){
		$this->genericFilter=new Filter\FilterChain();
		$this->genericFilter->attach(new Filter\StringTrim())
			->attach(new Filter\StripTags());
	}

	public function MyFilter($element){
		return $this->genericFilter->filter($element);
	}


	public function registerNewClientValidation($data){
		   	$validatorChain= new Validator\Regex(array("pattern"=>"/^[a-z0-9\s-!?()éè&àùê'.]{5,150}$/i"));
		   	$validatorChain2= new Validator\ValidatorChain ();
			$validatorChain2->attach(
			new Validator\StringLength(array('min'=>8,
				'max' => 50)))
			   ->attach(new Validator\EmailAddress());

		   	$validationIssue=false;

			 if($validatorChain2->isValid($data['suivi-client-register-email']))
			 {
			   			if($validatorChain->isValid($data['suivi-client-register-name']) && $validatorChain->isValid($data['raison-client-register-selection']))
						{
							$validatorChain->setPattern('/^[a-z0-9_-]{8,25}$/i');
							if($validatorChain->isValid($data['suivi-client-register-login']))
								{
									$validatorChain->setPattern('/^([0-9]{2}){4}$/');
									if($validatorChain->isValid($data['suivi-client-register-phone']))
									   $validationIssue=true;
								}
						}



			  }
					return $validationIssue;

	}

		public function loginValidation($data){
		$validatorChain= new Validator\Regex(array('pattern'=>'/^[a-z0-9_-]{8,25}$/i'));
		   					$validationIssue=false;
		   					if($validatorChain->isValid($data))
		   						$validationIssue = true;
			return $validationIssue;
	}

			public function tokenValidation($data){
		$validatorChain= new Validator\Regex(array('pattern'=>'/^[a-z0-9]{20,100}$/i'));
		   					$validationIssue=false;
		   					if($validatorChain->isValid($data))
		   						$validationIssue = true;
			return $validationIssue;
	}

			public function flexFileValidator($data){
		$validatorChain= new Validator\Regex(array('pattern'=>"/^([a-z0-9]){20,150}\.pdf$/i"));
		   					$validationIssue=false;
		   					if($validatorChain->isValid($data))
		   						$validationIssue = true;
			return $validationIssue;
	}

	public function statusValidation($data){
				$validatorChain= new Validator\Regex(array('pattern'=>'/^[1-4]$/'));
		   					$validationIssue = false;
		   					if($validatorChain->isValid($data))
		   					$validationIssue = true;
			return $validationIssue;
	}



	public function TextAreaValidation($data){
				$validatorChain= new Validator\Regex(array("pattern"=>"/^([a-z0-9\s-!?()éè&àùê'./]){2,150}$/i"));
		   					$validationIssue = false;
		   					if($validatorChain->isValid($data))
		   					$validationIssue = true;
			return $validationIssue;
	}

		public function TagValidator($data){
				$validatorChain= new Validator\Regex(array('pattern'=>'/^[0-9]{1,9}$/'));

		   					$validationIssue = false;
		   					if($validatorChain->isValid($data) && $data>0)
		   					$validationIssue = true;
		   				
			return $validationIssue;
	}

	public function NewsletterValidation($element){
		$validatorChain= new Validator\ValidatorChain ();
			$validatorChain->attach(
			new Validator\StringLength(array('min'=>8,
				'max' => 50)))
			   ->attach(new Validator\EmailAddress());

		   	$validationIssue=false;
		   	if($validatorChain->isValid($element))
			$validationIssue=true;

			return $validationIssue;
	}

	public function switchInput($element){
			$validatorChain = new Validator\Regex(array('pattern'=>'/^[0-9]{1,9}$/'));
			$validationIssue=false;
				if($validatorChain->isValid($element))
					$validationIssue=true;
				return $validationIssue;

	}





}