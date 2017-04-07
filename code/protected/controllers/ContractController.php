<?php
/**
Created by:Hoang Trung
Date Created:
Update:16/06/2016
Des:Controler xử lý các function liên quan đến hợp đồng.
*/
class ContractController extends Controller
{
  public function init() {
            parent::init();
             $this->layout='//layouts/main';
    }
  public function actionIndex()
  {
     // header('Content-type: application/json');
     //                 echo CJSON::encode("Err");
     //                Yii::app()->end();
     $this->render('index'); 
    // $this->render('index',array("maAuto"=>$maAuto,"form"=>$form,"id"=>$id));
  }
  /**
   Khi khách hàng click tạo mới hợp đồng thì sẽ tạo bản nháp
   Tạo hợp đồng trong trạng thái bản nháp 
   */
    public function actionRegContract() {
    if(Yii::app()->session['id']!==null) {
      /*Xáo các bản hợp đồng bản nháp trước khi  khi tạo mới */
      $id= Yii::app()->session['id'];// Lấy id khi khách hàng đăng nhập
      $contracts=Contract::findContractByEmail($id);//gọi đến hàm get Contract theo Email
      if($contracts) {
            foreach ($contracts as $item) {
              $this->loadModel($item['id'])->delete($item['id']);
            }
      }
      /*Bắt đầu sinh mã và tạo mới bản hợp đồng :trạng thái draff*/
        $maxID=Contract::findMaxID();//Get Max ID 
        $maAuto=$this->AutoMaPi($maxID);//Cõ mã tự động max ID
        $contract=new Contract;
        $maHD=$contract->findByAttributes(array("number_form"=>$maAuto));//kiểm tra xem mã có tồn tại hay không
        if($maHD){   
        }else {
          $model=new Contract;
          $form=Formcontract::getAllForm('id,name');
          $model->number_form= $maAuto;
          $model->id_customer=Yii::app()->session['id'];
          $model->status=0;
       date_default_timezone_set('Asia/Ho_Chi_Minh');
          $model->date_created=date('Y-m-d H:i:s');
          if($model->save()){
            $id=$contract->findByAttributes(array("number_form"=>$maAuto));
            $cus=Customer::model()->findByPk(array($model->id_customer));
            $this->render('form',array("maAuto"=>$maAuto,"form"=>$form,"id"=>$id["id"],"cus"=>$cus));
          
           }
        }
      }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }  
    }
    /**
     Kiểm tra xem tài khoản này đang có bao nhiêu hợp đồng dưới dạng bản nháp 
     */
  public function actionCheckContract() {
    if(Yii::app()->session['id']!==null) {
      $id= Yii::app()->session['id'];
      $contract=Contract::findContractByEmail($id);
      //echo "<pre>";print_r($contract);die();
      if($contract) {
         $this->render('index',array('data'=>$contract));
      }else {
          Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("Contract/RegContract"));
       }
      }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }   
    }
    /**
     Update lại bản hợp đồng ở trạng thái pedding khi khách hàng cập nhập thông tin
     Sửa lại là tạo mới hợp đồng chứ không tạo bản nháp nữa!
    */
    public function actionRegContractPending() {
       if(Yii::app()->session['id']!==null) {
         $form=Formcontract::getAllForm('id,name');
         $cus=Customer::model()->findByPk(Yii::app()->session['id']);
         $this->CheckInfo();
         if(Yii::app()->session['permission']=="nofull") {
              $this->redirect(array('index'));
         }
         if(isset($_POST['vonHD'])) { 
                /*Bắt đầu sinh mã và tạo mới bản hợp đồng :trạng thái draff*/
                $maxID=Contract::FindMax();//Get Max ID 
                $ID=Contract::AutoID($maxID);// lấy được ID tự động
                $maHD=Contract::AutoMaPi($ID);//lấy được  Mã hợp đồng
              // $maxID=Contract::findMaxID();//Get Max ID 
              // $maAuto=$this->AutoMaPi($maxID);//Cõ mã tự động max ID
              $contract=new Contract;
              $ma=$contract->findByAttributes(array("number_form"=>$maHD));//kiểm tra xem mã có tồn tại hay không
               if($ma){   
               }else {

                  $model=new Contract;
                  $model->id=$ID;
                  $model->number_form=$maHD;
                  $model->id_form=$_POST['htHD'];
                  $vonHD=$_POST['vonHD'];
                  $vonHD=str_replace('.', '', $vonHD);
                  $model->investment=$vonHD;
                  $model->status=1;
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                  $date=date('Y-m-d H:i:s');
                  $model->date_created=$date;
                  $model->date_modified= $date;
                  $model->id_customer=Yii::app()->session['id'];
                  $form=Formcontract::model()->findByPk($_POST['htHD']);
                 // $hd=$this->GenHD($form->content_form,Yii::app()->session['id'],$maHD) ;
                  $model->content_contract=$form->content_form;
                  //Lấy tên thành viên
                  $cus=Customer::model()->findByPk(Yii::app()->session['id']);
                  //Nội dung thông báo đến admin khi đăng kí mới
                 
                  $message='<h2>Thông Báo từ Hệ Thống Website của Passion Investment</h2>';
                  $message.='<p>Thành viên: '.$cus->fullname.'('.$cus->email.') vừa tạo mới hợp đồng số '.$maHD.' trên hệ thống Passion Investment</p>';
                  $message.='<p>Đăng nhập hệ thống để biết thêm chi tiết:</p>';
                   $message.='<a href="http://members.pif.vn/piadmin">http://members.pif.vn/piadmin</a>';

                  //thông báo gưi tới khách hàng
                  $messages='<h2>Thông Báo từ Hệ Thống Website của Passion Investment</h2>';
                  $messages.='<p>Bạn vừa đăng ký hợp đồng số '.$maHD.' trên hệ thống Passion Investment.</p>';
                  $messages.='<p>Đăng nhập link dưới đây để biết thêm chi tiết.</p>';
                  $messages.='<a href="http://members.pif.vn/">http://members.pif.vn/</a>';
                  // Thông báo hướng dẫn chuyển tiền đến khách hàng
                   $fullname=$cus->fullname;
                   $name=Contract::convert_vi_to_en($fullname);
                   $mes='<p><strong>Kính gửi quý khách hàng,</strong></p>';
                   $mes.='<p>Passion Investment xin phép được gửi quý khách hàng nội dung cách thức chuyển tiền vào tài khoản hợp tác đầu tư tại Vietcombank (VCB):</p>';
                   $mes.='<p>Quý khách có thể chọn một trong hai hình thức theo nội dung hướng dẫn dưới đây:</p>';
                  $mes.='<p><strong><i>1.TỪ NGÂN HÀNG KHÁC VIETCOMBANK (Tại quầy hoặc Ibanking) VÀ TẠI QUẦY CỦA VIETCOMBANK: </i></strong></p>';
                  $mes.='<ul>';
                  $mes.='<li>Người nhận: <strong>Công ty TNHH Chứng khoán Ngân hàng TMCP Ngoại thương Việt Nam</strong></li>';
                  $mes.='<li>Số tài khoản: &nbsp;<strong>0011.002.475.230</strong></li>';
                  $mes.='<li>Tại: &nbsp;Ngân hàng TMCP Ngoại thương Việt Nam – Sở giao dịch</li>';
                  $mes.='<li>Nội dung: <strong>009C662007, CTCP TVDT PASSION INVESTMENT '.Contract::GetIDAuto($model->number_form).'</strong></li>';
                  $mes.='</ul>';
                  $mes.='<p>&nbsp;</p>';
                
                  $mes.='<p><strong><i>2.TỪ <span>VIETCOMBANK</span> <span>QUA</span> <span>KÊNH</span> ONLINE BANKING: </i></strong></p>';
                  $mes.='<p><strong><span>Bước 1</span></strong>: <span>Đăng nhập</span> vào tài khoản IBanking tại:</p>';
                  $mes.='<p><a href="https://www.vietcombank.com.vn/IBanking2015/55c3c0a782b739e063efa9d5985e2ab4/Account/Login">https://www.vietcombank.com.vn/IBanking2015/55c3c0a782b739e063efa9d5985e2ab4/Account/Login</a></p>';
                  $mes.='<p><strong>Bước 2</strong>: Chọn mục”Thanh toán” và chọn “ Dịch vụ tài chính”, màn hình hiển thị các thông tin và điền như sau: </p>';
                  $mes.='<ul>';
                  $mes.='<li>Nhà cung cấp: <strong>chọn VCBS – Công ty chứng khoán Vietcombank</strong></li>';
                  $mes.='<li>Mã khách hàng: <strong>009C662007</strong></li>';
                  $mes.='<li>Tên khách hàng: <strong>CTCP TVDT PASSION INVESTMENT '.Contract::GetIDAuto($model->number_form).'</strong></li>';
                  $mes.='</ul>';
                  $mes.='<p>Ở phần <strong>Nội dung</strong>, Passion Investment xin được giải thích thông tin như sau:</p>';
                  $mes.='<ul>';
                  $mes.='<li><strong>009C662007 </strong> là tài khoản chứng khoán của công ty Passion Investment mở <span>tại</span> công ty chứng khoán;</li>';  
                  $mes.='<li><strong>'.Contract::GetIDAuto($model->number_form).'</strong> là hợp đồng Hợp tác đầu tư số '.Contract::GetIDAuto($model->number_form).'</li>';
                  $mes.='</ul>';
                  $mes.='<p><strong>Ngoài ra, quý khách vui lòng cung cấp thông tin dưới đây để Passion Investment soạn thảo hợp đồng:</strong></p>';
                  $mes.='<ul>';
                  $mes.='<li>Ảnh chụp hoặc bản photo CMT/ hộ chiếu (trong đó có rõ Họ tên, số CMT, ngày cấp, nơi cấp)</li>';
                  $mes.='<li>Mã số thuế cá nhân (nếu có):</li>';
                  $mes.='<li>Hình thức hợp tác:</li>';
                  $mes.='<li>Số TK ngân hàng, chi nhánh (dùng khi tất toán hợp đồng)</li>';
                  $mes.='</ul>';
                  $mes.='<p><i><strong>Nếu có thông tin cần giải đáp, kính mong quý khách phản hồi, PI sẽ liên lạc để trao đổi cụ thể.</strong></i></p>';
                  $mes.='<p>Trân trọng!</p>'; 
                  $ad='Email đã được gửi tới khách hàng '.$cus->fullname.' với nội dung như sau:';
                  // chữ kí số
                    $sig='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<img src="http://members.pif.vn/templates/images/logo.png">';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><span style="color:#179046">Passion Investment</span></p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">Room 502B, 5 th  Floor, Rainbow Building</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">T: (84) 4 3264 6480</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
                    $sig.'<p style="margin-bottom:5px;margin-top:5px;">Skype: <a href="hoangnga3119">hoangnga3119</a></p>';
                   if($model->save()) {
                        $this-> mailsend('tuvan@pif.vn','Passion Investment - Email gửi đến khách hàng '.$cus->fullname.' '.date('d-m-Y'), $message.$sig);//gửi đến admin 
                        $this-> mailsend('tuvan@pif.vn','Tạo mới hợp đồng trên hệ thống của Passion Investment '.date('d-m-Y'), $ad.$message.$sig);//gửi đến admin 
                        $this-> mailsend( $cus->email,'Tạo mới hợp đồng trên hệ thống của Passion Investment '.date('d-m-Y'), $messages.$sig);//gửi đến khách hàng 
                        $this-> mailsend( $cus->email,'Passion Investment - Hướng dẫn chuyển tiền  '.date('d-m-Y H:i:s'),$mes.$sig);//gửi đến khách hàng 
                      $this->redirect(array('Review','id'=>$model->id));
                     // $this->redirect(array('AllContract'));
                  }else {
                       $this->render("form",array("form"=>$form,"cus"=>$cus)); 
                   }
               }
              
            }
            $this->render("form",array("form"=>$form,"cus"=>$cus));
        }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }       
    }

    /**
     RewView lại thông tin sau khi đã đăng kí 
     param @ID
     */
    public function actionReview($id) {
      if(Yii::app()->session['id']!==null) {
       $model=$this->loadModel($id);
       $form=Formcontract::model()->findByPk($model->id_form);
       $date=$model->date_modified;
       if($date){ }else {
         $date=$model->date_created;
          
       }
        $status="fail";
       if($model->status==2 ||$model->status==3){
        $status="sus";
       }
       $hd=$this->GenHD($form->content_form, $model->id_customer,$model->number_form,$date,$model->investment,$status) ;
       $this->render("review",array("model"=>$this->loadModel($id),"hd"=>$hd));
      }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }      
    }
    /**
    Nếu khách hàng đồng ý tạo lại hợp đồng với Mã hợp đồng đang có sẵn
    param @ID
    */
    public function actionRegisterContractByDraff($id){
      if($id) {
          $model=$this->loadModel($id);
          $form=Formcontract::getAllForm('id,name');
          $cus=Customer::model()->findByPk(array($model->id_customer));
            $this->render('form',array("maAuto"=>$model->number_form,"form"=>$form,"id"=>$id,"cus"=>$cus));
      }else {
        echo "Lỗi";
      }
            
    }
    /**
    Danh sách tất cả hợp đồng của khách hàng
    */
    public function actionAllContract() {
      if(Yii::app()->session['id']!==null) { 
      $id= Yii::app()->session['id'];
      $contract=Contract::getAllContract($id);
      $form=Formcontract::getAllForm('id,name');
      $this->render('contract',array("contract"=>$contract,'form'=>$form));
      }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }      
    }
    /**
    Lọc
    */
    public function actionFilter(){
      if(Yii::app()->session['id']) {
         $id= Yii::app()->session['id'];
         // $contract=Contract::getAllContract($id);
         $form=Formcontract::getAllForm('id,name');
         if(isset($_POST['filters'])){
             $value=$_POST['filters'];
             $status=$_POST['status'];
             $type=$_POST['typecontract'];
             
             if($value!=null){
                Yii::app()->session['filters']= $value;
             }
              if($status!=null){
                Yii::app()->session['status']= $status;
             } 
              if($type!=null){
                Yii::app()->session['type']= $type;
             } 


            $contract=Contract::getAllContractBy($id,Yii::app()->session['filters'],Yii::app()->session['status'],Yii::app()->session['type']); 
            $this->render('contract',array("contract"=>$contract,'form'=>$form)); 
           }else {
              $id= Yii::app()->session['id'];
              $contract=Contract::getAllContract($id);
              $form=Formcontract::getAllForm('id,name');
              $this->render('contract',array("contract"=>$contract,'form'=>$form));
           } 
      }

    }
    /**
    Xem chi tiết hợp đồng
    */
    public function actionViews($id){
        if(Yii::app()->session['id']) {
         $this->render('view',array(
          'model'=>$this->loadModel($id),
      ));
        }else {
          // header('Content-type: application/json');
              //       echo CJSON::encode("Err");
                //    Yii::app()->end();
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/"));   
        }
  }
  /**
  Xóa hợp đồng
  */
    public function actionDeleteHD() {
     if(Yii::app()->session['id']) { 
      $id=Yii::app()->request->getPost('id');
       if($id) {
                  date_default_timezone_set('Asia/Ho_Chi_Minh');
                  $cus=Customer::model()->findByPk(Yii::app()->session['id']);
                  $contract=Contract::model()->findByPk($id);
              if($this->loadModel($id)->delete()) {
                  $message='<h2>Thông Báo từ Hệ Thống Website của Passion Investment</h2>';
                  $message.='<p>Thành viên :'.$cus->fullname.'('.$cus->email.') vừa mới xóa hợp đồng số '.$contract->number_form.'</p>';
                  // chữ kí số
                    $sig='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<img src="http://members.pif.vn/templates/images/logo.png">';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><span style="color:#179046">Passion Investment</span></p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">Room 502B, 5 th  Floor, Rainbow Building</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">T: (84) 4 3264 6480</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
                    $sig.'<p style="margin-bottom:5px;margin-top:5px;">Skype: <a href="hoangnga3119">hoangnga3119</a></p>';
                    $this-> mailsend('tuvan@pif.vn','Xóa hợp đồng trên hệ thống của Passion Investment '.date('d-m-Y'), $message.$sig);//gửi đến admin 
                  echo 1;
              }else {
                echo 0;
              }
       }
               
     
      
     }else {
     //  header('Content-type: application/json');
           //          echo CJSON::encode("Err");
             //       Yii::app()->end();
       Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));    
     }
  }
  /**
  Sửa hợp đồng
  */
  public function actionEditss($id){
    if(Yii::app()->session['id']) {
              $model=$this->loadModel($id);
              $content= $model->content_contract;
              $form=Formcontract::getAllForm('id,name');
           if(isset($_POST['Contract']))
            {
            $model->attributes=$_POST['Contract'];
         //   $model->date_created=Investment::SaveDate($_POST['Contract']['date_created']);
            $vonHD=$_POST['Contract']['investment'];
            $vonHD=str_replace('.', '', $vonHD); 
            $model->investment=$vonHD;
             //Lấy tên thành viên
                  date_default_timezone_set('Asia/Ho_Chi_Minh');
                  $cus=Customer::model()->findByPk(Yii::app()->session['id']);
            //Thông báo từ hệ thống khi người dùng cập nhập hợp đồng
            $message='<h2>Thông Báo từ Hệ Thống Website của Passion Investment</h2>';
            $message.='<p>Thành viên :'.$cus->fullname.'('.$cus->email.') vừa mới cập nhật hợp đồng số '.$model->number_form.'</p>';
            // chữ kí số
                     $sig='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<p>&nbsp;</p>';
                    $sig.='<img src="http://members.pif.vn/templates/images/logo.png">';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;"><span style="color:#179046">Passion Investment</span></p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">Room 502B, 5 th  Floor, Rainbow Building</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">T: (84) 4 3264 6480</p>';
                    $sig.='<p style="margin-bottom:5px;margin-top:5px;">W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
                    $sig.'<p style="margin-bottom:5px;margin-top:5px;">Skype: <a href="hoangnga3119">hoangnga3119</a></p>';
           if($model->save()){
             $this-> mailsend('tuvan@pif.vn','Cập nhật hợp đồng trên hệ thống của Passion Investment '.date('d-m-Y'), $message.$sig);//gửi đến admin 
             $contract=Contract::adGetAllContract();
             $form=Formcontract::getAllForm('id,name');
             $cus=Customer::getAllCustomer();
              $this->render('update',array("contract"=>$contract,'form'=>$form,'cus'=>$cus,"sus"=>1,'model'=>$model));
            }
           }
      }else {
          Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/")); 
      }     
  }
  public function actionEdits($id){
           if(Yii::app()->session['id']) {
              $permission=Contract::getPermisson($id);
              if($permission=='edit'){
                  $model=$this->loadModel($id);
                  $content= $model->content_contract;
                  $form=Formcontract::getAllForm('id,name');
                  $this->render('update',array(
                  'model'=>$model,'form'=>$form,"sus"=>0 ));
              }else {
                 header('Content-type: application/json');
                     echo CJSON::encode("You can not permission");
                    Yii::app()->end(); 
              }

           }else {
          
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/"));    
           }
  }
    /**
    Hàm này dùng để kiểm tra xem người dùng đã cập nhật thông tin của mình chưa
    */
    static function CheckInfo(){
      if(Yii::app()->session['id']!==null) { 
          $model=Customer::model()->findByPk(Yii::app()->session['id']);
         
          if($model->telephone==null  || $model->cmt==null || $model->cmt_datecreate==null || $model->cmt_addresscreate==null ) {
             Yii::app()->session['permission']="nofull";
          }else {
             Yii::app()->session['permission']="full";
          }
      } 
    }
    /**
    Xóa các bản hợp đồng dưới dạng bản nháp khi khách hàng chọn tạo mới hợp đồng
    */
    public function actionDelete($id){
     if(Yii::app()->session['id']!==null) {  
      $this->loadModel($id)->delete($id);
      }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }   
    }
    /**
    Load dữ liệu của 1 bản ghi theo 
     param @ID 
    */
    public function loadModel($id)
  {
     
    $model=Contract::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
   
  }
    /**
     Hàm tạo mã hợp đồng theo maxID của column ID
     param @ID
    */
   static function AutoMaPi($id) {
     if($id) {
       $model=Contract::model()->findByPk($id);
       $oldma=$model->number_form;
       $stt=substr($oldma,strpos($oldma,'-')+1);
       $maID=$stt+1;
       return $sAutoMaPi="BCC-".$maID;
     }else {
        return $sAutoMaPi="BCC-1";
     }
        
    }
    /**
  In hợp đồng
  */
  public function actionprintHD(){
    if(Yii::app()->session['id']) { 
        $id=Yii::app()->request->getPost('id');// lấy được ID hợp đồng
        $contract=Contract::model()->findByPk($id);//Tìm kiếm hợp đồng theo ID
        $cus=Customer::model()->findByPk($contract->id_customer);//Tìm kiếm khách hàng theo ID khách hàng trong bản hợp đồng
        $form=Formcontract::model()->findByPk($contract->id_form);//lấy được form của hợp đồng
        $date=$contract->date_modified;//Lấy date của hợp đồng
       if($date){ }else {
         $date=$contract->date_created;
       }
       if($contract->status==2 ||$contract->status==3){
        $status="sus";
       }
         $hd=$this->GenHD($form->content_form, $contract->id_customer,$contract->number_form,$date,$contract->investment,$status) ;
        $name=$contract->number_form."-".$cus->fullname;
        $data=array("content"=>Contract::GenHDView($hd),"name"=>$name); 
        echo json_encode($data);
    }else {
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/"));
    }
     
  }
    /**
     Hàm tạo ra hợp đồng để in
    */
     static function GenHD($content,$id,$so_hd,$date,$vonHD,$class){
      date_default_timezone_set('Asia/Ho_Chi_Minh');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
       $temTime = strtotime($date);
       $sMonth= date('m',$temTime);
       $sday= date('d',$temTime);
       $sYear=date('Y',$temTime);
       $cus=Customer::model()->findByPk($id);
       $contents=str_replace("so_hd",$so_hd,$content);
       $contents=str_replace("hd_date",$sday,$contents);
       $contents=str_replace("hd_month",$sMonth,$contents);
       $contents=str_replace("hd_year",$sYear,$contents);
       if($cus->cmt) {
         $contents=str_replace("hd_cmt",$cus->cmt,$contents);
       }
       if($cus->fullname) {
          $contents=str_replace("hd_name",mb_strtoupper($cus->fullname,'UTF-8'),$contents);
       }
       if($cus->cmt_addresscreate) {
         $contents=str_replace("hd_address",$cus->cmt_addresscreate,$contents);
       }
       if($cus->telephone){
         $contents=str_replace("hd_telephone",$cus->telephone,$contents);
       }
       if($cus->cmt_datecreate) {
        $contents=str_replace("hd_created",Investment::ViewDate($cus->cmt_datecreate),$contents);
       }
       if($cus->mst){
         $contents=str_replace("hd_mst",$cus->mst,$contents);
       }
       if($cus->email){
        $contents=str_replace("hd_email",$cus->email,$contents);
       }
        if($cus->numberbank){
        $contents=str_replace("hd_bank_number",$cus->numberbank,$contents);
       }
       if($cus->bankacount){
        $contents=str_replace("hd_bankacount",$cus->bankacount,$contents);
       }
        if($cus->namebank){
        $contents=str_replace("hd_banks",$cus->namebank." chi nhánh ".$cus->chinhanh ,$contents);
       }
        if($class=="fail"){
          $contents=str_replace("hd_class","fail",$contents);
       }
       if($class=="sus"){
          $contents=str_replace("hd_class","sus",$contents);
       }
       //$T=date("Y-m-d", $date) ;
       $Ts=date("Y-m-d",strtotime("$date - 1 day"));

       $contents=str_replace("hd_update_datest",Investment::ViewDate($Ts),$contents);

       $iv= Investment::model()->findByAttributes(array("date"=>$Ts));
       if($iv){
            $contents=str_replace("hd_update_totalvalue",number_format($iv->tongtkkinhdoanh, 0, ',', '.'),$contents);
            $contents=str_replace("hd_update_dvdt",number_format($iv->tongdvdt, 0, ',', '.'),$contents);
            $contents=str_replace("hd_up_date_one_dvdt",number_format($iv->motdvdt, 0, ',', '.').' đồng',$contents);
       }
         if($vonHD){
          if($vonHD==10000000){
            $contents=str_replace("hd_update_money",number_format($vonHD, 0, ',', '.'),$contents);
                 $contents=str_replace("hds_updates_moneys_text","Mười triệu đồng chẵn",$contents);
          }else {
            $contents=str_replace("hd_update_money",number_format($vonHD, 0, ',', '.'),$contents);
                $contents=str_replace("hds_updates_moneys_text",Lib::VndText(round($vonHD,0))."đồng chẵn",$contents);
          }
            // $contents=str_replace("hd_update_money",number_format($vonHD, 0, ',', '.'),$contents);
            // $contents=str_replace("hds_updates_moneys_text",Lib::VndText(round($vonHD,0))."đồng chẵn",$contents);
        }
        if($iv !=null && $vonHD!=null){
           if($iv->motdvdt!=0) {
             $dv=(double)$vonHD/(double)($iv->motdvdt);
       $contents=str_replace("hd_update_convertdvdt",number_format(round($dv,0), 0, ',', '.'),$contents);
             $contents=str_replace("hds_updates_convertdvdts_text",Lib::VndText(round($dv,0))."đơn vị đầu tư",$contents);
           }
          
           
        }
       $contents=str_replace("hd_update_date",$sday,$contents);
       $contents=str_replace("hd_update_month",$sMonth,$contents);
       $contents=str_replace("hd_update_year",$sYear,$contents);
       $fnYear=$sYear+1;
       if($sday-1==0) { //trường hợp nếu là ngày mùng 1 thì 01-1=0
          $fdate=date("Y-m-d",strtotime("$date - 1 day"));
          $temTime = strtotime($fdate);
          $fnday=date('d',$temTime);
          $sMonth=$sMonth-1;
           if($sMonth==0){ //nếu tháng là tháng 1 thì 01-1 =0 sẽ ra tháng 0 nên tháng sẽ =12 và namw vẫn giữ nguyên
             $sMonth=12;
             $fnYear=$fnYear-1;
           }
       }else {
            $fnday=$sday-1;
       }
       $contents=str_replace("hds_updates_dates_fn",$fnday,$contents);
       $contents=str_replace("hds_updates_months_fn",$sMonth,$contents);
       $contents=str_replace("hds_updates_years_fn",$fnYear,$contents);
       return $contents;
     }
     static function mailsend($to,$subject,$message){
         $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = "admin@pif.vn";
        $mail->Password = "pif@2016**";
        $mail->From="admin@pif.vn";
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo($mail->From,"Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->AddCC("cskh@pif.vn", "Passion Investment");
        $mail->AddCC("chuminhngoc@pif.vn", "Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
        $mail->ClearAllRecipients( ); // clear all
    }
}