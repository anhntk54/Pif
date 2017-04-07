<?php

class RegisterController extends Controller
{
  public function init() {
            parent::init();
             $this->layout='index';
        }
  public function actionIndex()
  {
    $this->render('index');
  }
  /**
  Kiểm tra xem email của khách hàng đăng ký đã tồn tại trong cơ sở dữ liệu hay chưa
  */
  public function actionCheckEmail(){
       if(Yii::app()->request->getPost("email")){

            $email=Yii::app()->request->getPost("email"); 
            $user=  Customer::model()->findAllByAttributes(array("email"=>$email));
            if($user!=null){
               echo '1'; 
            }else{
                echo '0';
            } 
       }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
       }   
     }
   /**
   Sau khi kiểm tra Email bắt đầu lưu lại khách hàng và tạo mã cho khách hàng
   */  
   public function actionSaveReg(){ 
         $email=Yii::app()->request->getPost("email");
         $user=  Customer::model()->findAllByAttributes(array("email"=>$email)); 
         if($user==null) {
              $model=new Customer;
              $maxID=Customer::findMaxID();// tìm trong cơ sở dữ liệu max ID
              $autoMa=Customer::AutoMaKH($maxID);//Sinh mã tự  động
              $maKH=Customer::model()->findByAttributes(array("code"=>$autoMa));
              if($maKH) {
                 $autoMa=Customer::AutoMaKHUpdate($autoMa);
              }else {
                  $model->email=Yii::app()->request->getPost("email"); 
                  $password=Yii::app()->getSecurityManager()->generateRandomString(15);
                  $model->password=md5($password); 
                  $model->fullname=Yii::app()->request->getPost("fullname"); 
           date_default_timezone_set('Asia/Ho_Chi_Minh');
                  $model->date_registration=date('Y-m-d H:i:s');
                  $model->status=1;
                  $model->code=$autoMa;
                  $model->code_active=Yii::app()->getSecurityManager()->generateRandomString(20);
                  $model->new_password=Yii::app()->getSecurityManager()->generateRandomString(20);
                  $message='<h2>Thông báo từ Hệ Thống của Passion Investment</h2>';
                  $message.='<p>Chúng tôi nhận thấy địa chỉ email của Quý khách vừa đăng ký thành viên tại hệ thống của Passion Investment</p>';
                  $message.='<p>Nếu bạn không thực hiện đăng ký, xin vui lòng bỏ qua email này!</p>';
                  $message.='<h3>Đây là thông tin đăng nhập hệ thống Passion Investment</h3>';
                  $message.='<p>Tên đăng nhập: '.Yii::app()->request->getPost("email").'</p>';
                  $message.='<p>Mật khẩu: '.$password.'</p>';
                  $message.='<p>Bạn vui lòng vào đây để đăng nhập :<a href="http://members.pif.vn/">http://members.pif.vn/</a></p>';
                  $mes="<h2>Thông báo từ Hệ Thống của Passion Investment</h2>";
                  $mes.='<p>Thành viên mới đăng ký trên hệ thống Passion Investment:</p>';
                  $mes.='<ul>';
                  $mes.='<li>Email: '.$model->email.'</li>';
                  $mes.='<li>Họ và Tên: '.$model->fullname.'</li>';
                  $mes.='</ul>';
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
                      $this-> mailsend($email,'Thông tin Đăng ký thành viên từ hệ thống Passion Investment', $message.$sig);
                       $this-> mailsend("tuvan@pif.vn",'Thành viên mới đăng ký hệ thống Passion Investment', $mes.$sig);
                       echo 1;
                    }else {
                      echo 0;
                    }
              }
              
         }else {
            echo 3;
         }
         
        
   }
   public function actionUpdateInfo() {
      if(Yii::app()->session['id']!=null) {
          $model=Customer::model()->findByPk(Yii::app()->session['id']);
     // $old_password=$model->password;
      // if(Yii::app()->request->getPost("reg_password")==$old_password ) {
       //  $model->password=$old_password;
      // }else {
       //  $model->password=md5(Yii::app()->request->getPost("reg_password"));
      // }
          $model->email=Yii::app()->request->getPost("email"); 
          $model->fullname=Yii::app()->request->getPost("fullname"); 
          $model->email_secondary=Yii::app()->request->getPost("email_sc"); 
          $model->email_third=Yii::app()->request->getPost("email_tr"); 
          $model->mst=Yii::app()->request->getPost("mst"); 
          $model->telephone=Yii::app()->request->getPost("telephone"); 
          $model->cmt=Yii::app()->request->getPost("cmt"); 
          $model->cmt_datecreate=Investment::SaveDate(Yii::app()->request->getPost("cmt_date")); 
          $model->cmt_addresscreate=Yii::app()->request->getPost("cmt_addrress");
          $model->numberbank=Yii::app()->request->getPost("numberbank");
          $model->namebank=Yii::app()->request->getPost("namebank");
          $model->chinhanh=Yii::app()->request->getPost("addressbank");
          $model->bankacount=Yii::app()->request->getPost("bankacount");  
          date_default_timezone_set('Asia/Ho_Chi_Minh');
           $message='<h2>Thông Báo từ Hệ Thống của Passion Investment</h2>';
           $message.='<p>Thành viên:'.$model->fullname.' ('.$model->email.') vừa cập nhật thông tin cá nhân</p>';  
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
             $this-> mailsend('tuvan@pif.vn','Thành viên cập nhật thông tin cá nhân trên hệ thống Passion Investment'.date('d-m-Y'), $message.$sig);
             echo 1;
            // Yii::app()->session['permission']="full";
             $this->CheckInfo();
          }else {
            echo 0;
          }
      }else {
        header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }
   }
   /**
    Hàm này dùng để kiểm tra xem người dùng đã cập nhật thông tin của mình chưa
    */
    static function CheckInfo(){
      if(Yii::app()->session['id']!==null) { 
          $model=Customer::model()->findByPk(Yii::app()->session['id']);
         
          if($model->telephone==null || $model->cmt==null || $model->cmt_datecreate==null || $model->cmt_addresscreate==null ) {
             Yii::app()->session['permission']="nofull";
          }else {
             Yii::app()->session['permission']="full";
          }
      } 
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
        $mail->AddReplyTo("tuvan@pif.vn","Passion Investment");
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