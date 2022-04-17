<?php
namespace FormBuilder;

use OCFram\FormBuilder;
use OCFram\MailField;
use OCFram\NotNullValidator;
use OCFram\PasswordField;

Class ConnexionFormBuilder extends FormBuilder
{
	Public function build()
	{
		$mail = new MailField([
        	'label' => 'E-mail ',
        	'name' => 'email',
        	'validators' => [new NotNullValidator('Veuillez entrer une adresse mail !')],
       ]);
		
		$password = new PasswordField(['label' => 'Mot de Passe ', 'name' => 'password', 'validators'=>[new NotNullValidator('Veuillez entrer un mot de passe !')]]);
		
		$this->form->add($mail);
		$this->form->add($password);
	}
}