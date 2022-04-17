<?php
namespace App\Frontend;

use \OCFram\Application;


class FrontendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();
    $this->name = 'Frontend';
  }

  public function run()
  {
	if ($this->user->isAuthenticated())
  	{
  		$controller = $this->getController();

  	}
  	else
  	{
  		$this->httpResponse->redirect('/accueil/index.html');
  	}
 	
  	$controller->execute();
  	
  	$this->httpResponse->setPage($controller->page());
  	$this->httpResponse->send();
  	}	
}