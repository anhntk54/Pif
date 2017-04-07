<?php

class CustomerController extends Controller
{
    public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
  public function actionIndex()
  {
     if(Yii::app()->session['adid']) {
      //Xóa session ở filler
        unset( Yii::app()->session['search']);
        unset( Yii::app()->session['iscontract']);
        unset(Yii::app()->session['isadmin']);
      // Xử lý limit
        $param = Yii::app()->request->getParam('page');
        $page = (isset($param) ? $param - 1 : 0);
        $count = Customer::getTotalNumberRow();
        $pages = new CPagination($count);
        $apage = 20;
        $pages->setPageSize($apage);
        $data = Customer::getLimitCustomer($page, $apage);   
        $cus=Customer::getAllCustomer();
        $admin=Admin::model()->findAll();
        $this->render('index',array('cus'=>$cus,
                      'data'=>$data,
                      'page_size'=>$apage,
                      'pages'=>$pages,
                      'item_count'=>$count,
                      'admin'=>$admin,
                        ));
      }else {
          //  header('Content-type: application/json');
            //         echo CJSON::encode("Err");
              //      Yii::app()->end();
          Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));           
      } 
  }
  public function actionReport(){
    if(Yii::app()->session['adid']) {
      //Xóa session ở filler
      unset( Yii::app()->session['search']);
      unset( Yii::app()->session['iscontract']);
      unset(Yii::app()->session['isadmin']);

      $cus = Customer::getTotalNumberRowBy('', 3, ''); // Lấy toàn bộ khách hàng có hợp đồng đang hiệu lực
      $count = count($cus);
      $admin = Admin::model()->findAll();
      $this->render('report',array(
        'cus' => $cus,
        'item_count' => $count,
        'admin' => $admin
      ));
    }else {
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));           
    } 
  }
  public function actionReportOther(){
    if(Yii::app()->session['adid']) {
      //Xóa session ở filler
      unset( Yii::app()->session['search']);
      unset( Yii::app()->session['iscontract']);
      unset(Yii::app()->session['isadmin']);

      $cus = Customer::getTotalNumberRowBy('', -3, ''); // Lấy toàn bộ khách hàng không có hợp đồng đang hiệu lực
      $count = count($cus);
      $admin = Admin::model()->findAll();
      $this->render('reportother',array(
        'cus' => $cus,
        'item_count' => $count,
        'admin' => $admin
      ));
    }else {
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));           
    } 
  }
  public function actionFilter(){ 
       if(Yii::app()->session['adid']) { 
            $value="";
            $iscontract="";
            $isadmin="";
           if(isset($_POST['search'])){ 
             $value=$_POST['search'];// 
             $iscontract=$_POST['iscontract'];
             $isadmin=$_POST['isadmin'];
              Yii::app()->session['search']= $value;
               Yii::app()->session['iscontract']= $iscontract;
                Yii::app()->session['isadmin']= $isadmin;
              if($value!=null){ //Nếu mà loại hơp đồng thay đổi thì gán cho nó một biến session
                Yii::app()->session['search']= $value;
              }
              if($iscontract!=null) {
                Yii::app()->session['iscontract']= $iscontract;
              }
               if($isadmin!=null) {
                Yii::app()->session['isadmin']= $isadmin;
              }
           }
           $param = Yii::app()->request->getParam('page');
           $page = (isset($param) ? $param - 1 : 0);
           $dataTotal = Customer::getTotalNumberRowBy( Yii::app()->session['search'],Yii::app()->session['iscontract'],Yii::app()->session['isadmin']);
            $count = count($dataTotal);
           $pages = new CPagination($count);
           $apage = 20;
           $pages->setPageSize($apage);
           $data = Customer::getLimitCustomerBy($page, $apage,Yii::app()->session['search'],Yii::app()->session['iscontract'],Yii::app()->session['isadmin']);   
           $cus=Customer::getAllCustomer();
            $admin=Admin::model()->findAll();
          $this->render('index',array('cus'=>$cus,
                      'data'=>$data,
                      'page_size'=>$apage,
                      'pages'=>$pages,
                      'item_count'=>$count,
                      'admin'=>$admin,
                        ));
       }else {
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));            
       }
  }
    /**
  Create by: Hoang Trung
  Update: 13/09/2016
  Mô tả: Xử lý các khách hàng trong thung rác
  */
   public function actionTrash(){
     if(Yii::app()->session['adid']) { 
        // Xử lý limit
        $param = Yii::app()->request->getParam('page');
        $page = (isset($param) ? $param - 1 : 0);
        $count = Customer::getTotalNumberRowTrash();
        $pages = new CPagination($count);
        $apage = Yii::app()->params['pager']; 
        $pages->setPageSize($apage);
        $data = Customer::getLimitCustomerTrash($page, $apage);   
        $cus=Customer::getAllCustomer();
        $admin=Admin::model()->findAll();
        $this->render('trash',array('cus'=>$cus,
                      'data'=>$data,
                      'page_size'=>$apage,
                      'pages'=>$pages,
                      'item_count'=>$count,
                      'admin'=>$admin,
                        ));
     }else {
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
     }
   }
   /**
   Xóa khách hàng khỏi hẳn database
   */
   public function actionDeleteKHTrash() {
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
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
     }
    } 
  /**
  Phục hồi khách hàng
  */
   public function actionRefresh() {
       if(Yii::app()->session['adid']) { 
      $id=Yii::app()->request->getPost('id');
       if($id) {
              $model=Customer::model()->findByPk($id);
              $model->status=1;//Đưa vào trạng thái thùng rác
              if($model->save()) {
                     echo 1;
              }else {
                echo 0;
              }
            
              
       }
               
     
      
     }else {
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
     }
    } 
  public function actionGetCustomer() {
     if(Yii::app()->session['adid']) { 
       $name=Yii::app()->request->getPost('name');
       $data=Customer::getCustomerByName($name);
       echo $data;

     }else {
      // header('Content-type: application/json');
              //       echo CJSON::encode("Err");
                //    Yii::app()->end();
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
     }
  }
    public function actionDeleteKH() {
       if(Yii::app()->session['adid']) { 
      $id=Yii::app()->request->getPost('id');
       if($id) {
        //kiểm tra xem khách hàng này có tồn tại hợp đồng nào hay không
          $hd=Contract::model()->findAllByAttributes(array('id_customer'=>$id));
            if($hd){
              echo 2;
            }else {
              $model=Customer::model()->findByPk($id);
              $model->status=2 ;//Đưa vào trạng thái thùng rác
              if($model->save()) {
                     echo 1;
              }else {
                echo 0;
              }
            }
              
       }
               
     
      
     }else {
      // header('Content-type: application/json');
              //       echo CJSON::encode("Err");
                //    Yii::app()->end();
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
     }
    }
    /**
    Xem thông tin khách hàng 
    */
    public function actionViews($id) {
      if(Yii::app()->session['adid']) {
         $admin=Admin::model()->findAll();
         $this->render('view',array(
      'model'=>$this->loadModel($id),
      'admin'=>$admin,
      ));
        }else {
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
        }
    }
    /**
     View để Edit khách hàng
    */
    public function actionEdits($id){
      if(Yii::app()->session['adid']) {
        $admin=Admin::model()->findAll();
         $this->render('updateKH',array(
            'cus'=>$this->loadModel($id),'admin'=>$admin,
          ));
        }else {
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));    
        }
    } 
  public function actionCheckEmail() {
    if(Yii::app()->session['adid']) {  
            $email=Yii::app()->request->getPost("email"); 
            $user=  Customer::model()->findAllByAttributes(array("email"=>$email));
            if($user!=null){
               echo '1'; 
            }else{
                echo '0';
            } 
      }else {
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));         
      }
  }
   public function actiongetByName(){
     if(Yii::app()->session['adid']) {
         $name=Yii::app()->request->getPost('name');
        $data=Customer::getCustomerByName($name);
         $i=0;
         $message="";
         foreach ($data as $item) {
            $message.='<tr>
                          <td>'.$i++.'</td>
                          <td>'. Contract::ViewDate($item['date_registration']).'</td>
                          <td>'.$item['fullname'] .'</td>
                          <td>'.$item['email'].'</td>
                          <td>'.$item['telephone'].'</td>
                          <td>'.$item['code'].'</td>
                          <td>
                             <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Customer/Views/id/'.$item['id'].'" >Xem</a> |
                             <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Customer/Edits/id/'.$item['id'].'" >Sửa</a> | 
                             <a style="cursor: pointer;text-decoration: underline;" onclick="Delete('. $item['id'].')" >Xóa</a>

                          </td> 
                       </tr>';
         }
         echo $message;
     }else {
      // header('Content-type: application/json');
          //           echo CJSON::encode("Err");
            //        Yii::app()->end();
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));   
     }
   }
   /**
    Sửa thông khách hàng sau khi admin có quyền tạo mới khách hàng mới
   */
   public function actionUpdateInfo() {
      if(Yii::app()->session['adid']) {
          $model=Customer::model()->findByPk((int)Yii::app()->request->getPost("id"));
          $old_password=$model->password;
          if(Yii::app()->request->getPost("reg_password")==$old_password ) {
              $model->password=$old_password;
          }else {
              $model->password=md5(Yii::app()->request->getPost("reg_password"));
          }
          $model->email=Yii::app()->request->getPost("email"); 
          $model->email_secondary=Yii::app()->request->getPost("email_sc"); 
          $model->email_third=Yii::app()->request->getPost("email_tr"); 
          $model->mst=Yii::app()->request->getPost("mst"); 
          $model->telephone=Yii::app()->request->getPost("telephone");
          $model->address=Yii::app()->request->getPost("address");
          $model->birthday=Investment::SaveDate(Yii::app()->request->getPost("birthday"));
          $model->fullname=Yii::app()->request->getPost("fullname");      
          $model->cmt=Yii::app()->request->getPost("cmt"); 
          $model->cmt_datecreate=Investment::SaveDate(Yii::app()->request->getPost("cmt_date"));
          $model->cmt_addresscreate=Yii::app()->request->getPost("cmt_addrress");
          $model->numberbank=Yii::app()->request->getPost("numberbank");
          $model->namebank=Yii::app()->request->getPost("namebank");
          $model->chinhanh=Yii::app()->request->getPost("addressbank");
           $model->id_admin=Yii::app()->request->getPost("admin"); 
           $model->bankacount=Yii::app()->request->getPost("bankacount");      
           $model->note=Yii::app()->request->getPost("note");      
           if($model->save()){ 
             echo 1;
             
          }else {
            echo 0;
          }
      }else {
       // header('Content-type: application/json');
         //            echo CJSON::encode("You can not access this page");
           //         Yii::app()->end();
           Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));           
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