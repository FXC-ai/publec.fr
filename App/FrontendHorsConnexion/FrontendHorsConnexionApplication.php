<?php
namespace App\FrontendHorsConnexion;

use \OCFram\Application;


class FrontendHorsConnexionApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
    $this->name = 'FrontendHorsConnexion';
  }

  public function run()
  {

  	if (!$this->user->isAuthenticated())
  	{
			
  		$controller = $this->getController();
		
  	}
  	else
  	{
  		$this->httpResponse->redirect('/mesFichiers.html');
  	}
  	
  	$controller->execute();
  	 
  	$this->httpResponse->setPage($controller->page());
  	$this->httpResponse->send();
  	}
}