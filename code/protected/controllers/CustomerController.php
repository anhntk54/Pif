<?php

class CustomerController extends Controller
{
   public function init() {
            parent::init();
             $this->layout='//layouts/main';
    }
  public function actionIndex()
  {
    if(Yii::app()->session['id']!==null) { 
    $this->render('index');
    }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }      
  }
  public function actionForgot() {
    if(Yii::app()->session['id']!==null) {  

      if(Yii::app()->request->getPost('password')){
        $password=Yii::app()->request->getPost('password');
         $model=Customer::model()->findByPk(Yii::app()->session['id']);
         $model->password=md5($password);
         if($model->save()){
                     echo 1;
         }else {
          echo 0;
         }
      }

      $this->render('forgot');

    }else {
      header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
    }
  }
   public function actionGetPass(){
    if(Yii::app()->session['id']!==null) {  
       if(Yii::app()->request->getPost('password')){
        $password=Yii::app()->request->getPost('password');
         $model=$this->loadModel(Yii::app()->session['id']);
         $model->password=md5($password);
          $model->new_password=Yii::app()->getSecurityManager()->generateRandomString(20);
         if($model->save()){
                     echo "1";
         }else {
                    echo "0";
         }
      }

    }else {
      header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end();
    }
  }
   public function actionCheckPassword(){
      if(Yii::app()->session['id']!==null) {  
            $model=Customer::model()->findByPk(Yii::app()->session['id']);
            $password=Yii::app()->request->getPost('password');
            if(md5($password)==$model->password){
                  echo "0";
            }else {
              echo "1";
            }
      }else {
         header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }
   }
   public function loadModel($id)
  {
    $model=Customer::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }
  
}