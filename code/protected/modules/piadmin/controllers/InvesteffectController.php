<?php
//update 27/08/2016
class InvesteffectController extends Controller
{
    public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
    /**
    Mặc định được gọi khi gọi đến controller
    */
    public function actionIndex()
    {
         if(Yii::app()->session['adid']) {
                $param = Yii::app()->request->getParam('page');
                $page = (isset($param) ? $param - 1 : 0);
                $count = Investeffects::getTotalNumberRow();
                $pages = new CPagination($count);
                $apage = Yii::app()->params['pager'];
                $pages->setPageSize($apage);
                $data = Investeffects::getLimitInvesteffects($page, $apage);    
            $this->render('index',array('sus'=>2,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));

         }
    }

    /**
    Tạo mới hiệu quả đầu tư
    Render đến view create.php
    */
    public function actionCreated(){
        if(Yii::app()->session['adid']) { 
             $this->render('create');
        }else {
            header('Content-type: application/json');
                     echo CJSON::encode("You don't permission");
                    Yii::app()->end(); 
        }
    }
    /**
    Lưu lại Hiệ quả đầu từ vào cơ sở dữ liệu
    */
    public function actionSaveAD(){
          if(Yii::app()->session['adid']) { 
              $path = Yii::getPathOfAlias('webroot').'/uploads/';
              if(isset($_POST)) { //nếu post mới thực hiện lấy dữ liệu và lưu vào csdl
                 $date=$_POST['iv_date'];
                 $iv_onedvdt=$_POST['iv_onedvdt'];
                 $iv_onedvdt=str_replace('.', '', $iv_onedvdt);
                 date_default_timezone_set('Asia/Ho_Chi_Minh');
                 $iv= Investeffects::model()->findAllByAttributes(array("date"=>Investment::SaveDate($date)));//kiểm tra xem ngày đã tồn tại trong csdl chưa
                    if($iv==null){ // Nếu ngày chưa tồn tại mới tiếp tục lưu trong csdl 
                        $model=new Investeffects; // Tạo mới đối tượng Investment
                        $model->date=Investment::SaveDate($date); //Lưu lại date với định danh y-m-d
                        $model->motdvdt=$iv_onedvdt;
                        // xử lý file thứ nhất
                        $file="";
                         if ($_FILES['file']['name'] != NULL) {
                                if ($_FILES['file']['size'] > 10048576) {
                                    echo "File khong dc lon hon 10Mb";
                                } else {
                                    //rand(0,9999).time().
                                    $tmp_name = $_FILES['file']['tmp_name'];
                                    $name_file =$_FILES['file']['name'];
                                    move_uploaded_file($tmp_name, $path . $name_file);
                                    $file=Yii::app()->getBaseUrl().'/uploads/'.$name_file;
                                }
                           
                            } else {
                              //  echo $phpFileUploadErrors[$_FILES['file']['error']];  
                            }
                         $model->file=$file;  
                         // Xử lý file thứ 2
                         // $fileone="";
                         // if ($_FILES['fileone']['name'] != NULL) {
                         //        if ($_FILES['fileone']['size'] > 10048576) {
                         //            echo "File khong dc lon hon 10Mb";
                         //        } else {
                         //            $tmp_name = $_FILES['fileone']['tmp_name'];
                         //            $name_file =rand(0,9999).time().$_FILES['fileone']['name'];
                         //            move_uploaded_file($tmp_name, $path . $name_file);
                         //            $fileone=Yii::app()->getBaseUrl().'/uploads/'.$name_file;
                         //        }
                           
                         //    } else {
                         //      //  echo $phpFileUploadErrors[$_FILES['file']['error']];  
                         //    }
                         // $model->file_one=$fileone;
                         // Xử lý file thứ 3
                        // $filesc="";
                        //  if ($_FILES['filesc']['name'] != NULL) {
                        //         if ($_FILES['filesc']['size'] > 10048576) {
                        //             echo "File khong dc lon hon 10Mb";
                        //         } else {
                        //             $tmp_name = $_FILES['filesc']['tmp_name'];
                        //             $name_file =rand(0,9999).time().$_FILES['filesc']['name'];
                        //             move_uploaded_file($tmp_name, $path . $name_file);
                        //             $filesc=Yii::app()->getBaseUrl().'/uploads/'.$name_file;
                        //         }
                           
                        //     } else {
                        //       //  echo $phpFileUploadErrors[$_FILES['file']['error']];  
                        //     }
                        //  $model->file_sc=$filesc;
                         if($model->save()) { 
                            $param = Yii::app()->request->getParam('page');
                            $page = (isset($param) ? $param - 1 : 0);
                            $count = Investeffects::getTotalNumberRow();
                            $pages = new CPagination($count);
                            $apage = Yii::app()->params['pager'];
                            $pages->setPageSize($apage);
                            $data = Investeffects::getLimitInvesteffects($page, $apage);    
                            $this->render('index',array('sus'=>1,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
                         }
                    }else { //Nếu ngày đã tồn tại thì trả về trang index với thông báo
                        $param = Yii::app()->request->getParam('page');
                        $page = (isset($param) ? $param - 1 : 0);
                        $count = Investeffects::getTotalNumberRow();
                        $pages = new CPagination($count);
                        $apage = Yii::app()->params['pager'];
                        $pages->setPageSize($apage);
                        $data = Investeffects::getLimitInvesteffects($page, $apage);    
                        $this->render('index',array('sus'=>3,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
                    }
              }
          }else {
            header('Content-type: application/json');
                     echo CJSON::encode("You don't permission");
                    Yii::app()->end(); 
          }
    }
    /**
    Sửa đơn vị đầu tư->nhảy đến trang update.php
    */
    public function actionEdits($id){ 
        if(Yii::app()->session['adid']) { 
             $model=$this->loadModel($id);
             $this->render('update',array(
                   'model'=>$model,"sus"=>0
              ));
            }else {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
            }
    }
    
    public function actionEditss($id) {
        if(Yii::app()->session['adid']) { 
             $model=$this->loadModel($id);
             $fileold=$model->file;
             $path = Yii::getPathOfAlias('webroot').'/uploads/';
              if(isset($_POST['Investeffects'])) { 
                $model->attributes=$_POST['Investeffects'];
                $date=$_POST['Investeffects']['date'];
                $iv_onedvdt=$_POST['Investeffects']['motdvdt'];
                $iv_onedvdt=str_replace('.', '', $iv_onedvdt);
               // $iv= Investeffects::model()->findAllByAttributes(array("date"=>Investment::SaveDate($date)));//kiểm tra xem ngày đã tồn tại trong csdl chưa
              
                    $model->date=Investment::SaveDate($date);
                    $model->motdvdt=$iv_onedvdt;
                     // // xử lý file thứ nhất
                        $file="";
                         if ($_FILES['file']['name'] != NULL) {
                                if ($_FILES['file']['size'] > 10048576) {
                                    echo "File khong dc lon hon 10Mb";
                                } else {
                                    //rand(0,9999).time().
                                    $tmp_name = $_FILES['file']['tmp_name'];
                                    $name_file =$_FILES['file']['name'];
                                    move_uploaded_file($tmp_name, $path . $name_file);
                                    $file=Yii::app()->getBaseUrl().'/uploads/'.$name_file;

                                }
                           
                            } else {
                             $file=$fileold;
                            }
                         $model->file=$file;  
                     if($model->save()) {
                     $this->render('update',array(
                      'model'=>$model,"sus"=>1
                     ));
                 }
               
              }
        }else {
                Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
        }
    }
    /**
    /**
    Xóa
    */
    public function actionDeleteKH() {
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
    Xem báo cáo tuần trên trình duyệt
    */
    public function actionViewBC(){
         if(Yii::app()->session['adid']) {  
            $id=Yii::app()->request->getPost('id');
            // echo$id);
            if($id){
                 // Nội dung báo cáo tuần được lấy từ bảng form báo cáo tuần
                 $formbc=Forminvesteffects::getForm();
                 // Vẽ biểu đồ được ử lý qua hàm để lấy được đường dẫn ảnh biểu đồ
                 $image=$this->generateGoogleChart();// lấy được đường dẫn hiệu quả đầu tư
                 //Tạo báo cáo hiệu quả đầu tư
                 $content=$this->GenBC($formbc['content'],$id,$image);
                 $texttt=$this->GenBCView($content);
                 echo $texttt;
            }else{}
         }else {

         }
    }
    /**
    Gửi báo cáo tuần tới khách hàng
    @param @id
    */
    /**
    Gửi báo cáo tuần tới khách hàng
    @param @id
    */
    public function actionBc(){
        if(Yii::app()->session['adid']) {  
            if(isset($_POST)){
                $id=$_POST['id'];// lấy được ID của khách hàng cần gửi báo cáo tuần
                 // Nội dung báo cáo tuần được lấy từ bảng form báo cáo tuần
                 $formbc=Forminvesteffects::getForm();
                 // Vẽ biểu đồ được ử lý qua hàm để lấy được đường dẫn ảnh biểu đồ
                 $image=$this->generateGoogleChart();// lấy được đường dẫn hiệu quả đầu tư
                 //Tạo báo cáo hiệu quả đầu tư
                 $content=$this->GenBC($formbc['content'],$id,$image);
                
                 // Bắt đầu tạo file pdf
                 $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4','10pt',10,10,10,10,10,10,'P','UTF-8');
                 $mPDF1->SetFont('dejavusans');
                  $texttt= '
                <html>
                <head><style>
                body {font-family:dejavusans;}
                p{font-family:dejavusansn;}
                </style></head>
                '.$this->GenBCView($content).'
                </html>';
                 $mPDF1->WriteHTML($texttt);
               //  $mPDF1->Output();
                 // Sau đó sẽ được gửi Email đến khách hàng
                 $kh=Customer::model()->findByPk($id);//Tìm khách hàng theo ID
                 //tạo file name pdf
                 date_default_timezone_set('Asia/Ho_Chi_Minh');
                 $filename='BC'.'-'.$this->createAlias($kh->fullname).'-'.Investeffects::getMaxDate().'.pdf';
                 $dateMax=Investeffects::getMaxDate();// tìm date lớn nhất trong bảng đơn vị đầu tư
                 $mes='<p><strong>Kính gửi quý khách hàng,</strong></p>';
                 $mes.='Passion Investment xin kính gửi báo cáo hiệu quả đầu tư khoản hợp tác đầu tư của quý khách hàng giai đoạn từ 01/01/2016 đến '.Investment::ViewDate(Investeffects::getMaxDate()).' (xem thông tin chi tiết tại tệp tin đính kèm). Bao gồm:';
                 $mes.='<ol>';
                 $mes.='<li><p> Báo cáo chi tiết về khoản đầu tư của khách hàng.</p></li>';
                 $mes.='<li><p>  Báo cáo chung về tài khoản hợp tác đầu tư do VCBS cung cấp:</p></li>';
                 $mes.='<ul>';
                 $mes.='<li><p>Báo cáo thay đổi giá trị tài sản ròng;</p></li>';
                 $mes.='<li><p>Báo cáo thay đổi số lượng đơn vị đầu tư (ĐVĐT);</p></li>';
                 $mes.='<li><p>Báo cáo về việc nộp/rút vốn của nhà đầu tư.</p></li>';
                 $mes.='</ul>';
                 $mes.='</ol>';
                 $mes.='<p>Để hoàn thiện và phát triển hơn nữa các sản phẩm dịch vụ, chúng tôi rất mong nhận được những đóng góp ý kiến của quý khách hàng.</p>';
                 $mes.='<p>Xin cảm ơn và kính chào!</p>';
                 $mes.='<p>Trân trọng!</p>';
                 //Thông báo gửi tới quản trị viên
                  $ad='Email đã được gửi tới khách hàng '.$kh->fullname.' với nội dung như sau:';
                  // Gửi Email theo quản trị viên đăng nhập
                  $quantri=Admin::model()->findByPk(Yii::app()->session['adid']);
                        $email_send="";
                        $email_pass=$quantri->pass_email;
                        if($quantri->email_send){
                           $email_send=$quantri->email_send;
                        }else{
                           $email_send=$quantri->email;
                        } 
                   // Đính kèm file VCBS     
                  $dateMax=Investeffects::getMaxDate();// tìm date lớn nhất trong bảng đơn vị đầu tư
                  $maxDate=Investeffects::model()->findByAttributes(array('date'=>$dateMax));// lấy giá trị 1 đơn vị đàu tư lớn nhất      
                  $path='http://members.pif.vn/uploads/';// Đường dẫn của file
                  $fileName=substr(strrchr($maxDate->file, "/"), 1);// Lấy tên của file
                  $this->mailsendFileByS($kh->email, 'Báo cáo tuần của Passion Investment '.Investeffects::getMaxDate(), $mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                 
                  if($kh->email_secondary){
                    $this->mailsendFileByS($kh->email_secondary, 'Báo cáo tuần của Passion Investment '.Investeffects::getMaxDate(), $mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                  }
                  if($kh->email_third){
                        $this->mailsendFileByS($kh->email_third, 'Báo cáo tuần của Passion Investment '.Investeffects::getMaxDate(), $mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                  }
                  echo '1';
            }else echo '0';
        }else {
            echo '0';
        }
    }
    /**
    Gửi báo cáo tuần tới khách hàng - Mẫu gửi khách hàng tiềm năng
    @param @id
    */    
    public function actionBcOther(){
        if(Yii::app()->session['adid']) {  
            if(isset($_POST)){
                $id=$_POST['id'];// lấy được ID của khách hàng cần gửi báo cáo tuần
                 // Nội dung báo cáo tuần được lấy từ bảng form báo cáo tuần
                 $formbc=Forminvesteffects::getForm();
                 // Vẽ biểu đồ được xử lý qua hàm để lấy được đường dẫn ảnh biểu đồ
                 $image=$this->generateGoogleChart();// lấy được đường dẫn hiệu quả đầu tư
                 //Tạo báo cáo hiệu quả đầu tư
                 //$content=$this->GenBC($formbc['content'],$id,$image);
                
                 // Sau đó sẽ được gửi Email đến khách hàng
                 $kh=Customer::model()->findByPk($id);//Tìm khách hàng theo ID
                 //tạo file name pdf
                 date_default_timezone_set('Asia/Ho_Chi_Minh');
                 $dateMax=Investeffects::getMaxDate();// tìm date lớn nhất trong bảng đơn vị đầu tư
                 $mes='<p><strong>'.$kh->fullname.' thân mến,</strong></p>
<p><strong>Passion Investment</strong> hiểu rằng bạn quan tâm đến dịch vụ Hợp tác đầu tư của chúng tôi.</p>
<p>Passion Investment luôn nỗ lực không ngừng để mang lại lợi nhuận tối đa tới khách hàng. Bởi sự tồn tại và phát triển của chúng tôi phụ thuộc vào sự hài lòng mà khách hàng có được từ khoản hợp tác đầu tư của mình cùng PI.</p>
<p>Và đây là Hiệu quả đầu tư mà tuần vừa rồi PI đã đạt được.</p>
<p><img src="'.$image.'" with="800" /></p>
<p>Chi tiết tại: <a href="http://pif.vn/hieu-qua-dau-tu/">http://pif.vn/hieu-qua-dau-tu/</a><br /> --------------------------------------------<br /> Để được tư vấn đầu tư hiệu quả, vui lòng truy cập:<br /> Website:&nbsp;<a href="http://pif.vn">http://pif.vn</a>&nbsp;&nbsp; Fanpage: <a href="https://www.facebook.com/pif.vn/?ref=bookmarks">Passion Investment</a><br /> Điện thoại liên hệ: <strong>(04) 3264 6480</strong> hoặc <strong>(84) 915 849 235</strong></p>';
                  // Gửi Email theo quản trị viên đăng nhập
                  $quantri=Admin::model()->findByPk(Yii::app()->session['adid']);
                        $email_send="";
                        $email_pass=$quantri->pass_email;
                        if($quantri->email_send){
                           $email_send=$quantri->email_send;
                        }else{
                           $email_send=$quantri->email;
                        } 
                   // Đính kèm file VCBS     
                  $dateMax=Investeffects::getMaxDate();// tìm date lớn nhất trong bảng đơn vị đầu tư
                  $maxDate=Investeffects::model()->findByAttributes(array('date'=>$dateMax));// lấy giá trị 1 đơn vị đàu tư lớn nhất      
                  $path='http://members.pif.vn/uploads/';// Đường dẫn của file
                  $fileName=substr(strrchr($maxDate->file, "/"), 1);// Lấy tên của file
                  $this->mailsendFileBy($kh->email, 'Báo cáo HQĐT tuần '.Investeffects::getMaxDate().' Passion Investment. Đầu tư hôm nay – Vững chắc tương lai', $mes.$quantri->signature,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                 
                  if($kh->email_secondary){
                    $this->mailsendFileBy($kh->email_secondary, 'Báo cáo HQĐT tuần '.Investeffects::getMaxDate().' Passion Investment. Đầu tư hôm nay – Vững chắc tương lai', $mes.$quantri->signature,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                  }
                  if($kh->email_third){
                    $this->mailsendFileBy($kh->email_third, 'Báo cáo HQĐT tuần '.Investeffects::getMaxDate().' Passion Investment. Đầu tư hôm nay – Vững chắc tương lai', $mes.$quantri->signature,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                  }
                  echo '1';
            }else echo '0';
        }else {
            echo '0';
        }
    }
    /**
    Gửi báo cáo đến nhiều khách hàng cùng 1 lúc
    */
     public function actionBcAll(){
       if(Yii::app()->session['adid']) {
           if(isset($_POST['gets'])){ 
            //update 13/09/2016
             if(isset($_POST['arts'])){
                 $arts = $_POST['arts'];//Lấy mảng giá trị truyền lên
             }else {
                 $this->render('err');
             }
               
                $N = count($arts);//Count số lượng khách hàng
                $test='';
                for($i=$N-1; $i>=0; $i--){//bắt đầu vòng lặp
                      $id=$arts[$i];// lấy được ID của khách hàng cần gửi báo cáo tuần
                      $test=$test.$id;
                       // Nội dung báo cáo tuần được lấy từ bảng form báo cáo tuần
                         $formbc=Forminvesteffects::getForm();
                         // Vẽ biểu đồ được ử lý qua hàm để lấy được đường dẫn ảnh biểu đồ
                         $image=$this->generateGoogleChart();// lấy được đường dẫn hiệu quả đầu tư
                         //Tạo báo cáo hiệu quả đầu tư
                         $content=$this->GenBC($formbc['content'],$id,$image);
                        
                         // Bắt đầu tạo file pdf
                         $mPDF1 = Yii::app()->ePdf->mpdf('', 'A4','10pt',10,10,10,10,10,10,'P','UTF-8');
                         $mPDF1->SetFont('dejavusans');
                          $texttt= '
                        <html>
                        <head><style>
                        body {font-family:dejavusans;}
                        p{font-family:dejavusansn;}
                        </style></head>
                        '.$this->GenBCView($content).'
                        </html>';
                         $mPDF1->WriteHTML($texttt);
                        
                         // Sau đó sẽ được gửi Email đến khách hàng
                         $kh=Customer::model()->findByPk($id);//Tìm khách hàng theo ID
                         //tạo file name pdf
                         date_default_timezone_set('Asia/Ho_Chi_Minh');
                         $filename='BC'.'-'.$this->createAlias($kh->fullname).'-'.date('d-m-Y').'.pdf';
                         $mes='<p><strong>Kính gửi quý khách hàng,</strong></p>';
                         $mes.='Passion Investment xin kính gửi báo cáo hiệu quả đầu tư khoản hợp tác đầu tư của quý khách hàng giai đoạn từ 01/01/2016 đến '.Investment::ViewDate(Investeffects::getMaxDate()).' (xem thông tin chi tiết tại tệp tin đính kèm). Bao gồm:';
                         $mes.='<ol>';
                         $mes.='<li><p> Báo cáo chi tiết về khoản đầu tư của khách hàng.</p></li>';
                         $mes.='<li><p>  Báo cáo chung về tài khoản hợp tác đầu tư do VCBS cung cấp:</p></li>';
                         $mes.='<ul>';
                         $mes.='<li><p>Báo cáo thay đổi giá trị tài sản ròng;</p></li>';
                         $mes.='<li><p>Báo cáo thay đổi số lượng đơn vị đầu tư (ĐVĐT);</p></li>';
                         $mes.='<li><p>Báo cáo về việc nộp/rút vốn của nhà đầu tư.</p></li>';
                         $mes.='</ul>';
                         $mes.='</ol>';
                         $mes.='<p>Để hoàn thiện và phát triển hơn nữa các sản phẩm dịch vụ, chúng tôi rất mong nhận được những đóng góp ý kiến của quý khách hàng.</p>';
                         $mes.='<p>Xin cảm ơn và kính chào!</p>';
                         $mes.='<p>Trân trọng!</p>';
                         //Thông báo gửi tới quản trị viên
                          $ad='Email đã được gửi tới khách hàng '.$kh->fullname.' với nội dung như sau:';
                          // Gửi Email theo quản trị viên đăng nhập
                          $quantri=Admin::model()->findByPk(Yii::app()->session['adid']);
                                $email_send="";
                                 $email_pass=$quantri->pass_email;
                                if($quantri->email_send){
                                   $email_send=$quantri->email_send;
                                }else{
                                   $email_send=$quantri->email;
                                }     
                           //Đính kèm file VCBS     
                           $dateMax=Investeffects::getMaxDate();// tìm date lớn nhất trong bảng đơn vị đầu tư
                           $maxDate=Investeffects::model()->findByAttributes(array('date'=>$dateMax));// lấy giá trị 1 đơn vị đàu tư lớn nhất      
                           $path='http://members.pif.vn/uploads/';// Đường dẫn của file
                           $fileName=substr(strrchr($maxDate->file, "/"), 1);  // Hàm này dùng để lấy tên file    
                          $this-> mailsendFileByS($kh->email, 'Báo cáo tuần của Passion Investment '.Investeffects::getMaxDate(), $mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                         
                          if($kh->email_secondary){
                            $this-> mailsendFileByS($kh->email_secondary, 'Báo cáo tuần của Passion Investment '.Investeffects::getMaxDate(), $mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                          }
                          if($kh->email_third){
                                $this-> mailsendFileByS($kh->email_third, 'Báo cáo tuần của Passion Investment '.Investeffects::getMaxDate(), $mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,file_get_contents($path.$fileName),$fileName,$email_send,$email_pass);//gửi đến người dùng
                          }
                       //   $this-> mailsendFileBy($email_send, 'Passion Investment - Email gửi đến khách hàng '.$kh->fullname.' '.Investeffects::getMaxDate(),$ad.$mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,$email_send,file_get_contents($path.$fileName),$fileName);//quản trị viên
                        //  $this-> mailsendFileBy('baocao@pif.vn', 'Passion Investment - Email gửi đến khách hàng '.$kh->fullname.' '.Investeffects::getMaxDate(),$ad.$mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,$email_send,file_get_contents($path.$fileName),$fileName);//quản trị viên
                        //  $this-> mailsendFileBy('admin@pif.vn', 'Passion Investment - Email gửi đến khách hàng '.$kh->fullname.' '.Investeffects::getMaxDate(),$ad.$mes.$quantri->signature,$mPDF1->Output('', EYiiPdf::OUTPUT_TO_STRING),$filename,$email_send,file_get_contents($path.$fileName),$fileName);//quản trị viên
                         
                }//kết thúc vòng lặp
               // print_r($test);die;
                 $this->render('sus');

           }  
       }else{
         echo "Không có quyền truy cập;";
       }
     }
    public function loadModel($id)
      {
        $model=Investeffects::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
      }
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
     static function mailsendFileBy($to,$subject,$message,$content,$filename,$email,$fileBath,$file){
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
        $mail->AddStringAttachment($fileBath, $file);
       // $mail->AddAttachment($fileBath, $file);
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
         $mail->ClearAllRecipients( ); // clear all
          $mail->ClearAttachments();
    }
    static function mailsendFileByS($to,$subject,$message,$content,$filename,$fileBath,$file,$username,$password){
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
        $mail->AddStringAttachment($fileBath, $file);
       // $mail->AddAttachment($fileBath, $file);
        if(!$mail->Send()) {
         //   echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
           // echo "Message sent!";
        }
         $mail->ClearAllRecipients( ); // clear all
          $mail->ClearAttachments();
    }
    // static function mailsendFileBy($to,$subject,$message,$content,$filename,$email){
    //     $mail=Yii::app()->Smtpmail;
    //    // $mail->SetFrom('Passion Investment', 'tuvan@pif.vn');
    //     $mail->From=$email;
    //     $mail->FromName = "Passion Investment";
    //     $mail->AddReplyTo($email,"Passion Investment");
    //     $mail->CharSet = "UTF-8";
    //     $mail->Subject    = $subject;
    //     $mail->MsgHTML($message);
    //     $mail->AddAddress($to, "");
    //     $mail->IsHTML(true);  
    //     $mail->AddStringAttachment($content,$filename);
    //     if(!$mail->Send()) {
    //      //   echo "Mailer Error: " . $mail->ErrorInfo;
    //     }else {
    //        // echo "Message sent!";
    //     }
    //      $mail->ClearAllRecipients( ); // clear all
    //      $mail->ClearAttachments();
    // }
    /**
     hàm tạo image google chart/ biểu đồ hiệu quả đầu tư
     return link image hiệu quả đầu tư
    */
    static function generateGoogleChart() {
         $hqdt=Investeffects::getALl();// Truy vấn tất cả dữ liệu từ bảng hiệu quả đầu tư gồm ngày và giá 1 đơn vị đầu tư
         $maxWeeks = count($hqdt);// Đếm số lượng row trả về
        //Set chd parameter to no value
         $chd = '';
         $limit = $maxWeeks+1;
          //Start to compile the prices data
          for ($row = 0; $row < $limit; $row++) {
        //Check for a value if one exists, add to $chd
            if(isset($hqdt[$row]['motdvdt']))
            {
                $chd .= $hqdt[$row]['motdvdt'];
            }
            //Check to see if row exceeds $maxWeeks
            if ($row < $maxWeeks) {
                //It doesn't, so add a comma and add the price to array $scaleValues
                $chd .= ',';
                $scaleValues[] = $hqdt[$row]['motdvdt'];
            } else if ($row >= $maxWeeks && $row < ($limit - 1)) {
                //Row exceeds, so add null value with comma
                $chd .= '_,';
            } else {
                //Row exceeds and is last required value, so just add a null value
                $chd .= '_';
            }
         }
   //        foreach($hqdt as $item) {
            //   $chd.= $item['motdvdt'];
            //   $scaleValues[]=$item['motdvdt'];
            // }
         //Use the $scaleValues array to define my Y Axis 'buffer'
         $YScaleMax = round(max($scaleValues)) + 1000;
         $YScaleMin = 10000;
         $graphSequence='';
         foreach($hqdt as $item) {
                 $graphSequence .= Investeffects::Viewdate($item['date']) . '|';
            }
        //Set the Google Image Chart API parameters
         $cht = 'lc';//Set the chart type
         $chxl ='1:|' .$graphSequence ;//custom axis labels
         $chxp = '50,100|5,100';//Axis Label Positions
         $chxs = '0,252525,10,1,l,676767|1,252525,10,0,l,676767|2,03619d,13|4,03619d,13|5,252525,10,1,l,676767';//Axis Label Styles
         $chxtc = '0|50|100';//Axis Tick Mark Styles
         $chxt = 'y,x';//Visible Axes   
         $chs = '1000x300';//Chart Size in px
         $chco = '179046';//Series Colours
         $chds = $YScaleMin . ',' . $YScaleMax . '';//Custom Scaling    
         $chxr = '0,' . $YScaleMin . ',' . $YScaleMax . '|1,1,52|3,1,12|5,' . $YScaleMin . ',' . $YScaleMax . '';//Axis Range
         $chg = '-1,-1,1,5';//Grid lines
         $chls = '3';//line styles
         $chm = 'o,252525,0,-1,3';//Shape Markers
          //Build the URL
         $googleUrl = 'http://chart.apis.google.com/chart?';
         $rawUrl = $googleUrl . 'cht=' . $cht . '&chxl=' . $chxl . '&chxp=' . $chxp . '&chxr=' . $chxr . '&chxs=' . $chxs . '&chxtc=' . $chxtc . '&chxt=' . $chxt . '&chs=' . $chs . '&chco=' . $chco . '&chd=t:' . $chd . '&chds=' . $chds . '&chg=' . $chg . '&chls=' . $chls . '&chm=' . $chm;

 

       return $rawUrl;
               // echo "<pre>"; 
               //  print_r($rawUrl);
               // echo "</pre>";
    }
    /**
    Hàm thay đổi nội dung của báo cáo hiệu quả đầu tư
    */
    static function GenBC($content,$id,$image){
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $date=Investment::ViewDate(Investeffects::getMaxDate());//Lấy date của ngày hiện tại
         $kh=Customer::model()->findByPk($id);//Tìm khách hàng theo ID
         $contents=str_replace("bc_date",$date,$content);   
         $contents=str_replace("bc_name",mb_strtoupper($kh->fullname,'UTF-8'),$contents);
         $contents=str_replace("bc_image",$image,$contents);
         $dateMax=Investeffects::getMaxDate();//Tìm ngày lớn nhất trong bảng hiệu quả đầu tư
         $maxDate=Investeffects::model()->findByAttributes(array('date'=>$dateMax));// Tìm row của ngày lơn nhất
          if($maxDate){//Nếu tồn tại trường có ngày lớn nhất thì làm tiếp
            $per=(($maxDate->motdvdt-10000)/10000)*100;// Tính được lợi nhuận từ đầu năm
          }
           $contents=str_replace("bc_percent",str_replace(".",",",round($per,2)),$contents);
         //Tính hợp đồng
         $contract=Contract::model()->findAllByAttributes(array('id_customer' => $id, 'status' =>2),array('order'=>'date_modified ASC'));//tìm tất cả hợp đồng đang hiệu lực với khách hàng này
          $mes='';//Nội dung để replace
          $i=1;//Đếm stt
          $toltaldv='';//Tổng số đơn vị đầu tư hiện tại
          $motdvdtc='';// Giá trị một đơn vị đầu tư hiện tại
          $totalmoney='';//Tổng số tiền hiện tại của khách hàng
          $totalvonHD='';//Tổng vốn đầu tư của khách hàng
          $totallai='';//Tổng số lãi của khách hàng
          $totalPecent='';//Tổng % lợi nhuận của khách hàng
          $count=count($contract);
         foreach($contract as $item) {//Vòng lặp tất cả hợp đồng
           
            $hddate=$item->date_modified;// lấy ngày kí hợp đồng để tìm được đvđt, giá 1 đơn vị đầu tư
            if($hddate){}else{
                $hddate=$item->date_created;
            }

            $Ts=date("Y-m-d",strtotime("$hddate - 1 day"));//tính ra 1 ngày trước hôm ký HĐ
            $iv= Investment::model()->findByAttributes(array("date"=>$Ts));// tìm ngày ký hợp đồng trong bảng giá trị đầu tư
            $vonHD=$item->investment;// vốn khách hàng gớp ban đầu
            $dv='';//Số lượng đơn vị đầu tư mà khách hàng bỏ vào = vốn ban đầu/giá 1 đơn vị đầu tư
            $motdvdt='';// giá 1 đơn vị đầu tư=từ bảng đơn vị đầu tư
            $totalvonHD= $totalvonHD+$vonHD;//Tổng vốn đầu tư

            if($iv){
                $motdvdt=$iv->motdvdt;// giá 1 đvđt
                if($iv->motdvdt!=0) {//Nếu giá 1 đơn vị đầu tư phải khác không thì mới tính tiếp 
                $dv=(double)$vonHD/(double)($iv->motdvdt);
                $toltaldv=$toltaldv + round($dv,0);// Tổng đơn vị đầu tư
               }
            // tính 5 lợi nhuận
         //    $dateMax=Investment::getMaxDate();// tìm date lớn nhất trong bảng đơn vị đầu tư
           //  $maxDate=Investment::model()->findByAttributes(array('date'=>$dateMax));// lấy giá trị 1 đơn vị đàu tư lớn nhất
             $motdvdtc=$maxDate->motdvdt;//giá 1 đơn vị đầu tư hiện tại
             $percent='';//Lợi nhuận đạt được=(Giá 1 ĐVĐT hiện tại/ Giá 1 ĐVĐT thời điểm ký)*100 - 100%;
             if($motdvdtc!=null &&$motdvdt!=null ){ //nếu tồn tại cả giá 1 đơn vị đầu tưu hiện tại và tại thời điểm ký
                $percent=(($motdvdtc*round($dv,0))/($vonHD))*100 - 100;
             }
             if($percent!=null && $vonHD!=null){ // tính tổng tiền hiện tai của khách hàng
                //$percent=round($percent,2);
                 //$totalmoney=$totalmoney+((($vonHD*$percent)/100)+$vonHD);// tổng số tiền của khách hang
                // $totallai=$totallai+(($vonHD*$percent)/100);//Tạm lãi của khách hang
             }   
               $mes.='<tr style="font-weight: 400 !important;">
                        <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;font-weight: 400 !important;" >'.$i++.'</td>
                        <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;font-weight: 400 !important;" >'.Investment::ViewDate($hddate).'</td> 
                        <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;font-weight: 400 !important;" >'.number_format(round($dv,0), 0, ',', '.').'</td>
                        <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;font-weight: 400 !important;" >'.number_format(round($motdvdt,0), 0, ',', '.').'</td>
                        <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;font-weight: 400 !important;" >'.number_format(round($vonHD,0), 0, ',', '.').'</td>
                        <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;font-weight: 400 !important;" >'.str_replace(".",",",round($percent,2)).'%</td>
                    </tr>';
            }
         }
   
          if($toltaldv!=null && $motdvdtc!=null ) {
           //  print_r($toltaldv);die();
            $totalmoney=round($toltaldv,0)*$motdvdtc;//Tổng số tiền hiện tại khách hàng bằng tổng đvđt hiện tại * giá trị 1 đv đầu tưu hiện tại
           
          }
          if($totalmoney!=null){
            $totallai=$totalmoney-$totalvonHD;//Lãi tạm tính bằng tổng số tiền hiện tại - tổng số vốn đầu tư
          }
          // Trường hợp chỉ có 1 bản hợp đồng
          if($count==1){

          }
          
          $contents=str_replace("bc_totaldvdt",number_format(round($toltaldv,0), 0, ',', '.'),$contents);
          $contents=str_replace("bc_pricedvdt",number_format(round($motdvdtc,0), 0, ',', '.'),$contents);
          $contents=str_replace("bc_totalprice",number_format(round($totalmoney,0), 0, ',', '.'),$contents);
          $contents=str_replace("bc_totaldt",number_format(round($totalvonHD,0), 0, ',', '.'),$contents);
          $contents=str_replace("bc_lai",number_format(round($totallai,0), 0, ',', '.'),$contents);
          if($totalmoney!=null &&$totalvonHD!=null ){
            $totalPecent=($totalmoney/$totalvonHD)*100 -100;//Tổng lợi nhuận
          }
          
          $contents=str_replace("bc_loinhuan",str_replace(".",",",round($totalPecent,2)),$contents);
          // nối tiếp table
          $mes.='<tr style="font-weight: bold;">
                  <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;" ></td>
                  <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;" >Tổng</td>
                  <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;" >'.number_format(round($toltaldv,0), 0, ',', '.').'</td>
                  <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;" ></td>
                  <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;" >'.number_format(round($totalvonHD,0), 0, ',', '.').'</td>
                  <td style="border: 2px solid #141414;padding: 8px;line-height: 1.42857143;vertical-align: top;" >'.str_replace(".",",",round($totalPecent,2)).'%</td>
                </tr>';
           $contents=str_replace("bc_table",$mes,$contents);// nối vào table   

          // print_r($ab);die();
         return $contents;

    }
    /**
    Hàm để thay đổi nội dung báo cáo nếu một số thành phân chưa được cập nhật
    */
    static function GenBCView($content){
         $contents=str_replace("bc_date",'......',$content);
         $contents=str_replace("bc_name",'......',$contents);
         $contents=str_replace("bc_image",'......',$contents);
         $contents=str_replace("bc_percent",'......',$contents);
         $contents=str_replace("bc_totaldvdt",'......',$contents);
         $contents=str_replace("bc_pricedvdt",'......',$contents);
         $contents=str_replace("bc_totalprice",'......',$contents);
         $contents=str_replace("bc_totaldt",'......',$contents);
         $contents=str_replace("bc_lai",'......',$contents);
         $contents=str_replace("bc_loinhuan",'......',$contents);
         $contents=str_replace("bc_table",'......',$contents);
        return $contents;
    }
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
   
}