<?php
namespace App\FrontendHorsConnexion\Modules\PageAccueil;

use OCFram\BackController;
use OCFram\HTTPRequest;
use Entity\UserEntity;
use Entity\Directory;


class PageAccueilController extends BackController
{
	public function executeIndex (HTTPRequest $request)
	{
		$this->page->addVar('title', 'Publec - Connexion');
		
		if ($request->postExists('formConnexion')) {
				
		
			$reqLogins = array(
					'email' => htmlspecialchars($request->postData('email')),
					'password' => htmlspecialchars($request->postData('password')));
		
			// boucle permettant de réaficher les entrées clients apres chaque chargement de la page
			foreach ($reqLogins as $key => $reqLogin)
			{
				$this->page->addVar($key. 'ReqLog', $reqLogin);
			}	
		
			$formLoginIsValid = $this->FormLoginIsValid($reqLogins);	
		
			if ($formLoginIsValid == TRUE) {
					
				$manager = $this->managers->getManagerOf('Users');
					
				$UserEntityReqLog = new UserEntity($reqLogins);
					
				if ($manager->userExists($UserEntityReqLog->email())) {
					
					$UserEntityDB = $manager->getUser($UserEntityReqLog->email());
					
					if ($UserEntityDB->password() == sha1($UserEntityReqLog->password())) {
						if ($UserEntityDB->activation() == 1) {
							$this->app->user()->setAuthenticated(TRUE);
							$this->app->user()->setAttribute('UserEntity', $UserEntityDB);
							$this->app->httpResponse()->redirect('/mesFichiers.html');
						}
						else {
							$this->app->user()->setFlash('Ce compte n\'a pas été activé. Pour cela il suffit de de cliquer sur le lien d\'activation dans le mail qui vous a été envoyé. Si vous rencontrez un problème
										pour l\'activation de votre compte, contactez le webmaster à cette adresse.');
						}		
					}
					else {
						$this->page->addVar('passwordInvalide', 'Le mot de passe est invalide.');
					}
				}
				else {
					$this->page->addVar('CompteInexistant', 'Aucun compte à l\'adresse e-mail spécifiée.');
				}
			}
		}
	}
	
	public function FormLoginIsValid($reqLogins) {
		$validation = TRUE;
	
		if (empty($reqLogins['email'])) {
			$this->page->addVar('emailReqLogVide', 'Veuillez entrer votre adresse e-mail.');
			$validation = FALSE;
		}
	
		if (empty($reqLogins['password'])) {
			$this->page->addVar('PasswordReqLogVide', 'Veuillez entrer votre mot de passe.');
			$validation = FALSE;
		}
	
		return $validation;
	}
	
	public function executeInscription (HTTPRequest $request)
	{
		
		$this->page->addVar('title', "Publec - Inscription");
		
		if ($request->postExists('formInscription')) {
		
			$reqIscriptions = array(
					'nom' => htmlspecialchars($request->postData('nom')),
					'prenom' => htmlspecialchars($request->postData('prenom')),
					'email' => htmlspecialchars($request->postData('email')),
					'password' => htmlspecialchars($request->postData('password')),
					'checkCGU' => $request->postData('checkCGU'));
			
			// boucle permettant de réaficher les entrées clients apres chaque chargement de la page
			foreach ($reqIscriptions as $key => $reqIscription)
			{
				$this->page->addVar($key. 'ReqIns', $reqIscription);
			}
				
			// verification de la validité de la form
			$formInscriptionValid = $this->FormInscriptionIsValid($reqIscriptions);
				
			if ($formInscriptionValid == TRUE) {
				
				$reqIscriptions['cle'] = sha1(uniqid(rand(),TRUE));//solution : remplacer par uniqid() !!! ATTENTION il est possible, certe peu probable mais possible que 2 utilisateurs ait la même clé d'activation
				$reqIscriptions['dirAuteur'] = uniqid($reqIscriptions['nom'],TRUE);
				
				$UserEntityReq = new UserEntity($reqIscriptions);
		
				$usersManager = $this->managers->getManagerOf('Users');
				$directorysManager = $this->managers->getManagerOf('Directorys');
		
				if ($UserEntityReq->isValid() && !$usersManager->userExists($UserEntityReq->email())) {
					
					$this->SendMail($UserEntityReq);
					
					$usersManager->addUser($UserEntityReq);
					
					$userDirectory = new Directory(array('name'=> $UserEntityReq->dirAuteur(),
														'auteur' => $UserEntityReq->nom(),
														'idAuteur' => $UserEntityReq->id(),
														'dirAuteur' => 'main'
					));
					
					mkdir('../Users/'.$userDirectory->name());
					$directorysManager->add($userDirectory);
					
					$this->app->user()->setFlash('Un mail vous a été envoyé à l\'adresse '.$UserEntityReq->email().'.');
					$this->app->httpResponse()->redirect('.');
				}
				else
				{
					$this->page->addVar('UserConnu', 'Un compte existe déjà à cette adresse e-mail.');
				}
			}
		}	
	}
	
	public function SendMail($userEntityReq)
	{
		//A mettre dans la config du serveur !!!
		//ini_set('SMTP','smtp.orange.fr');
		ini_set("sendmail_from","webmaster@publec.fr");
			
		$headers  = "From: \"PUBLEC\"<webmaster@publec.fr>\n";
	
		$headers .= "Content-Type: text/html; charset=\"utf-8\""; // on indique qu'on a affaire à un email au format html
			
		$sujetMail = 'Confirmation Inscription PUBLEC';//$this->app->config()->get("SujetMailConfirmation");
		$contenuMail = '<p>Bienvenue sur Publec.</p>';//'<p style="color:blue">'.$this->app->config()->get("MsgMailConfirmation").'</p>';
		$contenuMail .= '<p>Pour confirmer votre inscription veuillez <a href="publec.fr/accueil/confirmerInscription-'.$userEntityReq->cle().'.html">cliquer ici.</a></p>';
		$contenuMail .= '<p>Votre nom d\'utilisateur est : '.$userEntityReq->prenom().' '.$userEntityReq->nom().'<br/>';
		$contenuMail .= 'Votre mot de passe est : '.$userEntityReq->password().'</p>';
		$contenuMail .= 'FX';
			
		@mail($userEntityReq->email(),$sujetMail, $contenuMail, $headers);
		$this->page->addVar('msgConfirmation', TRUE);
	}
	
	public function FormInscriptionIsValid($reqInscriptions)
	{
		$validation = TRUE;
	
		if (empty($reqInscriptions['nom'])) {
			$this->page->addVar('nomVide', 'Un nom doit être renseigné.');
			$validation = FALSE;
		}
			
		if (strlen($reqInscriptions['nom'])>50) {
			$this->page->addVar('nomLong', 'Le nom spécifié est trop long.');
			$validation = FALSE;
		}
			
		if (empty(($reqInscriptions['prenom']))) {
			$this->page->addVar('prenomVide', 'Un prénom doit être renseigné.');
			$validation = FALSE;
		}
			
		if (strlen($reqInscriptions['prenom'])>50) {
			$this->page->addVar('prenomLong', 'Le prenom spécifié est trop long.');
			$validation = FALSE;
		}
			
		if (empty($reqInscriptions['email'])) {
			$this->page->addVar('emailVide', 'Une adresse mail doit être renseignée.');
			$validation = FALSE;
		}
	
		if (empty($reqInscriptions['password'])) {
			$this->page->addVar('passwordVide', 'Un mot de passe doit être renseigné.');
			$validation = FALSE;
		}
			
		if (strlen($reqInscriptions['password']) < 6) {
			$this->page->addVar('passwordCourt', 'Pour plus de sécurité votre mot de passe doit contenir au minimum 6 caractères.');
			$validation = FALSE;
		}
		
		if ($reqInscriptions['checkCGU'] == 0) {
			$this->page->addVar('checkCGUFALSE', 'Vous devez accepter les conditions d\'utilisaion pour vous inscrire.');
			$validation = FALSE;
		}
	
		return $validation;
	}

	public function executeConfirmerInscription(HTTPRequest $request)
	{
		$userManager = $this->managers->getManagerOf('Users');
		$user = $userManager->getUniq('cle', $request->getData('cleActivation'));
		
// attention on peut activer plusieurs fois le meme compte !
		
		if ($user != FALSE) {
			$userManager->confirmRegistration($request->getData('cleActivation'));
			$this->page->addVar('msg', 'Félicitation ! Vous êtes maintenant inscrit sur PUBLEC vous pouvez désormais vous connecter en vous rendant sur la page d\'accueil.');
		}
		else {
			$this->page->addVar('msg', 'Erreur lors de la confirmation de votre inscription. Contactez le webmaster si vous pensez qu\'il s\'agit d\'un bug.');
		}
	}
	
	public function executeLienfooter(HTTPRequest $request)
	{
		
		$contenu = file_get_contents('../Web/infos/'.$request->getData('subject').'.txt', FILE_USE_INCLUDE_PATH);
		$this->page->addVar('contenu', $contenu);
	}
	
}
	