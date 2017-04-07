<?php

class ContactPenController extends Controller
{
	 public function init() {
            parent::init();
             $this->layout='index';
    }
 //    public function actions()
	// {
	// 	return array(
	// 		// captcha action renders the CAPTCHA image displayed on the contact page
	// 		'captcha'=>array(
	// 			'class'=>'CCaptchaAction',
	// 			'backColor'=>0xFFFFFF,
	// 		),
			
	// 	);
	// }
  /**
  Createby: Hoàng Trung
  Date: 25/10/2016
  Des: Tạo thành viên mới
      +Nếu thành viên đã tồn tại thì chuyển sang trang tạo hợp đồng
      +Nếu chưa tồn tại thì lưu vào csdl và chuyển sang trang tạo hợp đồng
  */
  public function actionIndex(){
        $model=new ContactPenUserForm;//Tạo đối tượng Form từ model
        if(isset($_POST['ContactPenUserForm'])) { 
          $model->attributes=$_POST['ContactPenUserForm'];// lấy toàn bộ post từ form lên
          // Trước tiên kiểm tra xem Email đã tồn tại trong cơ sở trong dữ liệu chưa
           $user=  Customer::model()->findByAttributes(array("email"=>$model->email));
           //Chữ ký mail
           $sig='<p>&nbsp;</p>';
                  $sig.='<p>&nbsp;</p>';
                  $sig.='<p>&nbsp;</p>';
                  $sig.='<p>&nbsp;</p>';
                  $sig.='<img src="http://members.pif.vn/templates/images/logo.png">';
                  $sig.='<p><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
                  $sig.='<p>E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
                  $sig.='<p><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
                  $sig.='<p><span style="color:#179046">Passion Investment</span></p>';
                  $sig.='<p>Room 502B, 5 th  Floor, Rainbow Building</p>';
                  $sig.='<p>19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
                  $sig.='<p>T: (84) 4 3264 6480</p>';
                  $sig.='<p>W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
                  $sig.'<p>Skype: <a href="hoangnga3119">hoangnga3119</a></p>';
           if($user){// Nếu email đã tồn tại thì chuyển sang trang tạo hợp đồng
              $mess="<h2>Thông báo từ Hệ Thống của Passion Investment</h2>";
                  $mess.='<p>Thành viên vừa truy cập hệ thống đầu tư ngay trên Passion Investment:</p>';
                  $mess.='<ul>';
                  $mess.='<li>Email: '.$user->email.'</li>';
                  $mess.='<li>Họ và Tên: '.$user->fullname.'</li>';
                  $mess.='<li>Số điện thoại: '.$user->telephone.'</li>';
                  $mess.='</ul>';

              Yii::app()->session['UserID']=$user->id;
              $data = [
                  "fullName" =>$model->name,
                  "email" => $model->email,
                  "phone" => $model->telephone
                ];
                $customerId = $this->curlPost("http://pif.vietesoft.com/Customer/APiCreateCustomer",$data);
                Yii::app()->session['PifUserId']=$customerId;

               $this-> mailsend("tuvan@pif.vn","Thành viên vừa truy cập hệ thống đầu tư ngay ngay trên Passion Investment ".date('d-m-Y H:i:s'),$mess.$sig);
              $this->redirect(array("CreateHD"));
           }else{ // Nếu chưa tồn tại thì tạo mới người dùng này
              $User=new Customer;//tạo mới đối tượng khách hàng
              $maxID=Customer::findMaxID();// tìm trong cơ sở dữ liệu max ID
              $autoMa=Customer::AutoMaKH($maxID);//Sinh mã tự  động
              $maKH=Customer::model()->findByAttributes(array("code"=>$autoMa));//Kiểm tra xem mã khách hàng đã tồn tại hay chưa
              if($maKH) {$autoMa=Customer::AutoMaKHUpdate($autoMa); 
              }else{ //Nếu chưa tồn tại bắt đầu lưu khách hàng vào cơ sở dữ lệu
        
                $data = [
                  "fullName" =>$model->name,
                  "email" => $model->email,
                  "phone" => $model->telephone
                ];
                $customerId = $this->curlPost("http://pif.vietesoft.com/Customer/APiCreateCustomer",$data);
                $User->email=$model->email;
                $password=Yii::app()->getSecurityManager()->generateRandomString(15);
                $User->password=md5($password);
                $User->fullname=$model->name;
                $User->telephone=$model->telephone;
                date_default_timezone_set('Asia/Ho_Chi_Minh');//Set defaul timezon Việt Nam
                $User->date_registration=date('Y-m-d H:i:s');
                $User->status=1;
                $User->code=$autoMa;
                $User->code_active=Yii::app()->getSecurityManager()->generateRandomString(20);
                $User->new_password=Yii::app()->getSecurityManager()->generateRandomString(20);
                //Thông báo tới quản trị viên có thành viên mới đăng ký
                 $mes="<h2>Thông báo từ Hệ Thống của Passion Investment</h2>";
                  $mes.='<p>Thành viên mới đăng ký trên hệ thống Passion Investment:</p>';
                  $mes.='<ul>';
                  $mes.='<li>Email: '.$model->email.'</li>';
                  $mes.='<li>Họ và Tên: '.$model->name.'</li>';
                  $mes.='<li>Số điện thoại: '.$model->telephone.'</li>';
                  $mes.='</ul>';
                $mes2 = '<p><strong>Kính gửi quý khách hàng '.$model->name.',</strong></p>
<p>Trước tiên PI xin được cảm ơn quý khách đã quan tâm đến dịch vụ <strong>Hợp tác đầu tư</strong> của <strong>Passion Investment</strong>.</p>
<p>PI xin phép được gửi quý khách bản Giới thiệu về dịch vụ Hợp tác đầu tư trong tệp tin đính kèm và ngắn gọn một vài thông tin về hai hình thức hợp tác như sau:</p>
<p><strong>Chia sẻ lợi nhuận:</strong></p>
<ul>
<li> Lợi nhuận cơ sở cho khách hàng là 6%;</li>
<li> Nếu lợi nhuận vượt mức 6%, khách hàng nhận thêm 80% phần vượt mức 6%;</li>
<li> Khách hàng chấp nhận rủi ro khi đầu tư không hiệu quả.</li>
</ul>
<p><strong>Cam kết lợi nhuận tối thiểu:</strong></p>
<ul>
<li> Khách hàng luôn nhận được tối thiểu 6%;</li>
<li> Nếu lợi nhuận vượt mức 6%, khách hàng nhận thêm 50% phần vượt mức 6%;</li>
<li> Khách hàng không chịu bất kỳ rủi ro thua lỗ nào từ hiệu quả đầu tư.</li>
</ul>
<p>Hàng tuần, <strong>Hiệu quả đầu tư</strong> được cập nhật định kỳ trên website (xem thêm <a href="http://pif.vn/hieu-qua-dau-tu/" target="_blank">tại đây</a>), đồng thời Công ty sẽ <strong>gửi báo cáo tuần</strong> có xác nhận của bên giám sát thứ 3 đến các khách hàng.</p>
<p>Ngoài ra quý khách có thể tham khảo thêm về công ty và dịch vụ Hợp tác đầu tư khi truy cập:<br /><strong>Website:</strong> <a href="http://pif.vn/">http://pif.vn/</a><br /><strong>Fanpage:</strong> Passion Investment - <a href="https://www.facebook.com/pif.vn/">https://www.facebook.com/pif.vn/</a></p>
<p><em><strong>Nếu có thông tin cần giải đáp, kính mong quý khách phản hồi, PI sẽ liên lạc và trao đổi cụ thể.</strong></em></p>
<p>Trân trọng.</p>';
                $file = 'http://members.pif.vn/uploads/Gioi-thieu-dich-vu-Hop-tac-dau-tu-PI.pdf';
                $filename=substr(strrchr($file, "/"), 1);// Lấy tên của file
                if($User->save()){ //Nếu save khách hàng thành công
                   Yii::app()->session['UserID']=$User->id;
                   Yii::app()->session['PifUserId']=$customerId;
                  $this-> mailsend("tuvan@pif.vn","Thành viên mới đăng ký trên hệ thống đầu tư ngay Passion Investment ".date('d-m-Y H:i:s'),$mes.$sig);
                  //$this-> mailsendFile($User->email, 'Passion Investment - Giới thiệu dịch vụ Hợp tác đầu tư', $mes2.$sig,file_get_contents($file),$filename);//gửi giới thiệu đến khách mới

                   $this->redirect(array("CreateHD"));
                }
                
               }
             
           }
         
        }
        $this->render('index',array('model'=>$model));
  }
  /**
  Createby: Hoàng Trung
  Date: 25/10/2016
  Des: Nếu tồn tại session userID thì mới chạy đến action này, action này có chức năng tạo hợp đồng và cập nhật thông tin khách hàng
  */
  public function actionCreateHD(){
    if(Yii::app()->session['UserID']){
      $model=new ContactPenForm;// Tạo mới đối tượng 
      $user=Customer::model()->findByPk(Yii::app()->session['UserID']);//Tìm khách hàng theo ID
      $formContract=new Formcontract;// Tạo mới đối tượng loại hợp đồng
     $dataForm=$formContract->getAllForm('id,name');// Truy vấn để lấy loại hợp đồng để truyền sang dropdowlist
     $temDataCat = array();
     foreach ($dataForm as $item) {
                  $temDataCat[$item['id']] = $item['name'];
                  }
     //Nếu có Post dữ liệu từ khách hàng
        if(isset($_POST['ContactPenForm'])) { 
          $model->attributes=$_POST['ContactPenForm'];
          //Lưu khách hàng vào cơ sở dữ liệu
         
          // $user->numberbank=$_POST['ContactPenForm']['numberbank'];
          // $user->namebank=$_POST['ContactPenForm']['namebank'];
          // $user->chinhanh=$_POST['ContactPenForm']['chinhanh'];
          $user->cmt=$model->cmt;
          $user->cmt_addresscreate=$model->cmt_addresscreate;
          $user->cmt_datecreate=Investment::SaveDate($model->cmt_datecreate);
          $user->mst=$_POST['ContactPenForm']['mst'];
          $user->save();

          $customerId = Yii::app()->session['PifUserId'];

          $data = [
                  "customerId" => $customerId,
                  "IdentityCard" =>$model->cmt,
                  "IdentityCardAddress" => $model->cmt_addresscreate,
                  "IdentityCardDate" => $model->cmt_datecreate,
                  "TaxCode" => $_POST['ContactPenForm']['mst']
                ];
          $id = $this->curlPost("http://pif.vietesoft.com/Customer/APiUpdateCustomer",$data);
          //Xử lý đến phần hợp đồng
          
          $vonHD=$model->investment;
          $vonHD=str_replace('.', '', $vonHD); 

          $dataContract = [
                  "CustomerId" => $customerId,
                  "Type" =>$model->id_form,
                  "ValueContract" => $vonHD                  
                ];
          $noResult = $this->curlPost("http://pif.vietesoft.com/CustomerContract/ApiCreateContract",$dataContract);
              
          //Tạo mã hợp đồng tự động
          $maxID=Contract::FindMax();//Get Max ID 
          $ID=Contract::AutoID($maxID);// lấy được ID tự động
          $maHD=Contract::AutoMaPi($ID);//lấy được  Mã hợp 
          //Lưu hợp đồng vào cơ sở dữ liệu
           $contract=new Contract;
           $contract->id=$ID;
           $contract->number_form=$maHD;
           $contract->id_form=$model->id_form;
           $contract->investment=$vonHD;
           $contract->status=1;
           date_default_timezone_set('Asia/Ho_Chi_Minh');
           $date=date('Y-m-d H:i:s');
           $contract->date_created= $date;
           $contract->date_modified= $date;
           $contract->id_customer=Yii::app()->session['UserID'];
           $form=Formcontract::model()->findByPk($model->id_form);
           $contract->content_contract=$form->content_form;
           //Tạo file hợp đồng
            $contentHD=$this->GenHD($form->content_form,Yii::app()->session['UserID'],$maHD,$date,$vonHD,"sus");
            $filename=$user->fullname.'-'.Investeffects::MailDate($date).'.pdf';
            $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4','12pt',15,15,15,15,10,10,'P','UTF-8');
             
              $mPDF1->SetFont('dejavusans');
              $texttt= '
                <html><head><style>
                body {font-family:dejavusans;}
                p{font-family:dejavusansn;margin-top:6pt;margin-bottom:0pt;line-height:1.5;}
                
                </style></head>

                <body>'.Contract::GenHDView($contentHD).'</body>
                </html>';
              $mPDF1->WriteHTML($texttt);
              // $mPDF1->Output();
                    $sig='<p>&nbsp;</p>';
                $sig.='<p>&nbsp;</p>';
                $sig.='<p>&nbsp;</p>';
                $sig.='<p>&nbsp;</p>';
                $sig.='<img src="http://members.pif.vn/templates/images/logo.png">';
                $sig.='<p><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
                $sig.='<p>E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
                $sig.='<p><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
                $sig.='<p><span style="color:#179046">Passion Investment</span></p>';
                $sig.='<p>Room 502B, 5th Floor, Rainbow Building</p>';
                $sig.='<p>19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
                $sig.='<p>T: (84) 4 3264 6480</p>';
                $sig.='<p>W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
                $sig.'<p>Skype: <a href="hoangnga3119">hoangnga3119</a></p>'; 

                 $mes='<p><strong>Kính gửi quý khách hàng,</strong></p>';
        $mes.='<p>Passion Investment xin phép được gửi quý khách hàng nội dung cách thức chuyển tiền vào tài khoản hợp tác đầu tư của Passion Investment tại Công ty Chứng khoán Vietcombank (VCBS):</p>';
        $mes.='<p>Quý khách có thể chọn một trong hai hình thức và <b>đặc biệt lưu ý viết CHÍNH XÁC tất cả thông tin theo nội dung hướng dẫn dưới đây để tránh sai sót.</b></p>';
        $mes.='<p><strong><i>1. TỪ TẤT CẢ CÁC NGÂN HÀNG NGOẠI TRỪ VIETCOMBANK</i></strong></p>';
        $mes.='<ul>';
        $mes.='<li>Số tài khoản: &nbsp;<strong>0011.002.475.230</strong></li>';
        $mes.='<li>Người nhận: <strong>Công ty TNHH Chứng khoán Ngân hàng TMCP Ngoại thương Việt Nam</strong></li>';
        $mes.='<li>Ngân hàng: <b>Vietcombank – Sở giao dịch</b></li>';
        $mes.='<li>Nội dung: <strong>009C662007 CTCP PASSION INVESTMENT '.Contract::GetIDAuto($maHD).'</strong></li>';
        $mes.='</ul>';
        $mes.='<p>&nbsp;</p>';
        $mes.='<p><strong><i>2. TỪ VIETCOMBANK: </i></strong></p>';
        $mes.='<p><strong>&nbsp;&nbsp;&nbsp;2.1. TẠI QUẦY GIAO DỊCH/ CHI NHÁNH CỦA VIETCOMBANK:</strong></p>';
        $mes.='<ul>';
        $mes.='<li>Số tài khoản: &nbsp;<strong>0011.002.475.230</strong></li>';
        $mes.='<li>Người nhận: <strong>Công ty TNHH Chứng khoán Ngân hàng TMCP Ngoại thương Việt Nam</strong></li>';
        $mes.='<li>Ngân hàng: <b>Vietcombank – Sở giao dịch</b></li>';
        $mes.='<li>Nội dung: <strong>009C662007 CTCP PASSION INVESTMENT '.Contract::GetIDAuto($maHD).'</strong></li>';
        $mes.='</ul>';

        $mes.='<p><strong>&nbsp;&nbsp;&nbsp;2.2. QUA KÊNH INTERNET BANKING CỦA VIETCOMBANK:</strong></p>';
        $mes.='<p><strong><span>Bước 1</span></strong>: <span>Đăng nhập</span> vào tài khoản IBanking tại:</p>';
        $mes.='<p><a href="https://www.vietcombank.com.vn/IBanking2015/55c3c0a782b739e063efa9d5985e2ab4/Account/Login">https://www.vietcombank.com.vn/IBanking2015/55c3c0a782b739e063efa9d5985e2ab4/Account/Login</a></p>';
        $mes.='<p><strong>Bước 2</strong>: Chọn mục ”Thanh toán” và chọn “Dịch vụ tài chính”, màn hình hiển thị các thông tin và điền như sau: </p>';
        $mes.='<ul>';
        $mes.='<li>Nhà cung cấp: <strong>chọn VCBS – Công ty chứng khoán Vietcombank</strong></li>';
        $mes.='<li>Mã khách hàng: <strong>009C662007</strong></li>';
        $mes.='<li>Tên khách hàng: <strong>CTCP PASSION INVESTMENT '.Contract::GetIDAuto($maHD).'</strong></li>';
        $mes.='</ul>';
        $mes.='<p>&nbsp;</p>';
        $mes.='<p><b>Ghi chú</b>: Ở phần <strong>Nội dung chuyển tiền</strong>, Passion Investment xin được giải thích thông tin như sau:</p>';
                  $mes.='<ul>';
                  $mes.='<li><strong>009C662007 </strong> là tài khoản chứng khoán của công ty Passion Investment mở <span>tại</span> công ty chứng khoán;</li>';  
                  $mes.='<li><strong>'.Contract::GetIDAuto($maHD).' </strong><span>là</span> hợp đồng Hợp tác đầu tư số <strong>'.Contract::GetIDAuto($maHD).'</strong></li>';
                  $mes.='</ul>';
                //  $mes.='<p style="color:red;font-weight:300;"><i>Lưu ý: Tại phần <strong>Nội dung</strong>, quý khách hàng lưu ý viết không dấu, phần <strong>"Họ và tên khách hàng"</strong> sẽ trùng với họ tên của khách hàng trong hợp đồng ký kết với Passion Investment.</i></p>';          
        $mes.='<p><strong>Ngoài ra, quý khách vui lòng cung cấp thông tin dưới đây để Passion Investment soạn thảo hợp đồng:</strong></p>';
                  $mes.='<ul>';
                  $mes.='<li>Ảnh chụp hoặc bản photo CMT/ hộ chiếu (trong đó có rõ Họ tên, số CMT, ngày cấp, nơi cấp)</li>';
                  $mes.='<li>Mã số thuế cá nhân (nếu có):</li>';
                  $mes.='<li>Hình thức hợp tác:</li>';
                  $mes.='<li>Số TK ngân hàng, chủ tài khoản, chi nhánh (dùng khi tất toán hợp đồng)</li>';
                  $mes.='<li>Địa chỉ giao Hợp đồng</li>';
                  $mes.='</ul>';
         $mes.='<p><i><strong>Nếu có thông tin cần giải đáp, kính mong quý khách phản hồi, PI sẽ liên lạc để trao đổi cụ thể.</strong></i></p>';
         $mes.='<p>Trân trọng!</p>';  
           if($contract->save()) {//Sau khi lưu hợp đồng vào cơ sở dữ liệu thì xóa session, và redict tới trang thành công
             unset(Yii::app()->session['UserID']);
             unset(Yii::app()->session['PifUserId']);
             $this-> mailsendFile($user->email, 'Passion Investment - Hướng dẫn chuyển tiền  '.date('d-m-Y H:i:s'), $mes.$sig,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename);//gửi đến người dùng
             Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/ContactPen/Sus"));
           }
        }          
      $this->render('create',array('model'=>$model,'dataCat' => $temDataCat,'user'=>$user));
    }else {
      echo "Err";
    }
     
  }

  public function curlPost($url, $data) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    //var_dump($data);
    curl_close($ch);

    return $response;
  }

	// public function actionIndex()
	// {
	// 	$model=new ContactPenForm;
	// 	$formContract=new Formcontract;
	// 	$dataForm=$formContract->getAllForm('id,name');
	// 	$temDataCat = array();
	// 	foreach ($dataForm as $item) {
 //                $temDataCat[$item['id']] = $item['name'];
 //                }
	// 	if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
	// 	{
	// 		echo CActiveForm::validate($model);
	// 		Yii::app()->end();
	// 	}
	// 	if(isset($_POST['ContactPenForm'])) {
			
	// 		// $model->attributes=$_POST['ContactPenForm'];
	// 		// print_r($model->attributes);
	// 		date_default_timezone_set('Asia/Ho_Chi_Minh');
	// 		$models=new Contactpen;
	// 		$models->email=$_POST['ContactPenForm']['email'];
	// 		$models->fullname=$_POST['ContactPenForm']['name'];
	// 		$models->telephone=$_POST['ContactPenForm']['telephone'];
	// 		$models->mst=$_POST['ContactPenForm']['mst'];
	// 		$models->cmt=$_POST['ContactPenForm']['cmt'];
	// 		$models->cmt_datecreate=Investment::SaveDate($_POST['ContactPenForm']['cmt_datecreate']);
	// 		$models->cmt_addresscreate=$_POST['ContactPenForm']['cmt_addresscreate'];
	// 		$models->status=1;//Trạng thái chưa xác nhận
	// 		$models->id_form=$_POST['ContactPenForm']['id_form'];
	// 		$vonHD=$_POST['ContactPenForm']['investment'];
	// 		 $vonHD=str_replace('.', '', $vonHD); 
	// 		$models->investment=$vonHD;
	// 		 $date=date('Y-m-d H:i:s');
	// 		$models->date_created=$date;
	// 		$models->date_modified=$date;
	// 		$form=Formcontract::model()->findByPk($_POST['ContactPenForm']['id_form']);
			
	// 		 //
	// 		 $contentHD=$this->GenHD($form->content_form,$models->date_modified,$vonHD,$models->cmt,$models->fullname,$models->cmt_addresscreate,$models->telephone,$_POST['ContactPenForm']['cmt_datecreate'],$models->mst,$models->email);
	// 		  //tạo tên file
 //             $filename=$models->fullname.'-'.Investeffects::MailDate($date).'.pdf';
 //             // tạo file pdf
 //           //   $contentPDF=str_replace("mso-special-character: line-break; page-break-before: always;","margin-top:15pt; ",$contentUpdate);
 //               $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4','12pt',15,15,15,15,10,10,'P','UTF-8');
             
 //              $mPDF1->SetFont('dejavusans');
 //              $texttt= '
 //                <html><head><style>
 //                body {font-family:dejavusans;}
 //                p{font-family:dejavusansn;margin-top:6pt;margin-bottom:0pt;line-height:1.5;}
                
 //                </style></head>

 //                <body>'.Contract::GenHDView($contentHD).'</body>
 //                </html>';
 //              $mPDF1->WriteHTML($texttt);
 //              $mPDF1->Output();
 //             // $content_PDF =$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING);   
 //                // chữ kí số
 //          $sig='<p>&nbsp;</p>';
 //          $sig.='<p>&nbsp;</p>';
 //          $sig.='<p>&nbsp;</p>';
 //          $sig.='<p>&nbsp;</p>';
 //          $sig.='<img src="http://members.pif.vn/templates/images/logo.png">';
 //          $sig.='<p><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
 //          $sig.='<p>E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
 //          $sig.='<p><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
 //          $sig.='<p><span style="color:#179046">Passion Investment</span></p>';
 //          $sig.='<p>Room 502B, 5 th  Floor, Rainbow Building</p>';
 //          $sig.='<p>19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
 //          $sig.='<p>T: (84) 4 3264 6480</p>';
 //          $sig.='<p>W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
 //          $sig.'<p>Skype: <a href="hoangnga3119">hoangnga3119</a></p>'; 

 //           $mes='<p><strong>Kính gửi quý khách hàng '.$models->fullname.',</strong></p>';
 //           $mes.='<p>Passion Investment  xin thông báo quý khách hàng vừa tạo hợp đồng thành công!.';
 //           $mes.='<p>Dưới đây là mẫu hợp đồng của quý khách hàng (tệp đính kèm)</p>';
 //         $models->content_contract=Contract::GenHDView($contentHD); 
	// 		 if($models->save()){
	// 		 	 $this-> mailsendFile($models->email, 'Mẫu hợp đồng Passion Investment '.date('d-m-Y H:i:s'), $mes.$sig,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename);//gửi đến người dùng
	// 		 	Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/ContactPen/Sus"));
	// 		 }
	// 	}
	// 	$this->render('index',array('model'=>$model,'dataCat' => $temDataCat));
	// }
		public function actionSus()
	   {
		

		$this->render('sus');
	}
	  /**
     Hàm tạo ra hợp đồng để in / được lưu vào cơ sở dữ liệu
    */
     static function GenHD($content,$id,$so_hd,$date,$vonHD,$class){
      date_default_timezone_set('Asia/Ho_Chi_Minh');
       $temTime = strtotime($date);
       $sMonth= date('m',$temTime);//Lấy được tháng từ ngày ký HD
       $sday= date('d',$temTime);//Lấy được date từ ngày ký hợp đồng
       $sYear=date('Y',$temTime);// Lấy được năm từ ngày ký HĐ
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
        if($cus->namebank!=null && $cus->chinhanh!=null){
         $contents=str_replace("hd_banks",$cus->namebank." - CN ".$cus->chinhanh ,$contents);
       }
       if($class=="fail"){
          $contents=str_replace("hd_class","fail",$contents);
       }
       if($class=="sus"){
          $contents=str_replace("hd_class","sus",$contents);
       }
       //$T=date("Y-m-d", $date) ;
       $Ts=date("Y-m-d",strtotime("$date - 1 day"));//tính ra 1 ngày trước hôm ký HĐ

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
            //Nếu ngày kết thúc mà nhỏ hơn 10 thì thêm số 0 vào đằng trước
            if($fnday<10){
              $fnday='0'.$fnday;
            }
       }
       $contents=str_replace("hds_updates_dates_fn",$fnday,$contents);
       $contents=str_replace("hds_updates_months_fn",$sMonth,$contents);
       $contents=str_replace("hds_updates_years_fn",$fnYear,$contents);
       return $contents;
     }
    static function mailsendFile($to,$subject,$message,$content,$filename){
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
        $mail->AddReplyTo('tuvan@pif.vn',"Passion Investment");
        $mail->AddCC("baocao@pif.vn", "Passion Investment");
        $mail->AddCC("tuvan@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        $mail->IsHTML(true);  
        $mail->AddStringAttachment($content,$filename);
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
         $mail->ClearAllRecipients( ); // clear all
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
        $mail->AddReplyTo('admin@pif.vn',"Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        $mail->AddCC("tuvan@pif.vn", "Passion Investment");
        $mail->AddCC("cskh@pif.vn", "Passion Investment");
        $mail->AddCC("dvkh@pif.vn", "Passion Investment");
        $mail->AddCC("chuminhngoc@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->IsHTML(true);  
     
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
         $mail->ClearAllRecipients( ); // clear all
    }

}