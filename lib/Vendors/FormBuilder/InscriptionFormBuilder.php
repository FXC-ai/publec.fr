<?php
namespace FormBuilder;

use OCFram\MailField;
use OCFram\PasswordField;
use \OCFram\StringField;
use \OCFram\MaxLengthValidator;
use OCFram\NotNullValidator;
use OCFram\FormBuilder;

class InscriptionFormBuilder extends FormBuilder
{
	public function build()
	{
		$this->form->add(new StringField([
				'label' => 'Nom ',
				'name' => 'Nom',
				'maxLength' => 60,
				'validators' => [
						new MaxLengthValidator('Le nom spécifié est trop long (60 caractères maximum)', 60),
						new NotNullValidator('Merci de spécifier votre nom'),
				],
		]))
		->add(new StringField([
				'label' => 'Prenom ',
				'name' => 'Prenom',
				'maxLength' => 60,
				'validators' => [
						new MaxLengthValidator('Le prénom spécifié est trop long (60 caractères maximum)', 60),
						new NotNullValidator('Merci de spécifier votre prénom'),
				],
		]))
		->add(new MailField([
				'label' => 'Mail ',
				'name' => 'email',
				'validators' => [
						new NotNullValidator('Merci de remplir une adresse mail valide'),
				],
		]))
		
		->add(new PasswordField(['label' => 'Mot de Passe ', 'name' => 'password', 'validators' => [new NotNullValidator('Merci de choisir un mot de passe')]]));
	}
}