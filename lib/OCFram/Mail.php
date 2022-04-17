<?php
namespace OCFram;

class Mail
{

	protected $subject, $message, $destinataire, $expediteur;
	
	public function sendMail ($param) {
		
		mail($this->destinataire, $this->subject, $this->expediteur);
	}
	
	public function setSubject($subject)
	{
		if (!is_string($subject) || empty($subject)) {
			;
		}
	}
	
}


