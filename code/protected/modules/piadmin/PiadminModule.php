<?php

class PiadminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
         $this->layout='//layouts/admin';
		// import the module-level models and components
		$this->setImport(array(
			'piadmin.models.*',
			'piadmin.components.*',
			'application.models.*',
            'application.models.base.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here

			return true;
		}
		else
			return false;
	}
}
