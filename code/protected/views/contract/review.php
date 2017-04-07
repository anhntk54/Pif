<?php ?>
<div class="row">
   <div class="col-lg-12">
                    <h1 class="page-header">Thông tin  hợp đồng số <?php echo $model->number_form ?></h1>
   </div>
</div> 
<div class="row">
<!--Thông báo -->
  <div class="col-lg-12">
     <div class="panel-default alert alert-success">
        <div class="panel-body ">
        <p>Hợp đồng số <b><?php echo $model->number_form ?></b> đã được tạo.</p>
        <p>Dưới đây là mẫu hợp đồng được ký kết. Sau khi ký hợp đồng hợp đồng sẽ được tự động cập nhật từ trạng thái "Đang chờ chốt sổ" sang trạng thái đã hiệu lực</p>
        <p>Để hoàn tất hợp đồng <b>số <?php echo $model->number_form ?></b>, vui lòng bấm vào ngân hàng Quý khách định chuyển tiền và làm theo <b>hướng dẫn nộp tiền hợp tác kinh doanh</b></p>
        <p><b><strong> HƯỚNG DẪN KHÁCH CHUYỂN TIỀN VÀO TÀI KHOẢN HỢP TÁC:</strong></b></p>
        <p>Passion Investment xin phép được gửi quý khách hàng nội dung cách thức nộp tiền tại ngân hàng Vietcombank (VCB).</p>
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <?php 
        $fullname=Contract::getFullName($model->id_customer);
        $name=Contract::convert_vi_to_en($fullname);
       ?>
       
        <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading3">
          <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
            1.TỪ NGÂN HÀNG KHÁC VIETCOMBANK (Tại quầy hoặc Ibanking) VÀ TẠI QUẦY CỦA VIETCOMBANK:
          </a>
          </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
          <div class="panel-body">
          <ul>
          <li>Người nhận: Công ty TNHH Chứng khoán Ngân hàng TMCP Ngoại thương Việt Nam</li>
          <li>Số tài khoản nhận: &nbsp;0011.002.475.230</li>
          <li>Tại: &nbsp;Ngân hàng TMCP Ngoại thương Việt Nam – Sở giao dịch</li>
          <li>Nội dung: <strong>009C662007, CTCP TVDT PASSION INVESTMENT <?php echo Contract::GetIDAuto($model->number_form) ?></strong></li>
          </ul>
          <p>&nbsp;</p>
          
          </div>
        </div>
        </div>
        <!-- -->
         <div class="panel panel-info">
        <div class="panel-heading" role="tab" id="heading4">
          <h4 class="panel-title">
          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse3">
            2.TỪ VIETCOMBANK QUA KÊNH ONLINE BANKING:
          </a>
          </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
          <div class="panel-body">
          <p>Bước 1: Đăng nhập vào tài khoản IBanking tại:</p>
          <p><a href="https://www.vietcombank.com.vn/IBanking2015/55c3c0a782b739e063efa9d5985e2ab4/Account/Login">https://www.vietcombank.com.vn/IBanking2015/55c3c0a782b739e063efa9d5985e2ab4/Account/Login</a></p>
          <p>Bước 2: Chọn mục”Thanh toán” và chọn “ Dịch vụ tài chính”, màn hình hiển thị các thông tin và điền như sau: </p>
          <ul>
            <li>Nhà cung cấp: <strong>chọn VCBS – Công ty chứng khoán Vietcombank</strong></li>
            <li>Mã khách hàng: <strong>009C662007</strong></li>
            <li>Tên khách hàng: <strong>CTCP TVDT PASSION INVESTMENT <?php echo Contract::GetIDAuto($model->number_form) ?></strong></li>
          </ul>
             <p>&nbsp;</p>
             <p>Ở phần <strong>Nội dung</strong>, Passion Investment xin được giải thích thông tin như sau:</p>
             <ul>
               <li><strong>009C662007 </strong>là tài khoản chứng khoán của công ty Passion Investment mở tại công ty chứng khoán;</li>
               <li><strong><?php echo Contract::GetIDAuto($model->number_form) ?></strong>: là Hợp đồng Hợp tác đầu tư số <?php echo Contract::GetIDAuto($model->number_form) ?></li>
             </ul>
          </div>
        </div>
        </div>
       
      </div>
           <p>Nếu còn thông tin chưa rõ ràng, rất mong quý khách hàng phản hồi lại phía Passion Investment để công ty có thể bổ sung và phục vụ quý khách hàng một cách tốt nhất ạ!</p>
           <p>Xin chân thành cảm ơn và chúc quý khách hàng một ngày mới vui vẻ!</p>
           <p>Ngay sau khi tiền về TK HTĐT, chúng tôi sẽ chốt số liệu và cập nhật vào hợp đồng, đồng thời thông báo và gửi lại quý khách hợp đồng đầy đủ. </p>
           <p>Để in hợp đồng  <i class="fa fa-hand-o-right" aria-hidden="true"></i>  <button type="button" class="btn btn-primary" onclick="printBill()">In hợp đồng</button></p>
        </div>
     </div>
  </div>
  <!--Review -->
  
  <!--Thông tin khách hàng -->
  <div class="col-lg-1">
    
  </div>
  <div class="col-lg-10" style="display: none;">
      <div class="panel panel-default" >
        <div class="panel-heading">
             Hợp đồng số <?php echo $model->number_form ?>
        </div>
         <div class="panel-body" id="print_content" >
          <p>  <?php echo Contract::GenHDView($hd) ?> </p>
         </div>
      </div>
  </div>
  <div class="col-lg-1">
    
  </div>
</div>
 <script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>

<script>
   function printBill() {
         var divContents = $("#print_content").html();
         var printWindow = window.open('', '', 'height=400,width=800');
         printWindow.document.write('<html><head><title><?php   $cus=Customer::model()->findByPk($model->id_customer); echo $model->number_form."_".$cus['fullname'] ?></title>');
            printWindow.document.write('<style>body{font-family: "Times New Roman"; font-size: 12pt; }a{text-decoration: none;}</style>'); 
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
       
    }
</script>
<script >

//////////F12 disable code////////////////////////
    document.onkeypress = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
          
            return false;
        }
    }
    document.onmousedown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            
            return false;
        }
    }
document.onkeydown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
           
            return false;
        }
    }
/////////////////////end///////////////////////


//Disable right click script 
var message="Sorry! :3"; 
/////////////////////////////////// 
function clickIE() {if (document.all) {(message);return false;}} 
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) { 
if (e.which==2||e.which==3) {(message);return false;}}} 
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;} 
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;} 
document.oncontextmenu=new Function("return false") 
// 
function disableCtrlKeyCombination(e)
{
//list all CTRL + key combinations you want to disable
var forbiddenKeys = new Array('a', 'n', 'c', 'x', 'v', 'j' , 'w');
var key;
var isCtrl;
if(window.event)
{
key = window.event.keyCode;     //IE
if(window.event.ctrlKey)
isCtrl = true;
else
isCtrl = false;
}
else
{
key = e.which;     //firefox
if(e.ctrlKey)
isCtrl = true;
else
isCtrl = false;
}
//if ctrl is pressed check if other key is in forbidenKeys array
if(isCtrl)
{
for(i=0; i<forbiddenKeys.length; i++)
{
//case-insensitive comparation
if(forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase())
{
alert('Key combination CTRL + '+String.fromCharCode(key) +' has been disabled.');
return false;
}
}
}
return true;
}
</script>