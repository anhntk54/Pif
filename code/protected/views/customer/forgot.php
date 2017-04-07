<style type="text/css" >
#fg_info_update{
    display: none;
  }
</style>
<div class="row">
   <div class="col-lg-12 ">
              
                      <h1 class="page-header">Đổi mật khẩu</h1>
               
   </div>
</div>
<div class="row">
   <div class="col-md-12 alert alert-success" id="fg_info_update">
    <p>Cập nhật thông tin thành công!.Nhấn vào đây<a href="<?php echo Yii::app()->request->baseUrl.'/Home'; ?>" title=""> trang chủ </a></p>
   </div>
</div>
<div class="row">
  <div id="divLoading" > 
     </div>
      <div class="col-md-4 col-md-offset-2">
          <div class="reg-panel panel panel-default">
            <div class="panel-heading">
                        <h3 class="panel-title">Đổi mật khẩu</h3>
             </div>
             <div class="panel-body">
                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu cũ(*)" id="for_password_old" name="for_password_old" type="password" >
                </div>
                <div class="form-group">
                                    <label   id="err_for_password_old" class="error"></label>
                </div>
                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu mới(*)" id="for_password" name="for_password" type="password" >
                </div>
                 <div class="form-group">
                                    <label   id="err_for_password" class="error"></label>
                </div>
                <div class="form-group">
                                    <input class="form-control" placeholder="Nhập lại mật khẩu(*)" id="for_password_mat" name="for_password_mat" type="password" >
                </div>
                <div class="form-group">
                                    <label   id="err_for_password_mat" class="error"></label>
                </div>
                <div class="col-md-6">
                               <button onclick="forgot()" class="btn btn-primary">Cập nhật</button>     
                </div> 

             </div>
          </div>
      </div>
</div>
<script type="text/javascript">
   $(window).load(function(){ 
        $('#err_for_password_old').hide();
        $('#err_for_password').hide();
        $('#err_for_password_mat').hide();
   });
    $('#for_password_old').focusout(function() {  
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_for_password_old').show();
                $('#err_for_password_old').html("Mật khẩu cũ thuế không được để trống");
                
          }else {
               $('#err_for_password_old').hide();
               
          }
     });
    //Kiểm tra pass cũ có đúng không
     $('#for_password_old').focusout(function() { 
         
        var password= $('#for_password_old').val();
         $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/Customer/CheckPassword';?>',
            data:
            {
            password:password
            },
           success:function(data){   
             if(data==1){
                   
                     $('#err_for_password_old').show();
                                     $('#err_for_password_old').html('Password nhập không đúng');  
                                     $('#for_password_old').focus();            
                                    
             }else{
                  $('#err_for_password_old').hide();
             }
            
       }
      });
     });
     $('#for_password').focusout(function() {  
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_for_password').show();
                $('#err_for_password').html("Mật khẩu không được để trống");
               
          }else {
               $('#err_for_password').hide();
               
          }
     });
     $('#for_password_mat').keyup(function() {  
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_for_password_mat').show();
                $('#err_for_password_mat').html("Mật khẩu không được để trống");
                
          }else {
               $('#err_for_password_mat').hide();
               if($(this).val().trim()!= $('#for_password').val()){
                  $('#err_for_password_mat').show();
                  $('#err_for_password_mat').html("Mật khẩu nhập không đúng");
               }else {
                $('#err_for_password_mat').hide();
               }
               
          }
     });
   function forgot() {
       var old=$('#for_password_old').val();
           var password= $('#for_password').val();
       if(old.length<=0){
         $('#err_for_password_old').show();
                $('#err_for_password_old').html("Mật khẩu cũ  không được để trống");
                
       }else {
          $('#err_for_password_old').hide();
       }
              $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/Customer/GetPass';?>',
            data:
            {
            password:password
            },
           success:function(data){   
             if(data==1){
              $("#divLoading").addClass('show');
               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#fg_info_update').show();
                                  //   window.location.href='<?php echo Yii::app()->request->baseUrl.'/Home'; ?>';
                             }, 3000);
                  
                               
                                    
             }else{
                  
             }
            
       }
      });
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