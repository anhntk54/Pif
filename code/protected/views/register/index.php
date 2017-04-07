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
#err_email_reg {
  display: none;
  }
#err_password_reg{
  display: none;
}
#er_reg_password_math {
display: none;
}
#err_fullname_reg {
display: none;
}  
#reg_sus {
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
            <div id="divLoading" > 
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="reg-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ĐĂNG KÝ THÀNH VIÊN</h3>
                    </div>
                    <div class="panel-body">
                      <?php  if(Yii::app()->session['id']==null) { ?>
                        <div id="reg_form">
                          
                       
                            <div class="form-group">
                                    <input class="form-control" placeholder="E-mail (*)" id="reg_email" name="email" type="text" data-toggle="tooltip" data-placement="top" title="Địa chỉ email là bắt buộc">
                             </div>
                             <div class="form-group">
                                    <label   id="err_email_reg" class="error"></label>
                             </div>
                            
                             <div class="form-group">
                                    <input class="form-control" placeholder="Họ và tên (*)" id="reg_fullname" name="fullname" type="text" data-toggle="tooltip" data-placement="top" title="Điền đầy đủ họ tên!" >
                             </div>
                              <div class="form-group">
                                    <label   id="err_fullname_reg" class="error"></label>
                             </div>
                           
                               <button onclick="reg()" id="btn_dk" class="btn btn-success">Đăng ký</button>     
                             <span id="back-login" > <i class="fa fa-long-arrow-left" aria-hidden="true"></i> <a onclick="javascript:  window.location.href='<?php echo Yii::app()->request->baseUrl.'/Login'; ?>';" title="Quay về trang đăng nhập">Về trang đăng nhập</a></span> 
                              </div>
                         <div class="col-md-12 alert alert-success" id="reg_sus">
                           <span id="regsus"></span>
                         </div>   
                    <?php } else { ?>
                      <div class="col-md-12">
                       <div class="reg-info">
                       <span>Bạn phải đăng xuất mới có thể đăng ký tài khoản mới?<a title="Đăng xuất" href="<?php  echo Yii::app()->createUrl("/Login/Logout") ?>">Đăng xuất</a> |  <span  > <a onclick="javascript:  window.location.href='<?php echo Yii::app()->request->baseUrl.'/Login'; ?>';" title="Quay lại">Quay lại</a></span> </span>
                       </div>
                    
                      </div>
                    <?php } ?>
                           
                       
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
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script type="text/javascript">
 $(window).load(function(){
         $('#err_email_reg').hide();
         $('#err_fullname_reg').hide();
         // $('#btn_dk').prop('disabled', true);
        
       //  $('#reg_email').tooltip({'trigger':'focus', 'title': 'Điền địa chỉ email'});
     });
 //Đăng ký
      function reg(){ 
          var email=  $('#reg_email').val();
          var fullname=$('#reg_fullname').val();
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
         
          
         
          if(fullname.length<=0) {
               $('#err_fullname_reg').show();
                $('#err_fullname_reg').html("Họ tên không được trống!");
                $(this).focus();
          }else {
                $('#err_fullname_reg').hide();
          }
          
           if(email.length>0&&IsEmail(email)==true && fullname.length>0) {
               $.ajax({   
                   type: "POST",
                    url: '<?php echo Yii::app()->request->baseUrl.'/Register/SaveReg';?>',
                    data:
                     {
                        email:email,
                        fullname:fullname,
                     },
                     success: function (result)
                        {
                           
                            if(result==0){
                               $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#regsus').html('Đăng ký không thành công!Vui lòng kiểm tra lại!');  
                             }, 2000);
                         }
                          if(result==1){
                         //  $("#divLoading").addClass('show');
                               
                               
                             //    setTimeout(function() {
                             //         $("#divLoading").removeClass('show')   
                             //        // $('#regsus').html('Đăng ký thành công!Sau 5s hệ thống sẽ tải lại');
                                   
                             // }, 3000);
                               $('#reg_form').hide();
							   $('#reg_sus').show();
                               $('#regsus').html('Cám ơn bạn đã đăng ký là thành viên trên hệ thống PI.Hãy check mail để có thông tin đăng nhập.Hệ thống sẽ tự động tải lại sau 15s.Bạn có thể nhấn <a href="<?php echo Yii::app()->request->baseUrl.'/Login'; ?>">tại đây</a> để có thể quay về trang chủ');
                              setTimeout(function() {
                                     window.location.href='<?php echo Yii::app()->request->baseUrl.'/Login'; ?>';
                             }, 15000);
                          
                            }
                          if(result==3) {
                                $('#err_email_reg').show(); 
                                $('#err_email_reg').html('Email đã được đăng ký!');
                            }
                        },
                     error: function(err){
           
                      }
               } );
           }

      }
  /*Check Email đã tồn tại hay chưa*/
   // $('#reg_email').keyup(function() { 
   //      var email=$('#reg_email').val();
   //       $.ajax({
   //           type:"POST", 
   //           url:'<?php echo Yii::app()->request->baseUrl.'/Register/CheckEmail';?>',
   //          data:
   //          {
   //          email:email
   //          },
   //         success:function(data){   
   //           if(data==1){
   //                  $("#divLoading").addClass('show');
   //                             setTimeout(function() {
   //                                   $("#divLoading").removeClass('show')   
   //                                   $('#regsus').html('Email này đã được đăng ký!Vui lòng chọn Email khác');  
   //                                   $('#reg_email').focus();
   //                           }, 2000);
   //                          $('#reg_email').focus();
   //               }else{
                  
   //              }
            
   //     }
   //    });
   //  });    
 /**
  Kiểm tra Email
 */
  // $('#reg_email').keyup(function() {
  //           if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){
  //              $('#err_email_reg').show();  
  //              $('#err_email_reg').html('Email không được để trống');
  //             $(this).focus();
  //           }else{
  //              $('#err_email_reg').hide();
  //              if(IsEmail($(this).val())==false){
  //                $('#err_email_reg').show(); 
  //                $('#err_email_reg').html('Email không đúng định dạng!');
  //                $(this).focus();
  //            }else{
  //               $('#err_email_reg').hide();
  //            }
  //         } 
             
  //        });
  /*Kiểm tra mật khẩu*/
   // $('#reg_password').keyup(function() { 
   //       if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
   //            $('#err_password_reg').show();
   //            $('#err_password_reg').html("Mật khẩu không được để trống");
   //            $(this).focus();
   //         }else {
   //              $('#err_password_reg').hide();
   //              var password=$(this).val().trim();
   //              if(password.length <6){
   //                  $('#err_password_reg').show();
   //                  $('#err_password_reg').html("Mật khẩu không được <6 kí tự");
   //              } 
   //              if(password.length >50){
   //                  $('#err_password_reg').show();
   //                  $('#err_password_reg').html("Mật khẩu quá dài");
   //              } 
   //               if (password.search(/\d/) == -1) {
   //                   $('#err_password_reg').show();
   //                   $('#err_password_reg').html("Mật khẩu phải cố chữ số!");
   //              }  
   //              if(password.search(/[a-zA-Z]/) == -1) {
   //                   $('#err_password_reg').show();
   //                   $('#err_password_reg').html("Mật khẩu phải có ký tự viết hoa!");
   //              }
   //              if (password.search(/[^a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+\.\,\;\:]/) !=-1) {
   //                   $('#err_password_reg').show();
   //                   $('#err_password_reg').html("Mật khẩu phải có ký tự đặc biệt");
   //              }
   //       }
   // }); 
   
    /*Kiểm tra họ tên*/
    //   $('#reg_fullname').keyup(function() { 
    //       if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
    //            $('#err_fullname_reg').show();
    //             $('#err_fullname_reg').html("Họ tên không được trống!");
    //             $(this).focus();
    //       }else{
    //          $('#err_fullname_reg').hide();
    //       }
    // });
    /*Kiểm tra password nhập lại*/
    // $('#reg_password_math').keyup(function() {
    //   if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
    //         $('#er_reg_password_math').show();
    //         $('#er_reg_password_math').html("Mật khẩu nhập lại không được trống!");
    //    }else {
    //        $('#er_reg_password_math').hide();
    //        if($(this).val().trim()!=$('#reg_password').val().trim()) {
    //           $('#er_reg_password_math').show();
    //           $('#er_reg_password_math').html("Không khơp mật khẩu");
    //        }else {
    //            $('#er_reg_password_math').hide();
    //        }
    //    }
    // });
     
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
</body>

</html>
