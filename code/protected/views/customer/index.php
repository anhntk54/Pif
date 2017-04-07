<?php
/* @var $this CustomerController */

$this->breadcrumbs=array(
    'Customer',
);
?>
<style type="text/css" media="screen">
#kh_info_update {
display: none;
  }
</style>
<div class="row">
   <div class="col-lg-12 ">
              
                      <h1 class="page-header">Cập nhật thông tin cá nhân</h1>
               
   </div>
</div>
<div class="row">
   <div class="col-md-8 col-md-offset-2 alert alert-success" id="kh_info_update">
    <p>Cập nhật thông tin thành công!.Bạn muốn <a href="<?php  echo Yii::app()->createUrl("/Contract/RegContractPending") ?>" title="">tạo hợp đồng mới</a> ? Hay quay trở về <a href="<?php echo Yii::app()->request->baseUrl.'/Home'; ?>" title=""> trang chủ </a></p>
   </div>
</div>
<div class="row">
            <div id="divLoading" > 
                </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="reg-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cập nhật thông tin </h3>
                    </div>
                    <?php  $cus=Customer::model()->findByPk(Yii::app()->session['id']); ?>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <label for="disabledSelect">Email<span style="color:red"> *</span></label>
                                    <input class="form-control" placeholder="E-mail(*)" id="reg_email" name="email" type="text" value="<?php echo $cus['email'] ?>">
                            </div>
                             <div class="form-group">
                                    <label   id="err_email_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                              <div class="form-group">
                                    <label for="disabledSelect">Họ và tên<span style="color:red"> *</span></label>
                                    <input class="form-control" placeholder="Họ và tên(*)" id="reg_fullname" name="fullname" type="text" value="<?php echo $cus['fullname'] ?>">
                             </div>
                              <div class="form-group">
                                    <label   id="err_fullname_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                             <div class="form-group">
                                    <label for="disabledSelect">Email phụ 1</label>
                                    <input class="form-control" value="<?php echo $cus['email_secondary'] ?>" id="reg_email_sc" placeholder="Email phụ" name="reg_email_sc" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_email_sc_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                             <div class="form-group">
                                   <label for="disabledSelect">Email phụ 2</label>
                                    <input class="form-control" id="reg_email_tr" value="<?php echo $cus['email_third'] ?>" placeholder="Email phụ" name="reg_email_tr" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_email_tr_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                             <div class="form-group">
                                    <label for="disabledSelect">Mã số thuế cá nhân</label>
                                    <input class="form-control" id="reg_mst" value="<?php echo $cus['mst'] ?>" placeholder="Mã số thuế cá nhân" name="reg_mst" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_mst_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                            
                        </div>
                        <div class="col-md-6">
                            
                             <div class="form-group">
                                    <label for="disabledSelect">Số điện thoại<span style="color:red"> *</span></label>
                                    <input class="form-control" id="reg_telephone" value="<?php echo $cus['telephone'] ?>" placeholder="Số điện thoại(*)" name="password" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_telephone_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                              
                             <div class="form-group">
                                    <label for="disabledSelect">Số CMTND/Hộ chiếu<span style="color:red"> *</span></label>
                                    <input class="form-control" placeholder="Số CMTND/Hộ chiếu *" value="<?php echo $cus['cmt'] ?>" id="reg_cmt" name="cmt" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_cmt_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                              </div>
                             <div class="form-group">
                                    <label for="disabledSelect">Ngày cấp<span style="color:red"> *</span></label>
                                    <input class="form-control" placeholder="Ngày Cấp *" value="<?php echo Investment::ViewDate($cus['cmt_datecreate']) ?>" id="datepicker" name="cmt_date" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_cmt_date_reg" style="color: red;font-size: 85%;font-style: italic;"></label>
                             </div>
                             <div class="form-group">
                                    <label for="disabledSelect">Nơi cấp<span style="color:red"> *</span></label>
                                    <input class="form-control" placeholder="Nơi cấp *" value="<?php echo $cus['cmt_addresscreate'] ?>" id="reg_cmt_address" name="reg_cmt_address" type="text" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_cmt_address_reg" style="color: red;font-size: 85%;font-style: italic;font-size: 85%;font-style: italic;"></label>
                             </div>
                             
                        </div>
                          <div class="col-md-6">
                             <div class="form-group">
                                    <label for="disabledSelect">Số tài khoản</label>
                                    <input class="form-control" placeholder="Số tài khoản" value="<?php echo $cus['numberbank'] ?>" id="numberbank"  type="text" >
                                    <label   id="err_bank" style="color: red;display:none;font-size: 85%;font-style: italic"></label>
                             </div>    
                        </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                    <label for="disabledSelect">Ngân hàng</label>
                                     <input  class="form-control" name="namebank" id="namebank" placeholder="Chọn ngân hàng" value="<?php echo $cus['namebank'] ?>">
                                   
                             </div>   
                        </div>  
                        <div class="col-md-6">
                              <div class="form-group">
                                    <label for="disabledSelect">Chi nhánh</label>
                                    <input class="form-control" placeholder="Chi nhánh" value="<?php echo $cus['chinhanh'] ?>"  id="addressbank" type="text" >
                             </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                               <label for="disabledSelect">Chủ tài khoản ngân hàng</label>
                                <input class="form-control" placeholder="Chủ tài khoản ngân hàng" value="<?php echo $cus['bankacount'] ?>"  id="bankacount" type="text" >
                            </div>
                         </div> 
                        <div class="col-md-12">
                           <span style="color: #141414;font-size: 85%;font-style: italic;font-weight:500;margin-bottom: 20px;">
                             Tài khoản ngân hàng phía trên đây được dùng để Passion Investment chuyển tiền cho quý khách sau khi tất toán hợp đồng.
                           </span>
                        </div>
                         <div class="col-md-6">
                               <button onclick="reg()" class="btn btn-primary">Cập nhật</button>     
                         </div>       
                         <div class="col-md-12">
                           <span id="regsus" style="color: red;font-size: 85%;font-style: italic;"></span>
                         </div>   
                       
                    </div>
                </div>
            </div>
        </div>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
 $(window).load(function(){
         $('#err_email_reg').hide();
         $('#err_password_reg').hide();
         $('#err_email_sc_reg').hide();
         $('#err_email_tr_reg').hide();
         $('#err_mst_reg').hide();
         $('#err_telephone_reg').hide();
         $('#err_fullname_reg').hide();
         $('#err_cmt_reg').hide();
         $('#err_cmt_date_reg').hide();
         $('#err_cmt_address_reg').hide();
         $('#kh_info_update').hide();
        
     });
 /*Kiểm tra xem ngân hàng có phải là số hay không*/
  $('#numberbank').keyup(function() {
       if(isNaN($(this).val().trim())){
             $('#err_bank').show();
              $('#err_bank').html('Số tài khoản ngân hàng phải là số');
       }else {
         $('#err_bank').html('');
         $('#err_bank').hide();
       }
   } )
 //Đăng ký
      function reg(){ 
          var email=  $('#reg_email').val();
          var password=  $('#reg_password').val();
          var email_sc= $('#reg_email_sc').val(); 
          var email_tr= $('#reg_email_tr').val(); 
          var mst= $('#reg_mst').val();
          var telephone= $('#reg_telephone').val();
          var fullname=$('#reg_fullname').val();
          var cmt=$('#reg_cmt').val();
          var cmt_date=$('#datepicker').val();
          var cmt_addrress=$('#reg_cmt_address').val();
          var numberbank=$('#numberbank').val();
          var namebank=$('#namebank').val();
          var addressbank=$('#addressbank').val();
          var bankacount=$('#bankacount').val();
          if(email.length <=0) {
            $('#err_email_reg').show();  
            $('#err_email_reg').html('Email không được để trống');
          }else {
              $('#err_email_reg').hide();  
              if(IsEmail(email)==false){
                 $('#err_email_reg').show(); 
                 $('#err_email_reg').html('Email không đúng định dạng!');
                 
             }else{
                $('#err_email_reg').hide();
             }
          }
          // if(password.length <=0) {
          //     $('#err_password_reg').show();
          //     $('#err_password_reg').html("Mật khẩu không được để trống");
          //     $(this).focus();
          // }else {
          //      $('#err_password_reg').hide();
          // }
          // if(mst.length<=0) {
          //      $('#err_mst_reg').show();
          //       $('#err_mst_reg').html("Mã số thuế không được để trống");
          //       $(this).focus();
          // }else {
          //        $('#err_mst_reg').hide();
          // }
          if(telephone.length<=0) {
              $('#err_telephone_reg').show();
               $('#err_telephone_reg').html("Số điện thoại không được để trống!"); 
               $(this).focus();
          }else {
              $('#err_telephone_reg').hide();
          }
          if(fullname.length<=0) {
               $('#err_fullname_reg').show();
                $('#err_fullname_reg').html("Họ tên không được trống!");
                
          }else {
                $('#err_fullname_reg').hide();
          }
          if(cmt.length<=0){
                $('#err_cmt_reg').show();
               $('#err_cmt_reg').html("CMTND không được để trống!");
               
          }else {
                $('#err_cmt_reg').hide();
          }
           if(email.length>0 && IsEmail(email)==true  && fullname.length>0 && cmt.length>0 && cmt_date.length>0 && cmt_addrress.length>0 && telephone.length>0) {
               $.ajax({   
                   type: "POST",
                    url: '<?php echo Yii::app()->request->baseUrl.'/Register/UpdateInfo';?>',
                    data:
                     {
                        email:email,
                        email_sc:email_sc,
                        email_tr:email_tr,
                        mst:mst,
                        telephone:telephone,
                        fullname:fullname,
                        cmt:cmt,
                        cmt_date:cmt_date,
                        cmt_addrress:cmt_addrress,
                        numberbank:numberbank,
                        namebank:namebank,
                        addressbank:addressbank,
                        bankacount:bankacount,
                        reg_password:$('#reg_password').val()
                     },
                     success: function (result)
                        {
                           
                            if(result==0){
                               $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#regsus').html('Cập nhật không thành công!Vui lòng kiểm tra lại!');  
                             }, 2000);
                         }
                          if(result==1){
                           $("#divLoading").addClass('show');
                             //  $('#kh_info_update').show();
                              
                                setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#kh_info_update').show();
                                  //   window.location.href='<?php echo Yii::app()->request->baseUrl.'/Home'; ?>';
                             }, 3000);
                                
                            }
                        },
                     error: function(err){
           
                      }
               } );
           }

      }
  // /*Check Email đã tồn tại hay chưa*/
  //  $('#reg_email').focusout(function() { 
  //       var email=$('#reg_email').val();
  //        $.ajax({
  //            type:"POST", 
  //            url:'<?php echo Yii::app()->request->baseUrl.'/Register/CheckEmail';?>',
  //           data:
  //           {
  //           email:email
  //           },
  //          success:function(data){   
  //            if(data==1){
  //                   $("#divLoading").addClass('show');
  //                              setTimeout(function() {
  //                                    $("#divLoading").removeClass('show')   
  //                                    $('#regsus').html('Email này đã được đăng ký!Vui lòng chọn Email khác');  
  //                                    $('#reg_email').focus();
  //                            }, 2000);
                  
  //            }else{
                  
  //            }
            
  //      }
  //     });
  //   });    
 /**
  Kiểm tra Email
 */
  $('#reg_email').focusout(function() {
            if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){
               $('#err_email_reg').show();  
               $('#err_email_reg').html('Email không được để trống');
              $(this).focus();
            }else{
               $('#err_email_reg').hide();
               if(IsEmail($(this).val())==false){
                 $('#err_email_reg').show(); 
                 $('#err_email_reg').html('Email không đúng định dạng!');
                 $(this).focus();
             }else{
                $('#err_email_reg').hide();
             }
          } 
             
         });
  // /*Kiểm tra mật khẩu*/
  //  $('#reg_password').focusout(function() { 
  //        if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
  //             $('#err_password_reg').show();
  //             $('#err_password_reg').html("Mật khẩu không được để trống");
  //             $(this).focus();
  //        }else {
  //            $('#err_password_reg').hide();
  //             if($(this).val().trim().length <=6) {
  //                  $('#err_password_reg').show();
  //                  $('#err_password_reg').html("Mật khẩu không được ngắn hơn 6");
  //                  $(this).focus();
  //             }else {
  //                $('#err_password_reg').hide();
  //             }
  //        }
  //  }); 
   /*Kiểm tra Email phụ*/
    $('#reg_email_sc').focusout(function() { 
        if(($(this).val().trim().length != 0)) {
         if(IsEmail($(this).val())==false){
                 $('#err_email_sc_reg').show(); 
                 $('#err_email_sc_reg').html('Email không đúng định dạng!');
                 $(this).focus();
             }else{
                $('#err_email_sc_reg').hide();
             }
        }
    });  
    /*Kiểm tra Email phụ*/
    $('#reg_email_tr').focusout(function() { 
        if(($(this).val().trim().length != 0)) {
         if(IsEmail($(this).val())==false){
                 $('#err_email_tr_reg').show(); 
                 $('#err_email_tr_reg').html('Email không đúng định dạng!');
                 $(this).focus();
             }else{
                $('#err_email_tr_reg').hide();
             }
        }
    });  
    /*Kiểm tra mã số thuế*/
    /* $('#reg_mst').focusout(function() {  
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_mst_reg').show();
                $('#err_mst_reg').html("Mã số thuế không được để trống");
                $(this).focus();
          }else {
               $('#err_mst_reg').hide();
               // if($(this).val().trim().isNumeric()!=1) {
               //    $('#err_mst_reg').show();
               //    $('#err_mst_reg').html("Mã số thuế không được để trống");
               // }
          }
     });*/
    /*Kiểm tra là số điện thoại*/
     $('#reg_telephone').focusout(function() { 
         if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){  
               $('#err_telephone_reg').show();
               $('#err_telephone_reg').html("Số điện thoại không được để trống!"); 
         }else {
             $('#err_telephone_reg').hide();
             if(validatePhone($(this).val())==false) {
                 $('#err_telephone_reg').show();
                  $('#err_telephone_reg').html("Số điện thoại không đúng định dạng!");
                 
             }else {
                 $('#err_telephone_reg').hide();
             }
         }
      }); 
    /*Kiểm tra họ tên*/
      $('#reg_fullname').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_fullname_reg').show();
                $('#err_fullname_reg').html("Họ tên không được trống!");
               
          }else{
             $('#err_fullname_reg').hide();
          }
    });
    /*Kiểm tra số CMT*/
     $('#reg_cmt').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_cmt_reg').show();
               $('#err_cmt_reg').html("CMTND không được để trống!");
              
          }else {
              $('#err_cmt_reg').hide();
          }
     }); 
    //Ngày cấp
    $('#datepicker').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_cmt_date_reg').show();
               $('#err_cmt_date_reg').html("Ngày không được để trống!");
               
          }else {
              $('#err_cmt_date_reg').hide();
          }
     }); 
    //Địa chỉ cấp 
     $('#reg_cmt_address').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_cmt_address_reg').show();
               $('#err_cmt_address_reg').html("Ngày không được để trống!");
              
             }else {
              $('#err_cmt_address_reg').hide();
          }
     }); 
     
 // Hàm check validate
 function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }   
  function validatePhone(txtPhone) {
       var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
       if (!filter.test(txtPhone)) {
        return false;
        }else {
        return true;
      }
      }      
 $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
      yearRange: "1970:+nn"
    });
  });
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