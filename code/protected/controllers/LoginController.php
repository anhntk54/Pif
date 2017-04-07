<?php

class LoginController extends Controller
{  

  public function init() {
            parent::init();
             $this->layout='index';
    }
  
  public function actionIndex(){    
  	Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("contactPen"));
  	if(Yii::app()->session['id']) {
           Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("Home"));
         }else {
            $this->render('index');
         }
     
  }
   public function actionCheckLogin(){
            $email=Yii::app()->request->getPost('email');
            $password=Yii::app()->request->getPost('password');
            $check=Yii::app()->request->getPost('check');
            if($email!=NULL && $password!=NULL ){
                $user=Customer::model()->findByAttributes(array('email' => $email, 'password' => MD5($password),'status'=>1));
                if($user!=NULL){
                      echo "suslogin";
                        Yii::app()->session['username']=$user["fullname"];
                        Yii::app()->session['id']=$user["id"];
                        Yii::app()->session['email']=$user["email"];
                       if($check==1){
                         Yii::app()->request->cookies['ck_name'] = new CHttpCookie('ck_name', $user['email']);
                          Yii::app()->request->cookies['ck_password'] = new CHttpCookie('ck_password', $password);
                       }
                       $this->CheckInfo(); 
                        $model=Customer::model()->findByPk($user["id"]);
                           date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $model->date_login=date('Y-m-d H:i:s');
                        $model->save();
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
    
   public function actionVerify() {
      $gen_key = Yii::app()->request->getParam('verify');//Lấy được vertify trên tình duyêt
      if($gen_key!=NULL){//Nếu nó tồn tại

          $user=Customer::model()->findByAttributes(array("key_active"=>$gen_key)); //Tìm kiếm username với veryfile đấy
          if($user!=null) {//Nếu tồn tại username này
              $model=Customer::model()->findByPk($user->id);//Tìm kiếm thông tin với thành viên này
              $newpass= $model->new_password;//Lấy password ở new_password
              if($newpass){//Nếu có newpass
              }else {
                 $newpass=Yii::app()->getSecurityManager()->generateRandomString(20);//Tạo new password mới
              }
              $model->password=MD5($newpass);//Tạo mật khẩu mới cho khách hàng
              $model->key_active=Yii::app()->getSecurityManager()->generateRandomString(20);//Sau đó thay đổi key active
              $model->status=1;//Trạng thái tài khoản đã được kích hoạt
              $message='<h2>Thông Báo từ Hệ Thống của Passion Investment</h2>';
              $message.='<p>Đổi mật khẩu thành công!</p>';
              $message.='<p>Dưới đây là mật khẩu mới của bạn: '.$newpass.'</p>';
              $message.='<p>Cám ơn bạn đã tham gia Hệ Thống Passion Investment!</p>';
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
                   $this->render('verify');  
                   $this-> mailsend($model->email,'Thông tin mật khẩu mới từ hệ thống Passion Investment', $message.$sig);
               }
          }else {
               header('Content-type: application/json');
                     echo CJSON::encode("Err :3");
                    Yii::app()->end(); 
          }
          
         
       }else {
        $this->render('index');
     }
      
   }
  public function actionForgot(){ 
      
        $email=Yii::app()->request->getPost("email"); 
        if($email){
         
             $user=Customer::model()->findByAttributes(array("email"=>$email)); 
             if($user!=NULL){
                $model=Customer::model()->findByPk($user->id);
                 $gen_key=Yii::app()->getSecurityManager()->generateRandomString(20);
                 $model->key_active= $gen_key;
               //  $newpass= $model->new_password;
                 //$model->password=MD5($newpass);
               //  $this-> mailsend($email,"thele@ecpvn.com", 'New Password', 'New Password:'.$newpass);
                 //$model->new_password=Yii::app()->getSecurityManager()->generateRandomString(20);
                 $message='<h2>Thông Báo từ Hệ Thống của Passion Investment</h2>';
                 $message.='<p>Chúng tôi nhận thấy Tài khoản của bạn vừa yêu cầu cấp lại mật khẩu mới từ hệ thống của Passion Investment</p>';
                 $message.='<p>Nếu bạn không muốn cấp lại mật khẩu mới thì vui lòng bỏ qua email này!</p>';
                 $message.='<p>Nếu bạn muốn cấp lại mật khẩu mới xin vui lòng nhấn đường link bên dưới để lấy mật khẩu mới</p>';
                 $message.='<a href="http://members.pif.vn/Login/Verify/verify/'.$gen_key.'">http://members.pif.vn/Login/Verify/verify/'.$gen_key.'</a>';
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
                            $this-> mailsend($email,'Xác nhận yêu cầu cấp lại mật khẩu từ Hệ Thống Passion Investment', $message.$sig);
                           echo 1;
                    }else { echo 0; }
                 
                 } else{
                     echo 2;}
         }else {
             echo 3;
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
  public function actionLogout(){
         unset(Yii::app()->session['username']);
         unset(Yii::app()->session['id']);
         unset(Yii::app()->session['email']);
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("Login"));
  }
   
}