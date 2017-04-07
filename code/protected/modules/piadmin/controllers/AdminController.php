<?php

class AdminController extends Controller
{
  public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
  public function actionIndex()
  {
     if(Yii::app()->session['adid'] && Yii::app()->session['adrole']==1) {
       
       //xử lý limit
       $param = Yii::app()->request->getParam('page');
       $page = (isset($param) ? $param - 1 : 0);
       $count = Admin::getTotalNumberRow();
       $pages = new CPagination($count);
       $apage = Yii::app()->params['pager']; 
       $pages->setPageSize($apage);
       $data = Admin::getLimitAdmin($page, $apage);   
       $admin=Admin::getAll();
       $this->render('index',array('admin'=>$admin,
                      'data'=>$data,
                      'page_size'=>$apage,
                      'pages'=>$pages,
                      'item_count'=>$count,
                        ));
    }else {
       header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end(); 
    }
  }
  public function actionFilter(){
      if(Yii::app()->session['adid'] && Yii::app()->session['adrole']==1) { 
         $value="";
         if(isset($_POST['adsearch'])){  
             $value=$_POST['adsearch'];
             Yii::app()->session['adsearch']= $value;
             if($value!=null){ //Nếu mà loại hơp đồng thay đổi thì gán cho nó một biến session
                Yii::app()->session['adsearch']= $value;
              }
         }
          //xử lý limit
       $param = Yii::app()->request->getParam('page');
       $page = (isset($param) ? $param - 1 : 0);
       $dataTotal = Admin::getTotalNumberRowBy( Yii::app()->session['adsearch']);
       $count = count($dataTotal);
       $pages = new CPagination($count);
       $apage = Yii::app()->params['pager']; 
       $pages->setPageSize($apage);
       $data = Admin::getLimitAdminBy($page, $apage,Yii::app()->session['adsearch']);   
       $admin=Admin::getAll();
       $this->render('index',array('admin'=>$admin,
                      'data'=>$data,
                      'page_size'=>$apage,
                      'pages'=>$pages,
                      'item_count'=>$count,
                        ));
       }else {
          header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end(); 
      }
  }
  public function actionCreatead(){
     if(Yii::app()->session['adid'] && Yii::app()->session['adrole']==1) {
           $new_pass=Yii::app()->getSecurityManager()->generateRandomString(20);
           $this->render('create',array("pass"=>$new_pass));

          }else {
       header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end(); 
    }  
  }
  public function actionGenPass() {
     if(Yii::app()->session['adid'] && Yii::app()->session['adrole']==1) {  
       echo Yii::app()->getSecurityManager()->generateRandomString(20);

     }else {
       header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end(); 
     }
  }
  public function actionEdits($id) {
     if(Yii::app()->session['adid'] && Yii::app()->session['adrole']==1) { 
        $model=$this->loadModel($id);
        $old_password=$model->password;
        if(isset($_POST['Admin'])) {
          
            $model->attributes=$_POST['Admin'];
            if($model->password!=$old_password){
               $model->password=md5($_POST['Admin']['password']);
            }else {
              $model->password= $old_password;
            }
             if($model->save()) {
               Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin/Admin"));
             }
            
          
        }
        
        $this->render('update',array(
             'model'=>$model
          ));
       
     }else {
     /* header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end(); */
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));     
     }

  }
   public function actionCheckEmail() {
      if(Yii::app()->session['adid']) {  
            $email=Yii::app()->request->getPost("email"); 
            $user=  Admin::model()->findAllByAttributes(array("email"=>$email));
            if($user!=null){
               echo '1'; 
            }else{
                echo '0';
            } 
      }else {
      /*  header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end();*/
       Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));          
      }
   }
   public function actionDeleteAdmin(){
      if(Yii::app()->session['adid']) { 
      $id=Yii::app()->request->getPost('id');
       if($id) {
              if($this->loadModel($id)->delete()) {
                     echo 1;
              }else {
                echo 0;
              }
       }
               
     
      
     }else {
      /* header('Content-type: application/json');
                     echo CJSON::encode("Err");
                    Yii::app()->end();*/
       Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));    
     }
   }
   public function actionSaveAD() {
       if(Yii::app()->session['adid'] && Yii::app()->session['adrole']==1) { 

         if(isset($_POST)) {  
      $email=$_POST['ad_email'];
      $fullname=$_POST['ad_fullname'];
      $telephone=$_POST['ad_telephone'];
      $password=$_POST['ad_password'];
      $role=$_POST['ad_role'];
      $email_send=$_POST['ad_email_send'];
      $signature=$_POST['signature'];
      $password_send=$_POST['ad_password_send'];
      $user=  Admin::model()->findAllByAttributes(array("email"=>$email));
      if($user==null){
          $model=new Admin;
          $model->email=$email;
          $model->password=md5($password);
          $model->telephone=$telephone;
          $model->fullname=$fullname;
          $model->email_send=$email_send;
          $model->signature=$signature;
          $model->pass_email=$password_send;
                $model->role=$role;
             if($model->save()) {
                  // $this->redirect(array('Views','id'=>$model->id));
                 $this->redirect('index');
                }else {
                  echo "Email đã tồn tại";
                }

      }
      
         }

       }else {
       //header('Content-type: application/json');
                  //   echo CJSON::encode("Err");
                //    Yii::app()->end(); 
          Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
    }  
   }

   public function loadModel($id)
  {
    $model=Admin::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }
  
}