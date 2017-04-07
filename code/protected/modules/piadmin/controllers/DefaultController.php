<?php

class DefaultController extends Controller
{
	public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
	public function actionIndex()
	{
		$this->render('index');
	}
}