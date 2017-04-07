<style>
#err_kh_email {
  display: none;
}
</style>

<div class="row">
   <div class="col-lg-12">
               
       <h1 class="page-header">Tạo mới khách hàng</h1>
              
                
   </div>
</div>
<div class="row">
  <?php if($sus==1) { ?>
   <div class="col-lg-12 alert alert-success">
               
      <p>Quý khách đã tạo mới khách hàng thành công! Để tạo hợp đồng mới <a href="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Contract/CreateHD">tại đây</a></p>
              
                
   </div>
  <?php } ?> 
  <?php if($fail==1) { ?>
   <div class="col-lg-12 alert alert-danger">
               
      <p>Tạo tài khoản không thành công!Vui lòng tải lại</p>
              
                
   </div>
   <?php } ?>  
</div>
<div class="row">
  <div class="col-lg-3">
    <div id="divLoading">

    </div>
  </div>
  
  <div class="col-lg-6">
    <form style="margin-bottom:30px;" id="form-createKH" role="form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Contract/SaveKH" method="post">

     <div class="form-group  has-feedback" id="divEmail">
      <label for="disabledSelect">Email<span style="color:red"> *</span></label>
      <input class="form-control" name="kh_email" id="kh_email" type="email" required placeholder="Email"  >
      <span id="divEmailErr" class="glyphicon  form-control-feedback" aria-hidden="true"></span>
    </div>
    <div class="form-group">
      <label   id="err_email_reg" class="error"></label>
    </div>
    <div class="form-group">
      <label for="disabledSelect" id="err_kh_email" class="error">Email đã tồn tại trong cơ sở dữ liệu</label>

    </div>
    <div class="row">
      <div class="col-lg-8" id="input_pass_ad">
       <div class="form-group">
        <label for="disabledSelect">Mật khẩu<span style="color:red"> *</span></label>
        <input class="form-control" name="kh_password" id="kh_password" type="password" value="<?php echo $pass ?>" placeholder="Mật khẩu"  >
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group" id="input_show_pass">
       <input id="test3" type="checkbox"  />Hiển thị mật khẩu
     </div>
   </div>
 </div>    
 <div class="form-group has-feedback" id="divFullname">
  <label for="disabledSelect">Họ và tên<span style="color:red"> *</span></label>
  <input class="form-control" name="kh_fullname" id="kh_fullname" type="text" required placeholder="Họ và tên">
  <span id="divFullnameErr" class="glyphicon  form-control-feedback" aria-hidden="true"></span>
</div>
<div class="form-group">
  <label   id="err_fullname_reg" class="error"></label>
</div>
<div class="form-group">
  <label for="disabledSelect">Số điện thoại</label>
  <input class="form-control" name="reg_telephone" id="reg_telephone" type="text" placeholder="Số điện thoại"  >
</div>
<div class="form-group">
  <label   id="err_telephone_reg" class="error"></label>
</div>
<div class="form-group">
  <label for="disabledSelect">Mã số thuế cá nhân</label>
  <input class="form-control" name="reg_mst" id="reg_mst" type="text" placeholder="Mã số thuế cá nhân"  >
</div>
<div class="form-group">
  <label   id="err_mst_reg" class="error"></label>
</div>
<div class="form-group">
  <label for="disabledSelect">Số CMTND/Hộ chiếu </label>
  <input class="form-control" name="reg_cmt" id="reg_cmt" type="text"  placeholder="Số CMTND/Hộ chiếu"  >
</div>
<div class="form-group">
  <label   id="err_cmt_reg" class="error"></label>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="disabledSelect">Ngày cấp CMTND</label>
      <input class="form-control datepicker" name="cmt_date" id="datepicker" type="text"  placeholder="Ngày cấp CMTND"  >
    </div>
    <div class="form-group">
      <label   id="err_cmt_date_reg" class="error"></label>
    </div> 
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="disabledSelect">Nơi cấp</label>
      <input class="form-control" name="reg_cmt_address" id="reg_cmt_address" type="text"  placeholder="Nơi cấp CMTND"  >
    </div>
    <div class="form-group">
      <label   id="err_cmt_address_reg" class="error"></label>
    </div>
  </div>
</div>

<div class="form-group">

 <label for="disabledSelect">Ngân hàng</label>

 <div class="row">
  <div class="col-md-4">
   <input class="form-control" name="reg_banknumber" id="reg_banknumber" type="text" placeholder="Số tài khoản"  >
   <label   id="err_bank" class="error"></label>
 </div>
 <div class="col-md-4">
  <input class="form-control" name="reg_namebank" id="reg_namebank" type="text" placeholder="Nhập ngân hàng"  >

</div>
<div class="col-md-4">
 <input class="form-control" name="reg_bankaddress" id="reg_bankaddress" type="text" placeholder="Chi nhánh"  >
</div>
</div>      
</div>
<div class="form-group">
  <input class="form-control" name="reg_bankacount" id="reg_bankacount" type="text" placeholder="Chủ tài khoản ngân hàng"  >
</div>   
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="disabledSelect">Ngày sinh</label>
      <input class="form-control datepicker" name="birthday" id="birthday" type="text" placeholder="Ngày sinh"  >
    </div>
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label for="disabledSelect">Địa chỉ</label>
      <input class="form-control" name="address" id="address" type="text" placeholder="Địa chỉ"  >
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="disabledSelect">Email phụ 1</label>
      <input class="form-control" name="reg_email_sc" id="reg_email_sc" type="text" placeholder="Email phụ 1"  >
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="disabledSelect">Email phụ 2</label>
      <input class="form-control" name="reg_email_tr" id="reg_email_tr" type="text" placeholder="Email phụ 2"  >
    </div>
  </div>
</div>
<button type="submit" id="btn_kh" class="btn btn-primary">Tạo mới</button>
</form>

</div>
<div class="col-lg-3">

</div>
</div>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.validate.min.js"></script>
<script>
  $(document).ready(function() {
    $("#form-createKH").validate({ 
      rules: { 
        kh_email: {
          required: true,
          
        },
            kh_fullname : {
              required: true,
            },
            
      },
      messages: { 
        kh_email: {
          required: "Bạn phải nhập Email ",
          
        },
         kh_fullname : {
              required: "Bạn phải nhập họ tên",
              
            },
             
      }

    });

  });

</script>
 <script type="text/javascript">
 $(window).load(function(){
         $('#err_kh_email').hide();err_email_reg
         $('#err_email_reg').hide();
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
         $('#err_bank').hide();
     });
   $('#kh_email').focusout(function() {
            if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){
               $('#err_email_reg').show();  
              $('#btn_kh').prop( "disabled", true);
               $('#err_email_reg').html('Email không được để trống');
              
             
            }else{
               $('#err_email_reg').hide();
             //   if(IsEmail($(this).val())==false){
             //     $('#err_email_reg').show(); 
             //     $('#err_email_reg').html('Email không đúng định dạng!');
                
             // }else{
             //    $('#err_email_reg').hide();
        
             // }
          } 
             
         });
  /*Kiểm tra xem ngân hàng có phải là số hay không*/
  // $('#reg_banknumber').keyup(function() {
  //      if(isNaN($(this).val().trim())){
  //            $('#err_bank').show();
  //             $('#err_bank').html('Số tài khoản ngân hàng phải là số');
  //      }else {
  //        $('#err_bank').html('');
  //        $('#err_bank').hide();
  //      }
  //  } )
  /*Check Email đã tồn tại hay chưa*/
   $('#kh_email').focusout(function() { 
        var email=$('#kh_email').val();
        if(email.length >0 && IsEmail(email)==true){
           $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/CheckEmail';?>',
            data:
            {
            email:email
            },
           success:function(data){   
             if(data==1){
                     $( "#divEmail" ).removeClass( "has-success" ).addClass( "has-error" );
                     $( "#divEmailErr" ).removeClass( "glyphicon-ok" ).addClass("glyphicon-remove");
                     $('#err_kh_email').show();
                     $('#btn_kh').prop( "disabled", true);
                 }else{
                  $('#err_kh_email').hide();
                  $( "#divEmail" ).removeClass( "has-error" ).addClass( "has-success" );
                   $( "#divEmailErr" ).removeClass( "glyphicon-remove" ).addClass("glyphicon-ok");
                   $('#btn_kh').prop( "disabled", false );
                }
            
       }
      });

        } 
        

    });
   /*Kiểm tra Email phụ*/
    $('#reg_email_sc').focusout(function() { 
        if(($(this).val().trim().length != 0)) {
         if(IsEmail($(this).val())==false){
                 $('#err_email_sc_reg').show(); 
                 $('#err_email_sc_reg').html('Email không đúng định dạng!');
                
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
// /*Kiểm tra mã số thuế*/
     $('#reg_mst').focusout(function() {  
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               // $('#err_mst_reg').show();
               //  $('#err_mst_reg').html("Mã số thuế không được để trống");
               //  $(this).focus();
          }else {
               $('#err_mst_reg').hide();
               if($(this).val().trim().isNumeric()!=1) {
                  $('#err_mst_reg').show();
                  $('#err_mst_reg').html("Mã số thuế phải là số");
               }
          }
     });
//     /*Kiểm tra là số điện thoại*/
     $('#reg_telephone').focusout(function() { 
         if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){  
               // $('#err_telephone_reg').show();
               // $('#err_telephone_reg').html("Số điện thoại không được để trống!"); 
               // $(this).focus();
         }else {
             $('#err_telephone_reg').hide();
             if(validatePhone($(this).val())==false) {
                 $('#err_telephone_reg').show();
                  $('#err_telephone_reg').html("Số điện thoại không đúng định dạng!");
                  $(this).focus();
             }else {
                 $('#err_telephone_reg').hide();
             }
         }
      }); 
// /*Kiểm tra số CMT*/
     $('#reg_cmt').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               // $('#err_cmt_reg').show();
               // $('#err_cmt_reg').html("CMTND không được để trống!");
               // $(this).focus();
          }else {
              $('#err_cmt_reg').hide();
               if($(this).val().trim().isNumeric()!=1) {
                  $('#err_cmt_reg').show();
                  $('#err_cmt_reg').html("CMT phải là số");
               }
          }
     }); 
    //Ngày cấp
    $('#datepicker').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               // $('#err_cmt_date_reg').show();
               // $('#err_cmt_date_reg').html("Ngày không được để trống!");
               // $(this).focus();
          }else {
              $('#err_cmt_date_reg').hide();
          }
     }); 
    // //Địa chỉ cấp 
    //  $('#reg_cmt_address').focusout(function() { 
    //       if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
    //            $('#err_cmt_address_reg').show();
       //    $('#btn_kh').prop( "disabled", true);
    //            $('#err_cmt_address_reg').html("Ngày không được để trống!");
    //           // $(this).focus();
    //          }else {
    //           $('#err_cmt_address_reg').hide();
       //   $('#btn_kh').prop( "disabled", false);
    //       }
    //  });     
  /*Kiểm tra họ tên*/
      $('#kh_fullname').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
                $( "#divFullname" ).removeClass( "has-success" ).addClass( "has-error" );
                $( "#divFullnameErr" ).removeClass( "glyphicon-ok" ).addClass("glyphicon-remove");
                $('#err_fullname_reg').show();
                $('#err_fullname_reg').html("Họ tên không được trống!");
                
          }else{
             $("#divFullname" ).removeClass( "has-error" ).addClass( "has-success" );
             $("#divFullnameErr" ).removeClass( "glyphicon-remove" ).addClass("glyphicon-ok");
             $('#err_fullname_reg').hide();
              $('#btn_kh').prop( "disabled", false);
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
  // Hàm check pass

  function validatePhone(txtPhone) {
       var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
       if (!filter.test(txtPhone)) {
        return false;
        }else {
        return true;
      }
      } 
 $(function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
    yearRange: "1970:+nn"
    });
  });   
 </script>
<script>
  //Place this plugin snippet into another file in your applicationb
(function ($) {
    $.toggleShowPassword = function (options) {
        var settings = $.extend({
            field: "#password",
            control: "#toggle_show_password",
        }, options);

        var control = $(settings.control);
        var field = $(settings.field)

        control.bind('click', function () {
            if (control.is(':checked')) {
                field.attr('type', 'text');
            } else {
                field.attr('type', 'password');
            }
        })
    };
}(jQuery));

//Here how to call above plugin from everywhere in your application document body
$.toggleShowPassword({
    field: '#kh_password',
    control: '#test3'
});
</script>