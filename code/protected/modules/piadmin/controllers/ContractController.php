<?php

class ContractController extends Controller
{
     public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
    /**
    Mặc định sẽ nhảy vào trang Danh sách hợp đồng
    Đưa ra danh sách hợp đồng đã phân trang
    */
    public function actionIndex()
    {
       if(Yii::app()->session['adid']) {
          $contract=Contract::adGetAllContract(); //Lấy tất cả dữ liệu về hợp đồng
          $form=Formcontract::getAllForm('id,name');//Lấy dữ liệu về loại hợp đồng
           if(isset($_POST['filters'])){
             $value=$_POST['filters'];
             $param = Yii::app()->request->getParam('page');
             $page = (isset($param) ? $param - 1 : 0);
             $count = Contract::getTotalNumberRow();
             $pages = new CPagination($count);
             $apage = Yii::app()->params['pager']; 
             $pages->setPageSize($apage);
             $data = Contract::getLimitContractBy($value,$page, $apage); 
             $cus=Customer::getAllCustomer();
             $this->render('index',array("contract"=>$contract,'form'=>$form,'cus'=>$cus,"sus"=>0,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
          }
           //Xử lý limit
           $param = Yii::app()->request->getParam('page');//Lấy tham số page _GET
           $page = (isset($param) ? $param - 1 : 0);// Tính ra số page
           $count = Contract::getTotalNumberRow();//Tính tổng được số hợp đồng
           $pages = new CPagination($count); //Thông qua hàm phân trang của Yii 
           $apage = Yii::app()->params['pager']; //Số hợp đồng trên 1 trang /Cấu hình ở main.php
           $pages->setPageSize($apage);//Tính ra được số page
           $data = Contract::getLimitContract($page, $apage); //Sau đó lấy dự liệu theo phân trang 
           $cus=Customer::getAllCustomer();
           $this->render('index',array("contract"=>$contract,'form'=>$form,'cus'=>$cus,"sus"=>0,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
       }else {
           Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));        
          //  header('Content-type: application/json');
            //         echo CJSON::encode("Err");
              //      Yii::app()->end(); 
       }    
        
    }
  /**
  Hàm lọc
  */
  public function actionFilter(){
      if(Yii::app()->session['adid']) {
          $contract=Contract::adGetAllContract();
          $form=Formcontract::getAllForm('id,name');
            if(isset($_POST['filters'])){
             $value=$_POST['filters'];// get loại hợp đồng
             $status=$_POST['status'];// get trạng thái
             $type=$_POST['typecontract']; // get loại filter
             $ma=$_POST['ma'];
             if($value!=null){ //Nếu mà loại hơp đồng thay đổi thì gán cho nó một biến session
                Yii::app()->session['filters']= $value;
             }
              if($status!=null){ //Nếu trạng thái thay đổi thì gán cho nó 1 biến session
                Yii::app()->session['status']= $status;
             } 
              if($type!=null){//Nếu loại filer thay đổi thì gán cho nó 1 biến session
                Yii::app()->session['type']= $type;
             }  
            if($type!=null){//Nếu loại filer thay đổi thì gán cho nó 1 biến session
                Yii::app()->session['ma']= $ma;
             } 
           }
            $param = Yii::app()->request->getParam('page');
             $page = (isset($param) ? $param - 1 : 0);
             $dataTotal = Contract::getLimitContractTotal(Yii::app()->session['filters'], Yii::app()->session['status'],Yii::app()->session['type'],Yii::app()->session['ma']);
             $count = count($dataTotal);
             $pages = new CPagination($count);
             $apage = Yii::app()->params['pager']; 
             $pages->setPageSize($apage);
             $data = Contract::getLimitContractBy(Yii::app()->session['filters'],$page, $apage, Yii::app()->session['status'],Yii::app()->session['type'],Yii::app()->session['ma']); 
             $cus=Customer::getAllCustomer();
             $this->render('index',array("contract"=>$contract,'form'=>$form,'cus'=>$cus,"sus"=>0,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
       //Xử lý limit
          
     }else {
       Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));    
          //  header('Content-type: application/json');
            //         echo CJSON::encode("Err");
              //      Yii::app()->end(); 
     } 
  }
  /**
  Xem chi tiết hợp đồng
  param:@id
  */
    public function actionViews($id){
        if(Yii::app()->session['adid']) {
         $this->render('view',array(
                'model'=>$this->loadModel($id),
          ));
        }else {
            // header('Content-type: application/json');
              //       echo CJSON::encode("Err");
                //    Yii::app()->end();
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));       
        }
    }
  /**
  Sửa hợp đồng
  --Lúc này mới lưu lại bản hợp đồng vào database
  --Và sau đó sẽ không thể sửa lại nội dung bản hợp đồng nữa
  */
 public function actionEditss($id){
    if (Yii::app()->session['adid']) {
        $model = $this->loadModel($id);//load đối tượng hợp đồng theo ID
        $content = $model->content_contract;  //Lấy nội dung bản hợp đồng
        $form_id = $model->id_form; // Lấy được ID của loại hợp đồng
        $forms = Formcontract::model()->findByPk($form_id); //từ ID loại hợp đồng lấy được nội dung bản hợp đồng
        $kh = $model->id_customer;//Lấy được ID khách hàng của hợp đồng này
        $maHD = $model->number_form; //Lấy được mã hợp đồng của hợp đồng
        $date = $model->date_modified; //Lấy được ngày chính thức ký hợp đồng
        $datecreate = $model->date_created;
        if ($date) {
        } else {  //trường hợp ngày chính thức không có thì lấy ngày tạo hợp đồng
            $date = $model->date_created;  //Vì do trường date_modified sau này mới cập nhật nên nhiều hợp đồng trước đóa không có date_modified
        }

        $vonHDold = $model->investment;// Vốn hợp đồng cũ
        $form = Formcontract::getAllForm('id,name');
        if (isset($_POST['Contract'])) {

            $model->attributes = $_POST['Contract'];
            $vonHD = $_POST['Contract']['investment'];
            $check = $_POST['remember'];
            $eCompleted = $_POST['eCompleted'];
            $model->date_modified = Investment::SaveDate($_POST['Contract']['date_modified']);
            if ($_POST['Contract']['date_modified']) {
                $date = Investment::SaveDate($_POST['Contract']['date_modified']);
            }
            if ($vonHD) {
                $vonHD = str_replace('.', '', $vonHD);
                $model->investment = $vonHD;
                $vonHDold = $vonHD;
            }
            $status = $_POST['Contract']['status'];
            $idform = $_POST['Contract']['id_form'];
            $contentUpdate = $this->GenHD($forms->content_form, $kh, $maHD, $date, $vonHDold, "sus");//Tạo nội dung hợp đồng
            $model->content_contract = $contentUpdate;
//Thông báo cập nhật hợp đồng
            $cuss = Customer::model()->findByPk($kh);
            $formss = Formcontract::model()->findByPk($idform);
// Thư cảm ơn
//tạo tên file
            $filename = Contract::GetIDAuto($maHD) . '.HĐBCC' . '-' . $cuss->fullname . '-' . date('d-m-Y') . '.pdf';
//tính số đơn vị đầu tư vào quy đổi
            $Ts = date("Y-m-d", strtotime("$date - 1 day"));//tính ra 1 ngày trước hôm ký HĐ
            $iv = Investment::model()->findByAttributes(array("date" => Investment::SaveDate($Ts)));
            $sldvdt = '';
            if ($iv) {
                $sldvdt = number_format($iv->motdvdt, 0, ',', '.');
            }
            $DV = '';
            if ($iv != null && $vonHDold != null) {
                if ($iv->motdvdt != 0) {
                    $dv = (double)$vonHD / (double)($iv->motdvdt);
                    $DV = number_format(round($dv, 0), 0, ',', '.');
                }
            }
            $mes = '<p><strong>Kính gửi quý khách hàng ' . $cuss->fullname . ',</strong></p>';
            $mes .= '<p>Passion Investment  xin thông báo khoản vốn <strong>' . number_format(round($vonHD, 0), 0, ',', '.') . '</strong> đồng đã vào tài khoản hợp tác đầu tư.&nbsp;';
            $mes .= 'Kính gửi quý khách bản hợp đồng hợp tác số <strong>' . $maHD . '</strong> trong tệp tin đính kèm.</p>';
            $mes .= '<p>Vào ngày ' . Investment::ViewDate($date) . ',&nbsp;quý khách đã sử dụng dịch vụ Hợp tác đầu tư, với:</p> ';
            $mes .= '<ul>';
            $mes .= '<li><strong>Số vốn đầu tư</strong> là:<strong> ' . number_format(round($vonHD, 0), 0, ',', '.') . '</strong> đồng</li>';
            $mes .= '<li><strong>Giá trị 1 ĐVĐT</strong> là: <strong>' . $sldvdt . '</strong> đồng</li>';
            $mes .= '<li>Quy đổi <strong>số lượng ĐVĐT</strong> là: <strong>' . $DV . '</strong> đơn vị đầu tư </li>';
            $mes .= '</ul>';
            $mes .= '<p>Quý khách hàng có thể theo dõi trực tiếp Hiệu quả đầu tư của công ty <a href="http://pif.vn/hieu-qua-dau-tu/">tại đây</a>.</p>';
            $mes .= '<p>Ngoài ra,<span> Passion Investment xin được gửi lời cảm ơn chân thành đến quý <span>khách</span> hàng đã</span> ';
            $mes .= '<span>không ngừng quan tâm và đồng hành cùng công ty</span>.&nbsp;';
            $mes .= 'Passion Investment <span>cũng</span> hy vọng trong thời gian tới sẽ tiếp tục nhận được sự quan tâm và tín nhiệm của quý khách hàng.</p>';
            $mes .= '<p><i><strong>Trong hợp đồng nếu có thông tin cần sửa đổi, kính mong quý khách phản hồi. Bên PI sẽ kiểm tra và bổ sung lại nhanh nhất có thể.</strong></i></p>';
            $mes .= '<p>Trân trọng!</p>';
//tạo tên file
            $filename = Contract::GetIDAuto($maHD) . '.HĐBCC' . '-' . $cuss->fullname . '-' . Investeffects::MailDate($date) . '.pdf';
// tạo file pdf
            $contentPDF = str_replace("mso-special-character: line-break; page-break-before: always;", "margin-top:15pt; ", $contentUpdate);
            $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4', '11pt', 10, 10, 10, 10, 10, 10, 'P', 'UTF-8');

            $mPDF1->SetFont('dejavusans');
            $texttt = '
<html><head><style>
        body {font-family:dejavusans;}
        p{font-family:dejavusansn;font-size:11pt;}

    </style></head>

<body>' . Contract::GenHDView($contentPDF) . '</body>
</html>';
            $mPDF1->WriteHTML($texttt);
// $mPDF1->Output();
// $content_PDF =$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING);
// chữ kí số
            $sig = '<p>&nbsp;</p>';
            $sig .= '<p>&nbsp;</p>';
            $sig .= '<p>&nbsp;</p>';
            $sig .= '<p>&nbsp;</p>';
            $sig .= '<img src="http://members.pif.vn/templates/images/logo.png">';
            $sig .= '<p><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
            $sig .= '<p>E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
            $sig .= '<p><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
            $sig .= '<p><span style="color:#179046">Passion Investment</span></p>';
            $sig .= '<p>Room 502B, 5 th  Floor, Rainbow Building</p>';
            $sig .= '<p>19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
            $sig .= '<p>T: (84) 4 3264 6480</p>';
            $sig .= '<p>W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
            $sig . '<p>Skype: <a href="hoangnga3119">hoangnga3119</a></p>';
//update 17/08/2016 by Hoàng Trung

            $mesCompleted = '<p><b>Kính gửi quý khách hàng (Tên KH)</b></p>,
<p>Passion Investment xin thông báo Hợp đồng số '.$maHD.' của quý khách đã được tất toán thành công vào ngày <b>'.date("d/m/Y", time() + 7 * 3600).'</b>.</p>
<p>Biên bản thanh lý sẽ được thực hiện trong vòng 05 ngày làm việc kể từ ngày Passion Investment nhận được biên bản có chữ ký của quý khách.</p>
<p>Passion Investment xin được gửi lời cảm ơn chân thành đến quý khách hàng đã không ngừng quan tâm và đồng hành cùng công ty trong thời gian qua. Passion Investment cũng hy vọng trong thời gian tới sẽ tiếp tục nhận được sự tín nhiệm và hợp tác cùng với quý khách.</p>
<p>Trân trọng.</p>';

            $quantri = Admin::model()->findByPk(Yii::app()->session['adid']);
            $email_send = "";
            $email_pass = $quantri->pass_email;
            if ($quantri->email_send) {
                $email_send = $quantri->email_send;
            } else {
                $email_send = $quantri->email;
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            if ($model->save()){
// $this-> mailsend($cuss->email, 'Cập nhật hợp đồng trên Passion Investment '.date('d-m-Y H:i:s'), $message);//gửi đến người dùng
                if ($check == 1) {
                    if ($status == 2) {
                        $this->mailsendFileByS($cuss->email, 'Thư cảm ơn của Passion Investment ' . date('d-m-Y H:i:s'), $mes . $sig, $mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING), $filename, $email_send, $email_pass);//gửi đến người dùng
                        if ($cuss->email_secondary) {
                            $this->mailsendFileByS($cuss->email_secondary, 'Thư cảm ơn của Passion Investment ' . date('d-m-Y H:i:s'), $mes . $sig, $mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING), $filename, $email_send, $email_pass);//gửi đến người dùng
                        }
                        if ($cuss->email_third) {
                            $this->mailsendFileByS($cuss->email_third, 'Thư cảm ơn của Passion Investment ' . date('d-m-Y H:i:s'), $mes . $sig, $mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING), $filename, $email_send, $email_pass);//gửi đến người dùng
                        }
                    } else {
// $this-> mailsend($cuss->email, 'Cập nhật hợp đồng trên Passion Investment '.date('d-m-Y H:i:s'), $message.$sig);//gửi đến người dùng
                    }

                }
//Gửi biên bản tất toán đến Khách hàng - Thế Lê 8/11/2016
                if ($eCompleted == 1 && $status == 3) {
                    $this->mailsendTest($cuss->email, 'Passion Investment  – Tất toán hợp đồng '.$maHD.' thành công', $mesCompleted . $sig, $email_send, $email_pass);//gửi đến người dùng
                    if ($cuss->email_secondary) {
                        $this->mailsendTest($cuss->email_secondary, 'Passion Investment  – Tất toán hợp đồng '.$maHD.' thành công', $mesCompleted . $sig, $email_send, $email_pass);
                    }
                    if ($cuss->email_third) {
                        $this->mailsendTest($cuss->email_third, 'Passion Investment  – Tất toán hợp đồng '.$maHD.' thành công', $mesCompleted . $sig, $email_send, $email_pass);
                    }
                }
            }

            $contract = Contract::adGetAllContract();
            $form = Formcontract::getAllForm('id,name');
            $cus = Customer::getAllCustomer();
            $this->render('update', array("contract" => $contract, 'form' => $form, 'cus' => $cus, "sus" => 1, 'model' => $model));

        }
    }
}

    public function actionEdits($id){
           if(Yii::app()->session['adid']) {
              $model=$this->loadModel($id);
              $content= $model->content_contract;
              $form=Formcontract::getAllForm('id,name');
           if(isset($_POST['Contract']))
                {
             // echo "<pre>";print_r($_POST);die();
             //Tham số update đầy đủ hợp đồng
            $time_tn=$_POST['time_tn'];
            $totalvalue=$_POST['totalvalue'];
            $dvdt=$_POST['dvdt'];
            $onedvdt=$_POST['onedvdt'];
            $moneyA=$_POST['moneyA'];
            $moneyAtext=$_POST['moneyAtext'];
            $dvdtA=$_POST['dvdtA'];
            $dvdtAtext=$_POST['dvdtAtext'];
            $date_start=$_POST['date_start'];
            $month_start=$_POST['month_start'];
            $year_start=$_POST['year_start'];
            $date_fn=$_POST['date_fn'];
            $month_fn=$_POST['month_fn'];
            $year_fn=$_POST['year_fn'];
          //  $contentUpdate=$this->GenHD($content,$time_tn,$totalvalue,$dvdt,$onedvdt,$moneyA,$moneyAtext,$dvdtA,$dvdtAtext,$date_start,$month_start,$year_start,$date_fn,$month_fn,$year_fn);
            //
                $model->attributes=$_POST['Contract'];
                $model->date_created=Contract::SaveDate($_POST['Contract']['date_created']);
            $model->content_contract=$contentUpdate;
                 if($model->save())
                     $contract=Contract::adGetAllContract();
             $form=Formcontract::getAllForm('id,name');
             $cus=Customer::getAllCustomer();
              $this->render('update',array("contract"=>$contract,'form'=>$form,'cus'=>$cus,"sus"=>1,'model'=>$model));
               }
              $this->render('update',array(
                   'model'=>$model,'form'=>$form,"sus"=>0
              ));
           }else {
           //   header('Content-type: application/json');
             //        echo CJSON::encode("Err");
               //     Yii::app()->end();
               Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));        
           }
    }
    public function actionupdateHD() {
       if(Yii::app()->session['adid']) { 
          if(Yii::app()->request->getPost('id')) {
                  $id=Yii::app()->request->getPost('id');
                  $status=Yii::app()->request->getPost('status');
                  $model=Contract::model()->findByPk($id);
                  $model->status=$status;
                  if($model->save()){ 
                     echo 1;
                     
                  }else {
                    echo 0;
                  }
          }       
       }else {

       //    header('Content-type: application/json');
         //            echo CJSON::encode("Err");
           //         Yii::app()->end();
        Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));                  
       }
     
    }
  /**
  Hàm kiểm tra xem đã có hợp đồng tồn tại trong cơ sở dữ liệu chưa
  */
  public function actionCheckHD() {
     if(Yii::app()->session['adid']) {  
          $hd=Yii::app()->request->getPost('hd');
          $contract=Contract::model()->findByAttributes(array("number_form"=>$hd));
          if($contract){
             echo "1";
          }else {
            echo "0";
          }
     }else {
       // header('Content-type: application/json');
         //            echo CJSON::encode("Err");
           //         Yii::app()->end();
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));                 
     }
  }
  /**
  Lưu lại hợp đồng
  */
    public function actionSaveHD() {
          if(Yii::app()->session['adid']) { 
       if(isset($_POST['kh'][0])) {   
       $maHD=$_POST['maHD'];
       $htHD=$_POST['htHD'];
       $khHD=$_POST['kh'][0];
       $vonHD=$_POST['vonHD'];
       $noteHD=$_POST['note'];
       $check=$_POST['remember'];
            $vonHD=str_replace('.', '', $vonHD); 
      
       if($maHD==null || $maHD== " "){ //Trương hợp tự sinh MÃ HD
                $maxID=Contract::FindMax();//Get Max ID 
                $ID=Contract::AutoID($maxID);// lấy được ID tự động
                $maHD=Contract::AutoMaPi($ID);//lấy được  Mã hợp đồng
       }else {
        $ID=Contract::GetIDAuto($maHD);//Trương hợp khách nhập mã hợp đồng --->lấy được ID
       }
        $model=new Contract;
              $model->id=$ID;
        $model->number_form=$maHD;
        $model->id_form=$htHD;
        $model->investment=$vonHD;
        $model->status=1;
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $date=date('Y-m-d H:i:s');
        $model->date_created= $date;
        $model->date_modified= $date;
        $model->id_customer=$khHD;
        $model->note=$noteHD;
        $form=Formcontract::model()->findByPk($htHD);
       // $hd=$this->GenHD($form->content_form,$khHD,$maHD,$date,$vonHD) ;
        $model->content_contract=$form->content_form;
        //Thông báo từ hệ thống khi người dùng khi tạo hợp đồng mới
        $kh=Customer::model()->findByPk($khHD);
        $message='<h2>Thông Báo từ Hệ Thống Website của Passion Investment</h2>';
        $message.='<p>Quản trị viên đã tạo hợp đồng số '.$maHD.' cho quý khách trên hệ thống Passion Investment</p>';
        $message.='<p>Đăng nhập link dưới đây  để biết thêm chi tiết</p>';
        $message.='<a href="http://members.pif.vn/">http://members.pif.vn/</a>';
        $message.='<p>Nếu Quý khách chưa có tài khoản trên hệ thống của Passion Investment , hoặc có bất kỳ thắc mắc nào, xin vui lòng liên hệ trực tiếp với Passion Investment:</p>';
        $message.='<p>Điện thoại: <a href="tel:0432646480">(04) 32 646 480</a></p>';
        $message.='<p>Hotline: <a href="tel:84972936023">(84) 972 936 023</a></p>';
        $message.='<p>Email: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a></p>';
         //Thông báo hướng dẫn nội tiền
        $fullname=$kh->fullname;
        $name=Contract::convert_vi_to_en($fullname);
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
        $mes.='<p><strong>Bước 2</strong>: Chọn mục “Thanh toán” và chọn “Dịch vụ tài chính”, màn hình hiển thị các thông tin và điền như sau: </p>';
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
        // $mes.='<p>Nếu còn thông tin chưa rõ ràng, rất mong quý khách hàng phản hồi lại phía Passion Investment để công ty có thể bổ sung và phục vụ quý khách hàng một cách tốt nhất ạ!</p>';
        // $mes.='<p>Xin chân thành cảm ơn và chúc quý khách hàng một ngày mới vui vẻ!</p>';
        // chữ kí số
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
         // Gửi đến quản trị viên
         $ad='Email đã được gửi tới khách hàng '.$fullname.' với nội dung như sau:';
        //update 17/08/2016 by Hoàng Trung
        $quantri=Admin::model()->findByPk(Yii::app()->session['adid']);
        $email_send="";
        $email_pass=$quantri->pass_email;
        if($quantri->email_send){
           $email_send=$quantri->email_send;
        }else{
           $email_send=$quantri->email;
        }
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        if($model->save()) {
                   //$this->redirect(array('Views','id'=>$model->id));
          if($check==1) {
           //  $this-> mailsendTest($kh->email, 'Tạo hợp đồng mới trên Passion Investment '.date('d-m-Y H:i:s'), $message.$sig);//gửi đến người dùng
             $this-> mailsendTest($kh->email, 'Passion Investment - Hướng dẫn chuyển tiền  '.date('d-m-Y H:i:s'),$mes.$quantri->signature,$email_send,$email_pass);//gửi đến người dùng
                if($kh->email_secondary){
                   $this-> mailsendTest($kh->email_secondary, 'Passion Investment - Hướng dẫn chuyển tiền  '.date('d-m-Y H:i:s'),$mes.$quantri->signature,$email_send,$email_pass);//gửi đến người dùng
             }
              if($kh->email_third){
                $this-> mailsendTest($kh->email_third, 'Passion Investment - Hướng dẫn chuyển tiền  '.date('d-m-Y H:i:s'),$mes.$quantri->signature,$email_send,$email_pass);//gửi đến người dùng
             }
          }
         
           $this->redirect(array('Review','id'=>$model->id));
                 }else {
           echo CJSON::encode("Err!Null");
         }
       }else {
        $form=Formcontract::getAllForm('id,name');
        $cus=Customer::getAllCustomer();
        $this->render('create',array("form"=>$form,"cus"=>$cus,"err"=>1));
     }
     }else {
           Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));            
     }
    }
      /**
     RewView lại thông tin sau khi đã đăng kí 
     param @ID
     */
    public function actionReview($id) {
      if(Yii::app()->session['adid']!==null) {
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
  Tạo mới khách hàng vì có quyền quản trị
  */
    public function actionCreateKH() {
         $new_pass=Yii::app()->getSecurityManager()->generateRandomString(20);
        $this->render('createkh',array("pass"=>$new_pass,"sus"=>0,"fail"=>0));
    }
    public function actionSaveKH() {
      if(Yii::app()->session['adid']) { 
        if(isset($_POST)) {

         $model=new Customer;
         $maxID=Customer::findMaxID();// tìm trong cơ sở dữ liệu max ID
         $autoMa=Customer::AutoMaKH($maxID);//Sinh mã tự  động
         $maKH=Customer::model()->findByAttributes(array("code"=>$autoMa));
         if($maKH) {
           $autoMa=Customer::AutoMaKHUpdate($autoMa);
         }else {
          $model->email=$_POST['kh_email'];
          $model->password=md5($_POST['kh_password']);
          $model->fullname=$_POST['kh_fullname'];
          $model->email_secondary=$_POST['reg_email_sc'];
          $model->email_third=$_POST['reg_email_tr'];
          $model->mst=$_POST['reg_mst'];
          $model->telephone=$_POST['reg_telephone'];
          $model->address=$_POST['address'];
          $model->birthday=Investment::SaveDate($_POST['birthday']);
          $model->cmt=$_POST['reg_cmt'];
          $model->numberbank=$_POST['reg_banknumber'];
          $model->namebank=$_POST['reg_namebank'];
          $model->chinhanh=$_POST['reg_bankaddress'];
          $model->bankacount=$_POST['reg_bankacount'];
          if($_POST['cmt_date']){
           $model->cmt_datecreate=Investment::SaveDate($_POST['cmt_date']);
         }
         $model->cmt_addresscreate=$_POST['reg_cmt_address'];
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $model->date_registration=date('Y-m-d H:i:s');
         $model->status=1; 
         $model->code=$autoMa;         
         $model->new_password=Yii::app()->getSecurityManager()->generateRandomString(20);
         $model->id_admin=Yii::app()->session['adid'];
         if($model->save()){ 
           $new_pass=Yii::app()->getSecurityManager()->generateRandomString(20);
           $this->render('createkh',array("sus"=>1,"pass"=>$new_pass,"fail"=>0));
         }else {
          $this->render('createkh',array("fail"=>1,"pass"=>$new_pass,"sus"=>0));
        }
      }


    }
  }else {
    Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
  }
}
  /**
  In hợp đồng
  */
  public function actionprintHD(){
     if(Yii::app()->session['adid']) { 
        $id=Yii::app()->request->getPost('id');// lấy được ID hợp đồng
        $contract=Contract::model()->findByPk($id);//Tìm kiếm hợp đồng theo ID
        $cus=Customer::model()->findByPk($contract->id_customer);//Tìm kiếm khách hàng theo ID khách hàng trong bản hợp đồng
        $form=Formcontract::model()->findByPk($contract->id_form);//lấy được form của hợp đồng
        $date=$contract->date_modified;//Lấy date của hợp đồng
       if($date){ }else {
         $date=$contract->date_created;
       }
       $status="fail";
       if($contract->status==2 ||$contract->status==3){
        $status="sus";
       }
         $hd=$this->GenHD($form->content_form, $contract->id_customer,$contract->number_form,$date,$contract->investment,$status) ;
        $name=$contract->number_form."-".$cus->fullname;
        $data=array("content"=>Contract::GenHDView($hd),"name"=>$name); 
        echo json_encode($data);
    }else {
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
    }
     
     
  }
  /**
   Tạo mới hợp đồng
  */
    public function actionCreateHD(){
        
        $form=Formcontract::getAllForm('id,name');
        $cus=Customer::getAllCustomer();
        $this->render('create',array("form"=>$form,"cus"=>$cus,"err"=>0));
      
    }
    public function actionDeleteHD() {
         if(Yii::app()->session['adid']) { 
            $id=Yii::app()->request->getPost('id');
      $model=$this->loadModel($id);
       $kh=Customer::model()->findByPk($model->id_customer);
       //Thông báo từ hệ thống khi người dùng khi tạo hợp đồng mới
            $message='<h2>Thông Báo từ Hệ Thống Website của Passion Investment</h2>';
            $message.='<p>Quản trị viên vừa xóa hợp đồng số '.$model->number_form.' của bạn.</p>';
            $message.='<p>Đăng nhập link dưới đây  để biết thêm chi tiết</p>';
            $message.='<a href="http://members.pif.vn/">http://members.pif.vn/</a>';
             // chữ kí số
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
           if($id) {
              if($this->loadModel($id)->delete()) {
                   //   $this-> mailsend($kh->email, 'Xóa hợp đồng trên Passion Investment '.date('d-m-Y H:i:s'), $message.$sig);//gửi đến người dùng 
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
  Truy vấn cơ sử dữ liệu By Mã
  */
    public function actiongetByMa(){
        if(Yii::app()->session['adid']) { 
             $ma=Yii::app()->request->getPost('ma');
             $data=Contract::getByMa($ma);
             $i=0;
            $message="Không tìm thấy dữ liệu nào";
            foreach($data as $item){
                $message.='<tr class="'.$this->CheckColor($item['status']).'">
                            <td>'.$i++.'</td>
                            <td>'. Contract::ViewDate($item['date_created']).'</td>
                            <td>'.$item['number_form'] .'</td>
                            <td>'.Formcontract::model()->findbyPK($item['id_form'])->name.'</td>
                            <td>'.$this->GetFullName($item['id_customer']).'</td>
                            <td>'.$this->GetEmail($item['id_customer']).'</td>
                            <td>'.$this->GetTele($item['id_customer']).'</td>
                            <td>'.$this->CheckStatus($item['status'],$item['id']).'</td>
                            <td>
                               <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Views/id/'.$item['id'].'" >Xem</a> |
                                <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Edits/id/'.$item['id'].'" >Sửa</a> |
                                <a style="cursor: pointer;text-decoration: underline;" onclick="DelHD('. $item['id'].')" >Xóa</a>
                            </td> 
                         </tr>';

            } 
            echo $message; 
        }else {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));       
        }
    }
  /**
  Tìm kiếm hợp đồng theo khách hàng
  */
    public function actiongetByID(){
        if(Yii::app()->session['adid']) { 
             $id=Yii::app()->request->getPost('id');
             $data=Contract::getByIDKH($id[0]);
             $i=0;
            $message="Không tìm thấy dữ liệu nào";
            foreach($data as $item){
                $message.='<tr class="'.$this->CheckColor($item['status']).'">
                            <td>'.$i++.'</td>
                            <td>'. Contract::ViewDate($item['date_created']).'</td>
                            <td>'.$item['number_form'] .'</td>
                            <td>'.Formcontract::model()->findbyPK($item['id_form'])->name.'</td>
                            <td>'.$this->GetFullName($item['id_customer']).'</td>
                            <td>'.$this->GetEmail($item['id_customer']).'</td>
                            <td>'.$this->GetTele($item['id_customer']).'</td>
                            <td>'.$this->CheckStatus($item['status'],$item['id']).'</td>
                            <td>
                               <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Review/id/'.$item['id'].'" >Xem</a> |
                                <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Edits/id/'.$item['id'].'" >Sửa</a> |
                                <a style="cursor: pointer;text-decoration: underline;" onclick="DelHD('. $item['id'].')" >Xóa</a>
                            </td> 
                         </tr>';

            } 
            echo $message; 
        }else {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));       
        }
    }
  /**
  Tìm kiếm hợp đồng theo trạng thái hợp đồng
  */
    public function actiongetByStatus() {
         if(Yii::app()->session['adid']) { 
            $status=Yii::app()->request->getPost('status');
            $data=Contract::getByStatus($status);
            if($status==0){
                $data=Contract::adGetAllContract();
            }
            $i=0;
            $message="Không tìm thấy dữ liệu nào";
            foreach($data as $item){
                $message.='<tr class="'.$this->CheckColor($item['status']).'">
                            <td>'.$i++.'</td>
                            <td>'. Contract::ViewDate($item['date_created']).'</td>
                            <td>'.$item['number_form'] .'</td>
                            <td>'.Formcontract::model()->findbyPK($item['id_form'])->name.'</td>
                            <td>'.$this->GetFullName($item['id_customer']).'</td>
                            <td>'.$this->GetEmail($item['id_customer']).'</td>
                            <td>'.$this->GetTele($item['id_customer']).'</td>
                            <td>'.$this->CheckStatus($item['status'],$item['id']).'</td>
                            <td>
                               <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Views/id/'.$item['id'].'" >Xem</a> |
                                <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Edits/id/'.$item['id'].'" >Sửa</a> |
                                <a style="cursor: pointer;text-decoration: underline;" onclick="DelHD('. $item['id'].')" >Xóa</a>
                            </td> 
                         </tr>';

            } 
            echo $message; 
         }else {
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));      
        // header('Content-type: application/json');
          //           echo CJSON::encode("Err");
            //        Yii::app()->end(); 
       }
    }
  /**
  Lấy được tên khách hàng
  */
public function GetFullName($id){
    $ks=Customer::model()->findbyPK($id);
    return $ks['fullname'];
}
/**
Lấy được Email khách hàng
*/
public function GetEmail($id){
    $ks=Customer::model()->findbyPK($id);
    return $ks['email'];
}
/**
Lấy được số điện thoại khách hàng
*/
public function GetTele($id){
    $ks=Customer::model()->findbyPK($id);
    return $ks['telephone'];
}   
/**
Lấy được hợp đồng theo hình thức hợp đồng
*/
public function actiongetByLoai() {
    if(Yii::app()->session['adid']) { 
            $id=Yii::app()->request->getPost('id');
            $data=Contract::getByTT($id);
             if($id==0){
                $data=Contract::adGetAllContract();
            }
            $i=0;
            $message="Không có trường dữ liệu nào";
            foreach($data as $item){
                $message.='<tr class="'.$this->CheckColor($item['status']).'">
                            <td>'.$i++.'</td>
                            <td>'. Contract::ViewDate($item['date_created']).'</td>
                            <td>'.$item['number_form'] .'</td>
                            <td>'.Formcontract::model()->findbyPK($item['id_form'])->name.'</td>
                            <td>'.$this->GetFullName($item['id_customer']).'</td>
                            <td>'.$this->GetEmail($item['id_customer']).'</td>
                            <td>'.$this->GetTele($item['id_customer']).'</td>
                            <td>'.$this->CheckStatus($item['status'],$item['id']).'</td>
                            <td>
                               <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Views/id/'.$item['id'].'" >Xem</a> |
                                <a style="cursor: pointer;text-decoration: underline;" href="'.Yii::app()->request->baseUrl.'/piadmin/Contract/Edits/id/'.$item['id'].'" >Sửa</a> |
                                <a style="cursor: pointer;text-decoration: underline;" onclick="DelHD('. $item['id'].')" >Xóa</a>
                            </td> 
                         </tr>';

            } 
            echo $message; 
         }else {
         Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));      
        // header('Content-type: application/json');
          //           echo CJSON::encode("Err");
            //        Yii::app()->end(); 
       }
}
   static function CheckStatus($status,$id) {
       if($status==1) {
         return '<a style="cursor: pointer;text-decoration: underline;" onclick="updateHD('.$id.','.$status.')" >Chờ chốt số</a>';
       }
        if($status==2) {
         return '<a style="cursor: pointer;text-decoration: underline;" onclick="updateHD('.$id.','.$status.')" >Đang hiệu lực</a>';
       }
        if($status==3) {
         return '<a style="cursor: pointer;text-decoration: underline;" onclick="updateHD('.$id.','.$status.')" >Đã tất toán</a>';
       }
   }
   static function CheckColor($status){
    if($status==1){
       return 'danger';
    }
    if($status==2){
        return 'info';
    }
    if($status==3){
       return 'success';
    }

   }
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
     /**
     Hàm update lại hợp đồng sau khi đã chốt tiền / được lưu vào cơ sở dữ liệu
    */
      static function GenHDUpdate ($vonHD,$content,$date){ 
          $Ts=date("Y-m-d",strtotime("$date - 1 day"));
          $iv= Investment::model()->findByAttributes(array("date"=>$Ts));
          if($vonHD){
           $contents=str_replace("hd_update_money",$vonHD,$content);
           $contents=str_replace("hds_updates_moneys_text",Lib::VndText(round($vonHD,0))."đồng chẵn",$contents);
       }
       if($iv !=null && $vonHD!=null){
          if($iv->motdvdt!=0) {
             $dv=(double)$vonHD/(double)($iv->motdvdt);
              $contents=str_replace("hd_update_convertdvdt",round($dv,0),$contents);
             $contents=str_replace("hds_updates_convertdvdts_text",Lib::VndText(round($dv,0))."đơn vị đầu tư",$contents);
          }
          
        
       }
           return $content;
      }
     static function mailsend($to,$subject,$message){
        $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->From="tuvan@pif.vn";
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo('tuvan@pif.vn',"Passion Investment");
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
    static function mailsendFile($to,$subject,$message,$content,$filename){
        $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->From="tuvan@pif.vn";
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo('tuvan@pif.vn',"Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
         $mail->AddCC("baocao@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->AddCC($email, "Passion Investment");
        $mail->IsHTML(true);  
        $mail->AddStringAttachment($content,$filename);
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
         $mail->ClearAllRecipients( ); // clear all
    }
     //update 17/08/2016 by hoàng trung
     static function mailsendBy($to,$subject,$message,$email){
        $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->From=$email;
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo($email,"Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        $mail->AddCC("baocao@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->AddCC($email, "Passion Investment");
        $mail->IsHTML(true);  
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
        $mail->ClearAllRecipients( ); // clear all
    }
     static function mailsendTest($to,$subject,$message,$username,$password){
        $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->From=$username;
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo($username,"Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        $mail->AddCC("baocao@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->AddCC($username, "Passion Investment");
       // $mail->AddStringAttachment($content,$filename);
        $mail->IsHTML(true);  
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
        $mail->ClearAllRecipients( ); // clear all
    }
    static function mailsendFileBy($to,$subject,$message,$content,$filename,$email){
        $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->From=$email;
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo($email,"Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        $mail->AddCC("baocao@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->AddCC($email, "Passion Investment");
        $mail->IsHTML(true);  
        $mail->AddStringAttachment($content,$filename);
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
        $mail->ClearAllRecipients( ); // clear all
    }
    static function mailsendFileByS($to,$subject,$message,$content,$filename,$username,$password){
        $mail=Yii::app()->Smtpmail;
       // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Mailer = "smtp";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->From=$username;
        $mail->FromName = "Passion Investment";
        $mail->AddReplyTo($username,"Passion Investment");
        $mail->CharSet = "UTF-8";
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        $mail->AddCC("baocao@pif.vn", "Passion Investment");
        $mail->AddCC("admin@pif.vn", "Passion Investment");
        $mail->AddCC($username, "Passion Investment");
        $mail->IsHTML(true);  
        $mail->AddStringAttachment($content,$filename);
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
        $mail->ClearAllRecipients( ); // clear all
    }

    // Nội dung biên bản tất toán - TL
    public function contentFileCompleted($id){
        date_default_timezone_set("Asia/Bangkok");
        $today = time();
        $contract=Contract::model()->findByPk($id);
        $cus = Customer::model()->findByPk($contract->id_customer);
        $iv = Investment::model()->findByAttributes(array("date" => date('Y-m-d',strtotime($contract->date_modified)-24*3600)));
        if(!$iv) return 'Chưa có giá trị ĐVĐT ngày '.date('d/m/Y', strtotime($contract->date_modified)-24*3600);
        $ivToday = Investment::model()->findByAttributes(array("date" => date('Y-m-d', $today-24*3600)));
        if(!$ivToday) return 'Chưa có giá trị ĐVĐT ngày '.date('d/m/Y', $today-24*3600);

        $ngayky         = date('d/m/Y', strtotime($contract->date_modified));
        $ngayketthuc    = date('d/m/Y', $today);
        $homnay         = date('d/m/Y', $today);
        $homqua         = date('d/m/Y', $today-24*3600);
        $soHD           = $contract->number_form;
        $von            = $contract->investment;
        $sodvdt         = round($von / $iv->motdvdt);
        $loaihinh       = $contract->id_form;
        $songayhoptac   = (int)(($today - strtotime($contract->date_modified))/(24*3600));
        $tysuatcoso     = ($songayhoptac/365)*0.06;
        $doanhthucoso   = $von * $tysuatcoso;
        $tonggiatri     = $ivToday->motdvdt*$sodvdt;
        $tysuatdoanhthu = ($tonggiatri-$von)/$von;
        $doanhthuthucte = $tonggiatri - $von;
        $kyhan          = 356;
        $phanbulo       = 0;

        //Nếu Chia sẻ lợi nhuận
        if($loaihinh==3):
          $duoc       = 0.8;
          $duocT      = '80%';
          $duocB      = 0.2;
          if($tysuatdoanhthu<$tysuatcoso): 
            $tylephanchiaA = $tysuatdoanhthu; //Nếu tỷ suất KD thực tế < tỷ suất DT cơ sở  thì Bên A nhận được tỷ suất KD thực tế
            $tylephanchiaB = 0; //Nếu tỷ suất KD thực tế < tỷ suất DT cơ sở  thì Bên B nhận được 0%
          else :
            $tylephanchiaA = $tysuatcoso + ($tysuatdoanhthu-$tysuatcoso)*$duoc; //Nếu tỷ suất KD thực tế > tỷ suất DT cơ sở thì bên A nhận được tỷ suất doanh thu cơ sở và 80% phần vượt tỷ suất doanh thu cơ sở
            $tylephanchiaB = ($tysuatdoanhthu-$tysuatcoso)*(1 - $duoc); //Nếu tỷ suất KD thực tế > tỷ suất DT cơ sở  thì Bên B nhận được 20% phần vượt tỷ suất doanh thu cơ sở
          endif;
        // Nếu cam kết lợi nhuận tối thiểu
        elseif($loaihinh==4):
          $duoc       = 0.5;
          $duocT      = '50%';
          $duocB      = 0.5;
          //Nếu rút trước hạn
          if($songayhoptac<$kyhan): 
            if($tysuatdoanhthu<$tysuatcoso):
              $tylephanchiaA = $tysuatdoanhthu; //= tỷ lệ doanh thu kd nếu nó nhỏ hơn tỷ lệ cơ sở; 
              $tylephanchiaB = 0; //0% nếu tỷ lệ dtkd thực nhỏ hơn tỷ lệ cơ sở;
            else:
              $tylephanchiaA = $tysuatcoso + ($tysuatdoanhthu-$tysuatcoso)*$duoc; //= tỷ lệ cơ sở + 50% phần vượt nếu nó lớn hơn tỷ lệ cơ sở
              $tylephanchiaB = ($tysuatdoanhthu-$tysuatcoso)*(1 - $duoc); //= 50% phần vượt nếu tỷ lệ dtkd thực lớn hơn tỷ lệ cơ ở
            endif;
          //Nếu rút đúng hạn
          else:
            if($tysuatdoanhthu<$tysuatcoso):
              $tylephanchiaA = $tysuatcoso; //= 6% nếu nó nhỏ hơn tỷ lệ cơ sở 
              $tylephanchiaB = $tysuatdoanhthu-$tysuatcoso; // = phần bù ra nếu tỷ lệ dtkd thực nhỏ hơn 6%
              $tylebulo      = $tysuatcoso-$tysuatdoanhthu;
              $phanbulo      = $tylebulo * $von;
            else:
              $tylephanchiaA = $tysuatcoso + ($tysuatdoanhthu-$tysuatcoso)*$duoc; //= tỷ lệ cơ sở + 50% phần vượt nếu nó lớn hơn tỷ lệ cơ sở
              $tylephanchiaB = ($tysuatdoanhthu-$tysuatcoso)*(1 - $duoc);//= 50% phần vượt nếu lớn hơn tỷ lệ cơ sở
            endif;
          endif;
        endif;
        $doanhthukdA = $tylephanchiaA * $von;
        $doanhthukdB = $tylephanchiaB * $von;
        $phiphat        = 0;
        $phiphatT       = '0%';
        if($songayhoptac<=90): $phiphat = 0.04; $phiphatT = '4%';
        elseif($songayhoptac<=180): $phiphat = 0.03; $phiphatT = '3%';
        elseif($songayhoptac<=270): $phiphat = 0.02; $phiphatT = '2%';
        elseif($songayhoptac<=360): $phiphat = 0.01; $phiphatT = '1%';
        endif;
        $tienphat       = round($phiphat * $von);
        $doanhthuB      = 0;
        if($doanhthuthucte - $doanhthucoso > 0) 
            $doanhthuB  = round($tylephanchiaB*$von);
        $tongtienB      = $doanhthuB + $tienphat - $phanbulo;
        if($phanbulo>0) $doanhthuA = $doanhthucoso;
        else $doanhthuA = $doanhthuthucte - $tongtienB;
        $doanhthuthucteA = $tylephanchiaA*$von;
        $tienthue       = 0;
        if($doanhthuA>0) $tienthue = $doanhthuA*0.05;
        $doanhthuAsauthue = $doanhthuA - $tienthue;
        $tongtienA      = $doanhthuAsauthue + $von;

        $content = '<p align="center" style="font-size: 13pt"><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
<p align="center" style="font-size: 13pt"><strong>Độc lập - Tự do - Hạnh phúc</strong></p>
<p align="center">------------</p>
<p align="center">&nbsp;</p>
<p align="center" style="font-size: 13pt"><strong>BIÊN BẢN THANH LÝ HỢP ĐỒNG</strong></p>
<p align="center"><i>(Hợp đồng hợp tác kinh doanh số: '.$soHD.' ký ngày '.$ngayky.')</i></p>
<p>Căn cứ vào hợp đồng số '.$soHD.' ký ngày '.$ngayky.' giữa '.$cus->fullname.' và Công ty Cổ phần Passion Investment.</p>
<p>Hôm nay, ngày '.$homnay.' tại văn phòng Công ty Cổ phần Passion Investment, chúng tôi gồm:</p>
<p><b>BÊN A: <span style="text-transform: uppercase;">'.$cus->fullname.'</span></b></p>
<table class="table" style=" width: 100%;" border="0">
<tbody>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">CMND số: '.$cus->cmt.'</td>
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Cấp ngày: '.Investment::ViewDate($cus->cmt_datecreate).'</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Nơi cấp: '.$cus->cmt_addresscreate.'</td>
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">MST cá nhân: '.$cus->mst.'</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Điện thoại: '.$cus->telephone.'</td>
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Email: '.$cus->email.'</td>
</tr>
<tr>
<td style=" margin-bottom: 0pt;" colspan="2">
Thông tin về tài khoản của Bên A:
</td>
</tr>
<tr>
<td colspan="2">Chủ tài khoản: '.$cus->bankacount.'</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Số tài khoản: '.$cus->numberbank.'</td>
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Ngân hàng: '.$cus->namebank.' - CN '.$cus->chinhanh.'</td>
</tr>
</tbody>
</table>
<p style=" margin-top: 15px"><b>BÊN B: CÔNG TY CỔ PHẦN PASSION INVESTMENT</b></p>
<table class="table" style=" width: 100%;">
<tbody>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Giấy ĐKKD số: 0107025159</td>
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Cấp ngày: 12/10/2015</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">MST: 0107025159</td>
<td style=" width: 50%;"></td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Đại diện: Ông Lã Giang Trung</td>
<td style=" width: 50%; border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;">Chức vụ: Tổng giám đốc</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style="border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;" colspan="2">Địa chỉ: Phòng 502B, Tầng 5, tòa nhà Rainbow, đường 19/5, khu đô thị Văn Quán, phường Văn Quán, quận Hà Đông, thành phố Hà Nội.</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style="border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;" colspan="2">Điện thoại: 04 3264 6480</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style="border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;" colspan="2">Tài khoản : 0711000253612</td>
</tr>
<tr style=" margin-bottom: 0pt;">
<td style="border-top: none !important; padding: 2px; line-height: 1.42857143; vertical-align: top; padding-left: 0px;" colspan="2">Ngân hàng: VCB – CN Thanh Xuân</td>
</tr>
</tbody>
</table>
<p style="margin-top: 12px;">Cùng thỏa thuận ký kết Biên bản thanh lý Hợp đồng hợp tác kinh doanh số: '.$soHD.' với những điều khoản cụ thể sau:</p>
<p><strong>ĐIỀU 1: KẾT QUẢ THỰC HIỆN HỢP ĐỒNG:</strong></p>
<p><b>1.1.</b> Theo hợp đồng Hợp tác kinh doanh số '.$soHD.' ký ngày '.$ngayky.' có những thông tin như sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Giá trị tài sản ròng của một đơn vị đầu tư tại ngày ký hợp đồng: '.$this->formatCurrency($iv->motdvdt).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Vốn đầu tư: '.$this->formatCurrency($von).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Số lượng ĐVĐT quy đổi: '.$this->formatCurrency(($sodvdt)).' ĐVĐT</p>
<p><b>1.2.</b> Tại ngày '.$homqua.' thời điểm hai bên chốt giá trị tất toán hợp đồng, Tài khoản hợp tác kinh doanh có những thông tin sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng giá trị tài sản ròng của Tài khoản kinh doanh: '.$this->formatCurrency($ivToday->tongtkkinhdoanh).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng số lượng ĐVĐT hiện có trên Tài khoản kinh doanh: '.$this->formatCurrency($ivToday->tongdvdt).' ĐVĐT</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Giá trị tài sản ròng của một Đơn vị đầu tư: '.$this->formatCurrency($ivToday->motdvdt).' đồng (đây cũng là giá trị tài sản ròng được xác định để tính Doanh thu kinh doanh)</p>
<p>Như vậy, từ việc Hợp tác kinh doanh, BÊN B đã đạt được kết quả:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng tiền thu về (bao gồm cả gốc và lãi): '.$this->formatCurrency(($tonggiatri)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tỷ suất doanh thu kinh doanh: '.$this->formatPersen($tysuatdoanhthu).'</p>
<p><strong>ĐIỀU 2: PHÂN CHIA DOANH THU KINH DOANH VÀ PHƯƠNG THỨC THANH TOÁN:</strong></p>
<p><b>2.1.</b> Căn cứ theo Hợp đồng hợp tác kinh doanh số '.$soHD.' và điều 1 hợp đồng này, Doanh thu kinh doanh được tính cụ thể ở bảng dưới đây:</p>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt; text-align: center; font-size: 10pt">
    <tr>
        <td style="font-size: 10pt; font-weight: bold">Vốn hợp tác (1)</td>
        <td style="font-size: 10pt; font-weight: bold">Ngày bắt đầu</td>
        <td style="font-size: 10pt; font-weight: bold">Ngày kết thúc</td>
        <td style="font-size: 10pt; font-weight: bold">Số ngày hợp tác</td>
        <td style="font-size: 10pt; font-weight: bold">Tỷ suất doanh thu kinh doanh cơ sở (2)</td>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu kinh doanh cơ sở (3)=(1)*(2)</td>
        <td style="font-size: 10pt; font-weight: bold">Tổng giá trị khi kết thúc hợp đồng (4)</td>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu kinh doanh thực tế (5)=(4)-(1)</td>
    </tr>
    <tr>
       <td style="font-size: 10pt; height:39.35pt">'.$this->formatCurrency(($von)).'</td>
        <td style="font-size: 10pt">'.$ngayky.'</td>
        <td style="font-size: 10pt">'.$ngayketthuc.'</td>
        <td style="font-size: 10pt">'.$songayhoptac.'</td>
        <td style="font-size: 10pt">'.$this->formatPersen($tysuatcoso).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency($doanhthucoso).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tonggiatri)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency($doanhthuthucte).'</td>
    </tr>
</table>
<p>&nbsp;</p>
<p><b>2.2.</b> Căn cứ vào Hợp đồng hợp tác kinh doanh số '.$soHD.', Doanh thu kinh doanh thực tế thu về được phân chia cho hai bên cụ thể như sau:</p>';
if($doanhthuthucte - $doanhthucoso > 0)
$content .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;- Doanh thu kinh doanh BÊN A thu về (6) là:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;'.$this->formatCurrency($doanhthucoso).' + '.'('.$this->formatCurrency($doanhthuthucte).' - '.$this->formatCurrency($doanhthucoso).') * '.$this->formatPersen($duoc).' = '.$this->formatCurrency($doanhthukdA).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Doanh thu kinh doanh BÊN B thu về (13) là:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;('.$this->formatCurrency($doanhthuthucte).' - '.$this->formatCurrency($doanhthucoso).') * '.$this->formatPersen($duocB).' = '.$this->formatCurrency($doanhthukdB).' đồng</p>';
else
$content .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;- Doanh thu kinh doanh BÊN A thu về (6) là: '.$this->formatCurrency($doanhthuthucte).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Doanh thu kinh doanh BÊN B thu về (13) là: 0 đồng</p>';
//Nếu hợp đồng Chia sẻ
if($loaihinh==3):
$content .= '<p><b>2.3.</b> Doanh thu kinh doanh hai bên thu về được tính cụ thể như sau:</p>
<p>Doanh thu kinh doanh BÊN A thu về</p>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt; text-align: center; ">
    <tr>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu kinh doanh BÊN A thu về trước khi trừ phí phạt (6)</td>
        <td style="font-size: 10pt; font-weight: bold">Phí phạt rút trước hạn (7)</td>
        <td style="font-size: 10pt; font-weight: bold">Tiền phí phạt rút trước hạn (8)=(1)*(7)</td>';
$content .= '<td style="font-size: 10pt; font-weight: bold">Doanh thu kinh doanh BÊN A tính thuế TNCN (9)=(6)-(8)</td>
        <td style="font-size: 10pt; font-weight: bold">Thuế TNCN BÊN A phải nộp cho nhà nước (10)=(9)*5%</td>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu BÊN A thu về sau khi trừ phí và thuế TNCN<br />(11)=(9)-(10)</td>
        <td style="font-size: 10pt; font-weight: bold">Tổng BÊN A thu về (gốc + lãi)<br />(12)=(1)+(11)</td>
    </tr>
    <tr>
        <td style="font-size: 10pt; height:39.35pt">'.$this->formatCurrency(($doanhthukdA)).'</td>
        <td style="font-size: 10pt">'.$phiphatT.'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tienphat)).'</td>';   
$content .= '<td style="font-size: 10pt">'.$this->formatCurrency(($doanhthuA)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tienthue)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($doanhthuAsauthue)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tongtienA)).'</td>
    </tr>
</table>
<p>&nbsp;</p>
<p>Doanh thu kinh doanh BÊN B thu về</p>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt; text-align: center; ">
    <tr>
        <td style="font-size: 10pt; font-weight: bold; height:39.35pt">Doanh thu kinh doanh BÊN B thu về
(13)</td>
        <td style="font-size: 10pt; font-weight: bold">Phí phạt BÊN B thu về từ BÊN A
(14)</td>
        <td style="font-size: 10pt; font-weight: bold">Tổng tiền BÊN B thu về
(15) = (13) + (14)</td>
    </tr>
    <tr>
        <td style="font-size: 10pt; height:39.35pt">'.$this->formatCurrency(($doanhthukdB)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tienphat)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tongtienB)).'</td>
    </tr>
</table>
<p>&nbsp;</p>
<p><b>2.4.</b> Số tiền hai bên thu về sẽ được thanh toán như sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng số tiền BÊN A nhận được vào tài khoản của BÊN A là: '.$this->formatCurrency(($tongtienA)).' đồng (a+b-c-d), bao gồm các khoản sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) Số tiền gốc của Bên A là '.$this->formatCurrency(($von)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) Doanh thu kinh doanh thực tế của BÊN A là '.$this->formatCurrency(($doanhthuthucteA)).' đồng</p>';
$content .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) Phí phạt rút trước hạn của BÊN A là '.$this->formatCurrency(($tienphat)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(d) Nghĩa vụ thuế phải nộp cho nhà nước của BÊN A là  '.$this->formatCurrency(($tienthue)).' đồng';
if($tienthue==0) $content .= ' (do doanh thu kinh doanh thực tế nhỏ hơn 0)';
elseif($tienthue>0) $content .= ' (5% của '.$this->formatCurrency($doanhthuA).' đồng)';
$content .= '</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng số tiền BÊN B nhận được vào tài khoản của BÊN B là: '.$this->formatCurrency(($tongtienB)).' đồng (e+f), bao gồm các khoản sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(e) Doanh thu kinh doanh thực tế BÊN B nhận về là '.$this->formatCurrency(($doanhthuB)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(f) Phí phạt rút trước hạn thu từ BÊN A là '.$this->formatCurrency(($tienphat)).' đồng</p>';
$content .= '<p>&nbsp;&nbsp;&nbsp;&nbsp;- Nghĩa vụ thuế phải nộp cho nhà nước của BÊN A là '.$this->formatCurrency(($tienthue)).' đồng sẽ được chuyển vào tài khoản của BÊN B và BÊN B có nghĩa vụ nộp lại vào ngân sách nhà nước cho BÊN A</p>';
// Nếu hợp đồng Cam kết
elseif($loaihinh==4):
  $content .= '<p><b>2.3.</b> Doanh thu kinh doanh hai bên thu về được tính cụ thể như sau:</p>
<p>Doanh thu kinh doanh BÊN A thu về</p>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt; text-align: center; ">
    <tr>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu kinh doanh BÊN A thu về trước khi trừ phí phạt (6)</td>
        <td style="font-size: 10pt; font-weight: bold">Phí phạt rút trước hạn (7)</td>
        <td style="font-size: 10pt; font-weight: bold">Tiền phí phạt rút trước hạn (8)=(1)*(7)</td>
        <td style="font-size: 10pt; font-weight: bold">Phần bù lỗ BÊN A thu về (9)</td>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu kinh doanh BÊN A tính thuế TNCN (10)=(6)-(8)+(9)</td>
        <td style="font-size: 10pt; font-weight: bold">Thuế TNCN BÊN A phải nộp cho nhà nước (11)=(10)*5%</td>
        <td style="font-size: 10pt; font-weight: bold">Doanh thu BÊN A thu về sau khi trừ phí và thuế TNCN<br />(12)=(10)-(11)</td>
        <td style="font-size: 10pt; font-weight: bold">Tổng BÊN A thu về (gốc + lãi)<br />(13)=(1)+(12)</td>
    </tr>
    <tr>
        <td style="font-size: 10pt; height:39.35pt">'.$this->formatCurrency(($doanhthukdA)).'</td>
        <td style="font-size: 10pt">'.$phiphatT.'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tienphat)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency($phanbulo).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($doanhthuA)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tienthue)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($doanhthuAsauthue)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tongtienA)).'</td>
    </tr>
</table>
<p>&nbsp;</p>
<p>Doanh thu kinh doanh BÊN B thu về</p>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt; text-align: center; ">
    <tr>
        <td style="font-size: 10pt; font-weight: bold; height:39.35pt">Doanh thu kinh doanh BÊN B thu về (14)</td>
        <td style="font-size: 10pt; font-weight: bold">Phí phạt BÊN B thu về từ BÊN A (15)</td>
        <td style="font-size: 10pt; font-weight: bold">Phần bù lỗ trả cho BÊN A (16)</td>
        <td style="font-size: 10pt; font-weight: bold">Tổng tiền BÊN B thu về (17) = (14) + (15) - (16)</td>
    </tr>
    <tr>
        <td style="font-size: 10pt; height:39.35pt">'.$this->formatCurrency(($doanhthukdB)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tienphat)).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency($phanbulo).'</td>
        <td style="font-size: 10pt">'.$this->formatCurrency(($tongtienB)).'</td>
    </tr>
</table>
<p>&nbsp;</p>
<p><b>2.4.</b> Số tiền hai bên thu về sẽ được thanh toán như sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng số tiền BÊN A nhận được vào tài khoản của BÊN A là: '.$this->formatCurrency(($tongtienA)).' đồng (a+b+c-d-e), bao gồm các khoản sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) Số tiền gốc của Bên A là '.$this->formatCurrency(($von)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) Doanh thu kinh doanh thực tế của BÊN A là '.$this->formatCurrency(($doanhthuthucteA)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) Phần bù BÊN B trả cho BÊN A là '.$this->formatCurrency(($phanbulo)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(d) Phí phạt rút trước hạn của BÊN A là '.$this->formatCurrency(($tienphat)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(e) Nghĩa vụ thuế phải nộp cho nhà nước của BÊN A là  '.$this->formatCurrency(($tienthue)).' đồng';
if($tienthue==0) $content .= ' (do doanh thu kinh doanh thực tế nhỏ hơn 0)';
elseif($tienthue>0) $content .= ' (5% của '.$this->formatCurrency($doanhthuA).' đồng)';
$content .= '</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Tổng số tiền BÊN B nhận được vào tài khoản của BÊN B là: '.$this->formatCurrency(($tongtienB)).' đồng (f+g-h), bao gồm các khoản sau:</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(f) Doanh thu kinh doanh thực tế BÊN B nhận về là '.$this->formatCurrency(($doanhthuB)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(g) Phí phạt rút trước hạn thu từ BÊN A là '.$this->formatCurrency(($tienphat)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(h) Phần bù BÊN B trả cho BÊN A là '.$this->formatCurrency(($phanbulo)).' đồng</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Nghĩa vụ thuế phải nộp cho nhà nước của BÊN A là '.$this->formatCurrency(($tienthue)).' đồng sẽ được chuyển vào tài khoản của BÊN B và BÊN B có nghĩa vụ nộp lại vào ngân sách nhà nước cho BÊN A</p>';
endif;
$content .= '<p><b>2.5.</b> Bên B sẽ trả bằng chuyển khoản cho Bên A tổng số tiền (bao gồm gốc và tổng doanh thu kinh doanh BÊN A) trong thời hạn 05 (năm) ngày kể từ ngày Biên bản thanh lý này được ký kết.</p>
<p><strong>ĐIỀU 3: VỀ VIỆC THỰC HIỆN QUYỀN HẠN VÀ TRÁCH NHIỆM CỦA HAI BÊN:</strong></p>
<p><b>3.1.</b> Trong quá trình thực hiện hợp đồng, mỗi Bên đều đã thực hiện đầy đủ và nghiêm túc trách nhiệm và quyền hạn của mình theo đúng các quy định tại Hợp đồng hợp tác kinh doanh số '.$soHD.' ký ngày '.$ngayky.'</p>
<p><b>3.2.</b> Hai Bên đã hợp tác trên tinh thần hỗ trợ lẫn nhau và không phát sinh tranh chấp hay vướng mắc nào.</p>
<p><strong>ĐIỀU 4: ĐIỀU KHOẢN CUỐI CÙNG:</strong></p>
<p><b>4.1.</b> Biên bản thanh lý này có hiệu lực từ ngày ký.</p>
<p><b>4.2.</b> Biên bản này được lập thành 02 (hai) bản có giá trị như nhau, mỗi Bên giữ 01 (một) bản.</p>
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="319">
<p align="center"><strong><center>BÊN A<center></strong></p>
</td>
<td valign="top" width="319">
<p align="center"><strong><center>BÊN B</center></strong></p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>';
    return '<html><head><style>
        body {text-align: justify; line-height:1.5;}
        body p{font-family:dejavusans; font-size:11pt; margin-bottom: 10pt; margin-top: 0;}
        body table tr td{font-family:dejavusans; font-size:11pt;}
    </style></head>
<body>' . $content . '</body></html>';
    }
    
    // Hủy dấu tiếng Việt trong 1 đoạn string - Dùng hủy dấu tiếng Việt trong tên file - TL
    static function createAlias($str){
        if(!$str) return false;
        $str = preg_replace("/ /",'-',$str);
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ',
            'D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ứ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        $str = preg_replace('/[^a-zA-Z0-9\-]/','',$str); 
        return $str;
    }

    //Xuất Biên bản Tất toán
    public function actionprintFileCompleted(){
        if(Yii::app()->session['adid']) { 
            $id=Yii::app()->request->getPost('id');// lấy được ID hợp đồng
            $contract=Contract::model()->findByPk($id);//Tìm kiếm hợp đồng theo ID
            $cus=Customer::model()->findByPk($contract->id_customer);//Tìm kiếm khách hàng theo ID khách hàng trong bản hợp đồng
            $name= 'Bien-ban-thanh-ly-hop-dong-so-'.$contract->number_form."_".$this->createAlias($cus->fullname);
            $data=array("content"=>$this->contentFileCompleted($id),"name"=>$name); 
            echo json_encode($data);
        }else {
          Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
        }     
    }

    // Gửi email Biên bản Tất toán tới khách hàng
    public function actionsendFileCompleted(){
        if(Yii::app()->session['adid']) { 
            $id=Yii::app()->request->getPost('id');// lấy được ID hợp đồng
            $contract=Contract::model()->findByPk($id);//Tìm kiếm hợp đồng theo ID
            $cus=Customer::model()->findByPk($contract->id_customer);//Tìm kiếm khách hàng theo 
            $quantri = Admin::model()->findByPk(Yii::app()->session['adid']);
            $maHD = $contract->number_form;
            $email_send = "";
            $email_pass = $quantri->pass_email;
            if ($quantri->email_send) {
                $email_send = $quantri->email_send;
            } else {
                $email_send = $quantri->email;
            }
// $mPDF1->Output();
// $content_PDF =$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING);
            
            $mesCompleted = '<p><strong>Kính gửi quý khách hàng ' . $cus->fullname . '</strong>,</p>
<p>Passion Investment xin gửi quý khách Biên bản thanh lý Hợp đồng số <strong>' . $contract->number_form . '</strong> trong tệp tin đính kèm.</p>
<p>Quý khách vui lòng kiểm tra nội dung Biên bản thanh lý và xác nhận đồng ý tất toán qua email: ' . $email_send . ' trước <strong>15h ngày ' . date("d/m/Y", time() + 7 * 3600) . '</strong> theo mẫu sau:</p>
<p>“<em>Tôi, <strong>' . $cus->fullname . '</strong> xác nhận đồng ý tất toán Hợp đồng số <strong>' . $contract->number_form . '</strong> theo biên bản thanh lý hợp đồng được gửi trong file đính kèm và không có yêu cầu gì thêm</em>”</p>
<p>Sau khi xác nhận, quý khách vui lòng in biên bản này ra thành 2 bản, ký và chuyển lại cho Passion Investment theo địa chỉ “<em>Passion Investment - Tầng 5, tòanhà Rainbow, đường 19/5, phường Văn Quán, quận Hà Đông, Hà Nội, số điện thoại: (04).32.646.480</em>”. Biên bản thanh lý sẽ được thực hiện trong vòng 05 ngày làm việc kể từ ngày Passion Investment nhận được biên bản có chữ ký của quý khách.</p>
<p>Trong trường hợp quý khách không xác nhận trước <strong>15h ngày ' . date("d/m/Y", time() + 7 * 3600) . '</strong>, Biên bản thanh lý này sẽ không có hiệu lực. Nếu quý khách vẫn muốn tiếp tục tất toán, vui lòng liên hệ nhân viên chăm sóc khách hàng của Passion Invesment để được hỗ trợ.</p>
<p>Trân trọng!</p>';
            $sig = '<p>&nbsp;</p>';
            $sig .= '<p>&nbsp;</p>';
            $sig .= '<p>&nbsp;</p>';
            $sig .= '<p>&nbsp;</p>';
            $sig .= '<img src="http://members.pif.vn/templates/images/logo.png">';
            $sig .= '<p><span style="color:#179046">Hoang Nga(Ms.)</span> / Financial Advisor</p>';
            $sig .= '<p>E: <a href="mailto:tuvan@pif.vn">tuvan@pif.vn</a> / M: (84) 972 936 023</p>';
            $sig .= '<p><hr style="border-bottom: 1px dotted #179046;width:240px;margin-left: 0px;"/></p>';
            $sig .= '<p><span style="color:#179046">Passion Investment</span></p>';
            $sig .= '<p>Room 502B, 5 th  Floor, Rainbow Building</p>';
            $sig .= '<p>19/5 Street, Van Quan, Ha Dong, Ha Noi</p>';
            $sig .= '<p>T: (84) 4 3264 6480</p>';
            $sig .= '<p>W: <a href="http://pif.vn/">http://pif.vn/</a> / F: <a href="https://www.facebook.com/pif.vn">Passion Investment</a></p>';
            $sig . '<p>Skype: <a href="hoangnga3119">hoangnga3119</a></p>';
            $mPDFCompleted = Yii::app()->ePdf->mpdf('', 'A4', '11pt', 25, 35, 25, 25, 10, 10, 'P', 'UTF-8');
            $filenameCompleted = 'Bien-ban-thanh-ly-hop-dong-so-' . $this->createAlias($maHD) . '_' . $this->createAlias($cus->fullname) . '.pdf';
            $contentPDFCompleted = '<html><head><style>
                    body {font-family:dejavusans;}
                    p{font-family:dejavusansn;font-size:11pt;}

                </style></head>
            <body>' . $this->contentFileCompleted($id) . '</body>
            </html>';
            $mPDFCompleted->SetFont('dejavusans');
            $mPDFCompleted->WriteHTML($contentPDFCompleted);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
//Gửi biên bản tất toán đến Khách hàng - Thế Lê 15/11/2016
                    $this->mailsendFileByS($cus->email, 'Passion Investment – Biên bản thanh lý Hợp đồng số ' . $maHD, $mesCompleted . $sig, $mPDFCompleted->Output('', EYiiPdf::OUTPUT_TO_STRING), $filenameCompleted, $email_send, $email_pass);//gửi đến người dùng
                    if ($cuss->email_secondary) {
                        $this->mailsendFileByS($cus->email_secondary, 'Passion Investment – Biên bản thanh lý Hợp đồng số ' . $maHD, $mesCompleted . $sig, $mPDFCompleted->Output('', EYiiPdf::OUTPUT_TO_STRING), $filenameCompleted, $email_send, $email_pass);//gửi đến người dùng
                    }
                    if ($cuss->email_third) {
                        $this->mailsendFileByS($cus->email_third, 'Passion Investment – Biên bản thanh lý Hợp đồng số ' . $maHD, $mesCompleted . $sig, $mPDFCompleted->Output('', EYiiPdf::OUTPUT_TO_STRING), $filenameCompleted, $email_send, $email_pass);//gửi đến người dùng
                    }
            echo 'Biên bản tất toán đã được gửi tới khách hàng '.$cus->fullname.' thành công.';
        }else {
          Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
        }     
    }

    /**
    Lấy danh sách các Hợp đồng sắp hết hạn
    */
    public function actionExpiration()
    {
       if(Yii::app()->session['adid']) {
          $form=Formcontract::getAllForm('id,name');//Lấy dữ liệu về loại hợp đồng
           if(isset($_POST['filters'])){
             $value=$_POST['filters'];
             $param = Yii::app()->request->getParam('page');
             $page = (isset($param) ? $param - 1 : 0);
             $count = Contract::getTotalNumberRow();
             $pages = new CPagination($count);
             $apage = Yii::app()->params['pager']; 
             $pages->setPageSize($apage);
             $data = Contract::getLimitContractBy($value,$page, $apage); 
             $this->render('index',array('form'=>$form,"sus"=>0,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
          }
           //Xử lý limit
           $param = Yii::app()->request->getParam('page');//Lấy tham số page _GET
           $page = (isset($param) ? $param - 1 : 0);// Tính ra số page
           $count = Contract::getTotalNumberExpiration();//Tính tổng được số hợp đồng
           $pages = new CPagination($count); //Thông qua hàm phân trang của Yii 
           $apage = Yii::app()->params['pager']; //Số hợp đồng trên 1 trang /Cấu hình ở main.php
           $pages->setPageSize($apage);//Tính ra được số page
           $data = Contract::getAllContractExpiration(); //Sau đó lấy dữ liệu theo phân trang 
           $this->render('expiration',array('form'=>$form,"sus"=>0,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
       }else {
           Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));        
          //  header('Content-type: application/json');
            //         echo CJSON::encode("Err");
              //      Yii::app()->end(); 
       }    
        
    }
    // Định dạng số tiền
    static function formatCurrency($number){
        return number_format($number, 0, ',', '.');
    }
    // Định dạng số
    static function formatNumber($number, $decimals){
        return number_format($number, $decimals, ',', '.');
    }
    // Định dạng phần trăm
    static function formatPersen($number){
      $number *= 10000;
      if($number % 10 == 0) {
        $number = $number/10;
        if($number % 10 == 0) {
          return number_format($number/10, 0, ',', '.').'%';
        } 
        return number_format($number/10, 1, ',', '.').'%';
      }
      return number_format($number/100, 2, ',', '.').'%';
    }

}