
<div class="row">
   <div class="col-lg-12">
              
                      <h1 class="page-header">Tạo mới hợp đồng</h1>
               
   </div>
</div> 
<div class="row">
 
   <div class="col-lg-6">
                   <form role="form" action="<?php echo Yii::app()->request->baseUrl; ?>/Contract/RegContractPending" method="post" name="form-hd">
                     <div class="form-group">
                           
                           
                      </div>
                       
                      <div class="form-group">
                        <label for="disabledSelect">Chọn hình thức ký hợp đồng</label>
                        <select name="htHD" class="form-control">
                          <?php foreach ($form as $item) { ?>
                             <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                          <?php  } ?>
                                  
                                   
                           </select>
                    </div>
                     <div class="form-group">
                            <label for="disabledSelect">Số vốn đầu tư</label>
                            <div class="input-group">
                             <input class="form-control" name="vonHD" id="vonHD" type="text" placeholder=""  >
                              <span class="input-group-addon" id="basic-addon2">đ</span>
                            </div>
                      </div>
                      <div class="form-group">
                            <label for="disabledSelect" id="err_vonHD" style="color:red;font-size: 85%;font-style: italic"></label>
                             
                      </div>
                       <button type="submit" id="btn_hd" class="btn btn-primary">Đồng ý</button>
                  </form>  

                </div>
     <div class="col-lg-2">
     </div>           
    <div class="col-lg-4">
       <div class="panel panel-default">
           <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Thông tin khách hàng
             </div>
              <div class="panel-body">
                     <div class="form-group">
              <label for="disabledSelect">Họ tên khách hàng</label>
               <input class="form-control" name="fullname" type="text" value="<?php echo $cus['fullname'] ?>" disabled>
              </div>
               <div class="form-group">
                    <label for="disabledSelect">Email</label>
                     <input class="form-control" name="fullname" type="text" value="<?php echo $cus['email'] ?>" disabled>
              </div>
              <div class="form-group">
                    <label for="disabledSelect">CMTND</label>
                     <input class="form-control" name="fullname" type="text" value="<?php echo $cus['cmt'] ?>" disabled>
              </div>
              <div class="form-group">
                    <label for="disabledSelect">Số điện thoại</label>
                     <input class="form-control" name="fullname" type="text" value="<?php echo $cus['telephone'] ?>" disabled>
              </div>
              <div class="form-group">
                    <label for="disabledSelect">Mã số thuế cá nhân</label>
                     <input class="form-control" name="fullname" type="text" value="<?php echo $cus['mst'] ?>" disabled>
              </div>
              </div>
       </div>
    </div>
   </div>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/jquery/dist/jquery.min.js"></script>
   <script>
    $(window).load(function(){
         $('#err_vonHD').hide();
          $('#btn_hd').prop( "disabled", true );
     });
       $('#vonHD').keyup(function() { 
     if(($(this).val().trim() == null || $(this).val().trim() == "")){ 
           }else {
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,''))) {
               $('#err_vonHD').show();
               $('#err_vonHD').html("Vốn hợp đồng phải là số!");
               $('#btn_hd').prop( "disabled", true);
          }else  {
             $('#err_vonHD').hide();
             $('#btn_hd').prop( "disabled", false );
             if($(this).val().trim().replace(/\./g,'')<10000000){
                $('#err_vonHD').show();
                $('#err_vonHD').html("Vốn hợp đồng phải lớn hơn 10 triệu!");
                 $('#btn_hd').prop( "disabled", true);
             }else {
                $('#err_vonHD').hide();
                 $('#btn_hd').prop( "disabled", false);
             }  
        } 
       }
     
      });
function format(num) {
        var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
          str = str.split("").reverse();
          for(var j = 0, len = str.length; j < len; j++) {
            if(str[j] != ".") {
              output.push(str[j]);
              if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
              }
              i++;
            }
          }
          formatted = output.reverse().join("");
          return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
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