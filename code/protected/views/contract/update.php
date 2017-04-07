<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Sửa hợp đồng số <?php echo $model->number_form ?></h1>
      
   </div>

</div>
<div class="row">
 <?php if($sus==1){ ?>
   <div class="col-lg-12 alert alert-success">
     <p>Cập nhật hợp đồng thành công.Nhấn <a href="<?php echo Yii::app()->request->baseUrl; ?>/Contract/AllContract" title="">tại đây </a> để quay về trang danh sách hợp đồng</p>
   </div>
  <?php } ?> 
  <!--  <div class="col-lg-12 alert alert-danger">
     <p>Cập nhật hợp đồng thất bại!</p>
   </div> -->
</div>
<div class="row" style="margin-bottom: 10%;">
  
     <form role="form" id="contract-form" action="<?php echo Yii::app()->request->baseUrl; ?>/Contract/Editss/id/<?php echo $model->id ?>" method="post">
        <div class="col-lg-3">
          
        </div>
        <div class="col-lg-6">
          <div class="form-group">
             <label for="disabledSelect">Loại hợp đồng</label>
             <select name="Contract[id_form]" id="Contract_id_form" class="form-control">
              <?php foreach ($form as $item) { ?>
                 <option <?php if($model->id_form==$item['id']) echo "selected" ?> value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
              <?php  } ?>
           
                 </select>
          </div>
          <div class="form-group">
             <label for="disabledSelect">Vốn đầu tư</label>
             <div class="input-group">
               <input class="form-control" name="Contract[investment]" id="Contract_investment" type="text" value="<?php echo $model->investment  ?>"  >
               <span class="input-group-addon" id="basic-addon2">đ</span>
            </div> 
             <label for="disabledSelect" id="err_vonHD" style="color:red;font-size: 85%;font-style: italic"></label>  
          </div>
         
          
       
          <button type="submit" id="btn_hdup" class="btn btn-primary">Đồng ý</button>
        </div>
        <div class="col-lg-3">
          
        </div>
    </form>
   </div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.js"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
  $( window ).load(function() {
    $('#Contract_investment').formatCurrency();
  });
  // $(function() {
 //    $( "#Contract_date_created" ).datepicker({
 //      changeMonth: true,
 //      changeYear: true,
 //      dateFormat: 'dd/mm/yy',
 //    });
 //  });
  $('#Contract_investment').keyup(function() { 
      if(($(this).val().trim() == null || $(this).val().trim() == "")){
               
           }else {
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,""))) {
           $('#err_vonHD').show();
           $('#err_vonHD').html("Vốn hợp đồng phải là số!");
          }else  {
             $('#err_vonHD').hide();
             if($(this).val().trim().replace(/\./g,'')<10000000){
                $('#err_vonHD').show();
                $('#err_vonHD').html("Vốn hợp đồng phải lớn hơn 10 triệu!");
             }else {
                $('#err_vonHD').hide();
             }  
            
        } 
       }
     
      });
  function format(num) {
        var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
          // if(str.indexOf(".") > 0) {
          //   parts = str.split(".");
          //   str = parts[0];
          // }
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

     