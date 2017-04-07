<?php

class LoginController extends Controller
{
	 public function init() {
            parent::init();
             $this->layout='index';
    }
	public function actionIndex()
	{  
		 if(Yii::app()->session['adid']) {
		 	 Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin/Home"));
		 }else {
		 	$this->render('index');
		 }
	    	
	}
	public function actionCheckLogin() {
	     	$email=Yii::app()->request->getPost('email');
            $password=Yii::app()->request->getPost('password');
            
           
            if($email!=NULL && $password!=NULL ){
                $user=Admin::model()->findByAttributes(array('email' => $email, 'password' => MD5($password)));
                // echo $user;
                if($user!=NULL){
                    echo "suslogin";
                        Yii::app()->session['adname']=$user["fullname"];
                        Yii::app()->session['adid']=$user["id"];
                        Yii::app()->session['ademail']=$user["email"];
                        Yii::app()->session['adrole']=$user["role"];
                       // $this->CheckInfo();
                       // Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("Home"));
                }  else {
                    echo 0;    
                }
            }else{
            header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end(); 
            }
	}
   public function actionLogout(){
		     unset(Yii::app()->session['adname']);
         unset(Yii::app()->session['adid']);
         unset(Yii::app()->session['ademail']);
          unset(Yii::app()->session['adrole']);
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin/Login"));
	}
	
}