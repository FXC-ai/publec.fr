<?php
namespace OCFram;

class ValidatorNotNull
{
	protected $validation, $msgError = '';
	
	public function __construct($value, $msgError)
	{
		if (!$this->isValid($value)) {
			$this->setMsgError($msgError);
		}
	}
	
	public function isValid($value)
	{
		$this->validation = $value != '';
	}
	
	public function validation()
	{
		return $this->validation;
	}
	
	public function msgError()
	{
		return $this->msgError;
	}
	
	public function setMsgError($msgError)
	{
		if(is_string($msgError) && !empty($msgError)){
			$this->msgError = $msgError;
		}
	}
}