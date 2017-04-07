<?php
?>
<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="no index, no follow" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- css-trungcode -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/css/css.css" rel="stylesheet">
<style type="text/css" media="screen">
#err_email_login {
  display: none;
}
#validate_email_login {
  display: none;
}
#login_email_login {
  display: none;
}  
#err_password_login {
  display: none;
}        
#check_email_login{
 display: none;
}        
#validate_password_login{
 display: none;
}         
#login_succ{
display: none;
 }        
 #rows_forget{
display:none; 
}     
#title_forget{
	display:none;
}    
</style>
</head>

<body>

    <div class="container">
        <div class="row">
             <div class="col-md-1">
                 
             </div>
            <div class="col-md-10" id="header_pi">
              <h1>KHU VỰC THÀNH VIÊN</h1></br>
                <h3>PASSION  INVESTMENT</h3>
            </div>
            <div class="col-md-1">
                
            </div>
        </div>
        <div class="row">
              
            <div class="col-md-4 col-md-offset-4">
                <div id="divLoading" > 
                </div>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" id="title_login">
                        <h3 class="panel-title">ĐĂNG NHẬP</h3>
                    </div>
					<div class="panel-heading" id="title_forget">
                        <h3 class="panel-title">LẤY LẠI MẬT KHẨU</h3>
                    </div>
                    <div class="panel-body">
                       <!--  <form role="form" action="<?php echo Yii::app()->request->baseUrl?>/Login" method="post"> -->
                           <div class="rows_login" id="rows_login">
                                <div class="form-group">
                                  <label  id="login_email_login" class="error">Mật khẩu hoặc Email đã nhập sai</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" id="email_login" name="email" value="<?php if((string)Yii::app()->request->cookies['ck_name']) echo (string)Yii::app()->request->cookies['ck_name'] ;?>" type="email" >
                                </div>
                                <div class="form-group">
                                     <label  id="err_email_login" class="error">Email không được để trống!</label>
                                     <label  id="validate_email_login" class="error" >Email không đúng định dang! </label>
                                     
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="password" value="<?php if((string)Yii::app()->request->cookies['ck_password']) echo (string)Yii::app()->request->cookies['ck_password'] ;?>" type="password" id="password_login">
                                </div>
                                <div class="form-group">
                                     <label id="err_password_login" class="error">Mật Khẩu không được để trống!</label>
                                      <label id="validate_password_login" class="error">Mật Khẩu phải dài hơn 6 ký tự</label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" id="remember" type="checkbox" >Nhớ đăng nhập
                                    </label>
                                </div>
                                
                               
                                 <button onclick="login()"  class="btn btn-lg btn-success btn-block">Đăng nhập</button> 
                                   <div class="action_login">
                                      <a onclick="javascript:$('#title_forget').show();$('#title_login').hide();  $('#rows_login').hide(); $('#rows_forget').show();" title="Quên mật khẩu">Quên mật khẩu?</a><span role="presentation" aria-hidden="true"> · </span>
                                       <a onclick="javascript:  window.location.href='<?php echo Yii::app()->request->baseUrl.'/Register'; ?>';" title="Đăng ký tài khoản">Đăng ký tài khoản</a>
                                 </div>
                          </div>
                           <div id="rows_forget">
                              <label>Điền Email của bạn để lấy lại mật khẩu</label></br>
                                  <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-envelope"></span> 
                                    </div>
                                        <input id="email_login_forget" class="form-control"  name="email_login_forget" type="text"/>
                                  </div>
                                 
                                <label   id="err_email_forgot" class="error"></label></br>
                                <input type="hidden" id="url_forgot" value="<?php echo Yii::app()->getRequest()->getRequestUri() ?>" >
                                <button id="button_login" class="btn btn-primary" onclick="forgot()" >Gửi</button>
								  <span id="back-login" > <i class="fa fa-long-arrow-left" aria-hidden="true"></i> <a onclick="javascript:  window.location.href='<?php echo Yii::app()->request->baseUrl.'/Login'; ?>';" title="Quay về trang đăng nhập">Về trang đăng nhập</a></span> 
                           </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<footer>
   <div class="container">
    <div class="row">
      <div class="copyright">
        <span style="font-size: 14px;">Passion Investment version 1.0</span></br>
        <span style="font-size: 12px;">Technology Supported & SEO Service by <a target="_blank" href="http://ecpvn.com"> ECPVietnam </a></span>
      </div>
    </div>
   </div>
 </footer>
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/js/sb-admin-2.js"></script>

</body>
<script type="text/javascript">
     $(window).load(function(){
         $('#err_email_login').hide();
         $('#validate_email_login').hide();
         $('#login_email_login').hide();
         $('#err_password_login').hide();
         $('#check_email_login').hide();
         $('#validate_password_login').hide();
         $('#login_succ').hide();
         $('#rows_forget').hide();
		 $('#title_forget').hide();
        
     });
      // $('#email_login').keyup(function() {
      //       if(($(this).val().trim() == null || $(this).val().trim() == "")){
      //         $('#err_email_login').show();
      //         $(this).focus();
      //       }else{
      //       $('#err_email_login').hide(); 
      //        } 
      //        if(IsEmail($(this).val())==false){
      //           $('#validate_email_login').show(); 
      //            $(this).focus();
      //        }else{
      //            $('#validate_email_login').hide();
      //        }
      //    });
       // $('#password_login').keyup(function() {
       //      if(($(this).val().trim() == null || $(this).val().trim() == "")){
       //        $('#err_password_login').show();
       //        $(this).focus();
       //      }else{
       //           $('#err_password_login').hide(); 
       //           if($(this).val().trim().length<=6) {
       //               $('#validate_password_login').show();
       //           }else {
       //              $('#validate_password_login').hide();
       //           }
       //       } 
             
       //   });
        function login(){ 
		   if($('#remember').prop('checked')) {
               var check=1;
             }
		   
           var email=$('#email_login').val().trim();
           if(email.length<=0) {
               $('#err_email_login').show();
           }else {
               $('#err_email_login').hide(); 
               if(IsEmail(email)==false) {
                 $('#validate_email_login').show(); 
               }else {
                  $('#validate_email_login').hide(); 
               }
           }
           var password=$('#password_login').val().trim();
           if(password.length<=0) {
                $('#err_password_login').show();
           }else {
                $('#err_password_login').hide();
                if(password.length<=6) {
                    $('#validate_password_login').show();
                }else {
                     $('#validate_password_login').hide();
                }
           }
            if(email.length>0 && password.length>0 && IsEmail(email)==true){ 
                    $.ajax({ 
                       type:"POST", 
                       url:'<?php echo Yii::app()->request->baseUrl.'/Login/CheckLogin';?>',
                        data:{
                            email:email,
                            password:password,
							check:check
                        },
                         success:function(data){   
                            
                             if(data==0) {
                                  $("#divLoading").addClass('show');
                                    setTimeout(function() {
                                    $("#divLoading").removeClass('show')
                                    $('#login_email_login').show();
                             }, 2000);
                                  
                          }
                            if(data=="suslogin"){
                                  $("#divLoading").addClass('show');
                                  setTimeout(function() {
                                    $("#divLoading").removeClass('show')
                                    window.location.href='<?php echo Yii::app()->request->baseUrl.'/Home'; ?>';
                                 }, 2000);
                                                  
                              }
                         }
                  });
              }
        }  
         $('#email_login_forget').keyup(function() {
            if(($(this).val().trim() == null || $(this).val().trim() == "")){
              $('#err_email_forgot').html('Email không được để trống!');
              $(this).focus();
            }else{
                 $('#err_email_forgot').html('');
                 if(IsEmail($(this).val())==false){
                    $('#err_email_forgot').html('Email không đúng định dạng!'); 
                      $(this).focus();
                 }else{
                    $('#err_email_forgot').html(''); 
                }  
             } 
            
         });  
         function forgot(){
          var email=$('#email_login_forget').val().trim();
            $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/Login/Forgot';?>',
            data:
            {
                 email:email,
            },
           success:function(data){   
               
             if(data==0)
             {
                  $("#divLoading").addClass('show');
                                    setTimeout(function() {
                                      $("#divLoading").removeClass('show') ; 
                                      $('#err_email_forgot').html('Đổi pass không thành công'); 
                             }, 2000);
      
             } 
             if(data==2){
                  $("#divLoading").addClass('show');
                                    setTimeout(function() {
                                     $("#divLoading").removeClass('show') ;  
                                     $('#err_email_forgot').html('Email không tồn tại trong cơ sở dữ liệu');  
                             }, 2000);
                 
             }
              if(data==1){
                   $("#divLoading").addClass('show');
                   $('#err_email_forgot').html('Check mail để lấy mật khẩu mới.Hệ Thống sẽ refesh sau 5 giây!');   
                                    setTimeout(function() {
                                     $("#divLoading").removeClass('show') ;
                                    //  $('#err_email_forgot').html('Check mail để lấy mật khẩu mới.Hệ Thống sẽ refesh sau 5 giây!');   
                                     window.location.href='<?php echo Yii::app()->request->baseUrl.'/Login'; ?>';
                             }, 5000);
             }
             if(data==3){
                $('#err_email_forgot').html('Email không được trống!'); 
             }
       }
      });
      }
       function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }    
</script>
</html>
