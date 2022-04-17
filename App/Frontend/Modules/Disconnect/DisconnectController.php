<?php
namespace App\Frontend\Modules\Disconnect;

use OCFram\BackController;
use OCFram\HTTPRequest;



class DisconnectController extends BackController
{
	public function executeDisconnection (HTTPRequest $request)
	{
		$this->app->user()->setAuthenticated(FALSE);
		
		//session_destroy();
	}
}