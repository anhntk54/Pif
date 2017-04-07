<div class="row">
   <div class="col-lg-12">
       <h1 class="page-header">Sửa thông tin khách hàng</h1>
   </div>
</div>
<div class="row">
      <div class="col-md-2">
      </div>
    <div class="col-md-8 alert alert-success" id="tt" style="display: none">
      <span id="regsus"></span>
    </div>
    <div class="col-md-2">
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
      <div class="panel-body">
        <div class="col-md-6">
          <input type="hidden" id="id" value="<?php echo $cus['id'] ?>" />
          <div class="form-group">
            <label for="disabledSelect">Email<span style="color:red"> *</span></label>
            <input class="form-control" placeholder="E-mail(*)" id="reg_email" name="email" type="text" value="<?php echo $cus['email'] ?>">
          </div>
          <div class="form-group">
            <label id="err_email_reg" style="color: red;"></label>
          </div>
          <div class="form-group">
            <label for="disabledSelect">Họ và tên<span style="color:red"> *</span></label>
            <input class="form-control" placeholder="Họ và tên(*)" id="reg_fullname" name="fullname" type="text" value="<?php echo $cus['fullname'] ?>">
          </div>
          <div class="form-group">
            <label   id="err_fullname_reg" style="color: red;"></label>
          </div>
          <div class="form-group">
            <label for="disabledSelect">Email phụ 1</label>
            <input class="form-control" value="<?php echo $cus['email_secondary'] ?>" id="reg_email_sc" placeholder="Email phụ 1" name="reg_email_sc" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_email_sc_reg" style="color: red;"></label>
          </div>
          <div class="form-group">
            <label for="disabledSelect">Email phụ 2</label>
            <input class="form-control" id="reg_email_tr" value="<?php echo $cus['email_third'] ?>" placeholder="Email phụ 2" name="reg_email_tr" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_email_tr_reg" style="color: red;"></label>
          </div>
          <div class="form-group">
            <label for="disabledSelect">Mã số thuế cá nhân</label>
            <input class="form-control" id="reg_mst" value="<?php echo $cus['mst'] ?>" placeholder="Mã số thuế cá nhân" name="reg_mst" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_mst_reg" style="color: red;"></label>
          </div>

        </div>
        <div class="col-md-6">

          <div class="form-group">
            <label for="disabledSelect">Số điện thoại</label>
            <input class="form-control" id="reg_telephone" value="<?php echo $cus['telephone'] ?>" placeholder="Số điện thoại" name="password" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_telephone_reg" style="color: red;"></label>
          </div>

          <div class="form-group">
            <label for="disabledSelect">Số CMTND/ Hộ Chiếu<span style="color:red"> *</span></label>
            <input class="form-control" placeholder="Số CMTND/Hộ chiếu *" value="<?php echo $cus['cmt'] ?>" id="reg_cmt" name="cmt" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_cmt_reg" style="color: red;"></label>
          </div>
          <div class="form-group">
            <label for="disabledSelect">Ngày cấp<span style="color:red"> *</span></label>
            <input class="form-control" placeholder="Ngày Cấp *" value="<?php if($cus['cmt_datecreate']) { echo Investment::ViewDate($cus['cmt_datecreate']); }?>" id="datepicker" name="cmt_date" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_cmt_date_reg" style="color: red;"></label>
          </div>
          <div class="form-group">
            <label for="disabledSelect">Nơi cấp<span style="color:red"> *</span></label>
            <input class="form-control" placeholder="Nơi cấp *" value="<?php echo $cus['cmt_addresscreate'] ?>" id="reg_cmt_address" name="reg_cmt_address" type="text" >
          </div>
          <div class="form-group">
            <label   id="err_cmt_address_reg" style="color: red;"></label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="disabledSelect">Số tài khoản</label>
            <input class="form-control" placeholder="Số tài khoản" value="<?php echo $cus['numberbank'] ?>" id="numberbank"  type="text" >
          </div>    
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="disabledSelect">Ngân hàng</label>
            <input class="form-control" placeholder="Chọn ngân hàng" value="<?php echo $cus['namebank'] ?>" id="namebank" name="namebank" type="text" >
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
            <label for="disabledSelect">Chọn quản trị viên</label>
            <select  class="form-control" name="admin" id="admin">
             <option value="">--Chọn quản trị viên--</option>
             <?php foreach($admin as $item) { ?>
             <option value="<?php echo $item['id'] ?>" <?php if($cus['id_admin']==$item['id']) echo "selected"; ?>><?php echo $item['fullname'] ?></option>
             <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="disabledSelect">Chủ tài khoản ngân hàng</label>
            <input class="form-control" placeholder="Chủ tài khoản ngân hàng" value="<?php echo $cus['bankacount'] ?>"  id="bankacount" type="text" >
          </div>
        </div>
        <div class="col-md-6">
          <button onclick="reg()" class="btn btn-primary">Cập nhật</button>     
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
          $('#tt').hide();
        
     });
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
                 $(this).focus();
             }else{
                $('#err_email_reg').hide();
             }
          }
           if(email.length>0 && IsEmail(email)==true && fullname.length>0) {
               $.ajax({   
                   type: "POST",
                    url: '<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/UpdateInfo';?>',
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
                        id:$('#id').val(),
                         reg_password:$('#reg_password').val()
                     },
                     success: function (result)
                        {
                           
                            if(result==0){
                               $("#divLoading").addClass('show');
                               $("#tt").show();
                               $("#tt").addClass('alert alert-danger');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#regsus').html('Cập nhật không thành công!Vui lòng kiểm tra lại!');  
                             }, 2000);
                         }
                          if(result==1){
                           // $("#divLoading").addClass('show');
                               $('#tt').show();
                               $('#regsus').html('Cập nhật thông tin cá nhân  thành công!Sau 5s hệ thống sẽ tải lại');
                                setTimeout(function() {
                                     // $("#divLoading").removeClass('show')   
                                       
                                     window.location.href='<?php echo Yii::app()->request->baseUrl.'/piadmin/Home'; ?>';
                             }, 5000);
                                
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
  /*Kiểm tra mật khẩu*/
   $('#reg_password').focusout(function() { 
         if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
              $('#err_password_reg').show();
              $('#err_password_reg').html("Mật khẩu không được để trống");
              $(this).focus();
         }else {
             $('#err_password_reg').hide();
              if($(this).val().trim().length <=6) {
                   $('#err_password_reg').show();
                   $('#err_password_reg').html("Mật khẩu không được ngắn hơn 6");
                   $(this).focus();
              }else {
                 $('#err_password_reg').hide();
              }
         }
   }); 
   /*Kiểm tra Email phụ*/
    // $('#reg_email_sc').focusout(function() { 
    //     if(($(this).val().trim().length != 0)) {
    //      if(IsEmail($(this).val())==false){
    //              $('#err_email_sc_reg').show(); 
    //              $('#err_email_sc_reg').html('Email không đúng định dạng!');
    //              $(this).focus();
    //          }else{
    //             $('#err_email_sc_reg').hide();
    //          }
    //     }
    // });  
    // /*Kiểm tra Email phụ*/
    // $('#reg_email_tr').focusout(function() { 
    //     if(($(this).val().trim().length != 0)) {
    //      if(IsEmail($(this).val())==false){
    //              $('#err_email_tr_reg').show(); 
    //              $('#err_email_tr_reg').html('Email không đúng định dạng!');
    //              $(this).focus();
    //          }else{
    //             $('#err_email_tr_reg').hide();
    //          }
    //     }
    // });  
    
    /*Kiểm tra họ tên*/
      $('#reg_fullname').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_fullname_reg').show();
                $('#err_fullname_reg').html("Họ tên không được trống!");
                $(this).focus();
          }else{
             $('#err_fullname_reg').hide();
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