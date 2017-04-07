<div id="divLoading"></div>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Sửa hợp đồng số <?php echo $model->number_form ?>
      <div class="pull-right small">
        <a class="btn btn-xs btn-default" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/Review/id/'.$model->id; ?>" ><i class="fa fa-search" aria-hidden="true"></i> Xem hợp đồng</a>
        <a class="btn btn-xs btn-default" onclick="printDocFileCompleted('<?php echo $model->id ?>')"><i class="fa fa-file-word-o" aria-hidden="true"></i> Tải biên bản tất toán</a>
        <a class="btn btn-xs btn-default" onclick="sendFileCompleted('<?php echo $model->id ?>')"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gửi email biên bản tất toán</a>
      </div>
    </h1>
  </div>
</div>
<div id="content_print" style="display: none"></div>
<div id="sendFileCompleted_success" style="display: none;">
  <div class="col-lg-12 alert alert-success">
    <p><i class="fa fa-check"></i> <span id="sendFileCompleted_message"></span></p>
  </div>
</div>
<div class="row">
 <?php if($sus==1){ ?>
   <div class="col-lg-12 alert alert-success">
     <p>Cập nhật hợp đồng thành công. Nhấn <a href="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Contract" title="">tại đây </a> để quay về trang danh sách hợp đồng</p>
   </div>
  <?php } ?> 
  <!--  <div class="col-lg-12 alert alert-danger">
     <p>Cập nhật hợp đồng thất bại!</p>
   </div> -->
</div>
<div class="row" style="margin-bottom: 10%;">
<div class="col-lg-4 ">

 </div>
 <div class="col-lg-4">
 <form role="form" id="contract-form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Contract/Editss/id/<?php echo $model->id ?>" method="post">
     <div class="form-group">
      <label for="disabledSelect">Loại hợp đồng</label>
      <select name="Contract[id_form]" id="Contract_id_form" class="form-control">
       <?php foreach ($form as $item) { ?>
       <option <?php if($model->id_form==$item['id']) echo "selected" ?> value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
       <?php  } ?>

     </select>
   </div>
   <div class="form-group">
    <label for="disabledSelect">Vốn hợp tác kinh doanh</label>
    <input class="form-control" name="Contract[investment]" id="Contract_investment" type="text" value="<?php echo $model->investment  ?>"  >
    <label for="disabledSelect"  id="err_vonHD" style="display: none;font-size: 85%;color: red;font-weight: 500;"></label>
  </div>

  <div class="form-group">
    <label for="disabledSelect">Trạng thái</label>
    <select name="Contract[status]" id="Contract_status" class="form-control" >
      <?php if($model->status!=2 && $model->status!=3){ ?>
      <option value="1" <?php if($model->status==1) echo "selected" ?>>Chờ chốt số</option>
      <?php } ?>
      <?php if($model->status!=3 ){ ?>
      <option value="2" <?php if($model->status==2) echo "selected" ?>>Đang hiệu lực</option>
      <?php } ?>
      <option value="3" <?php if($model->status==3) echo "selected" ?>>Đã tất toán</option>
    </select>
  </div>
  <div class="row">
   <div class="col-lg-12" >
     <div class="form-group">
      <label for="disabledSelect">Ngày ký hợp đồng</label>
      <input class="form-control" name="Contract[date_modified]" id="Contract_date_modified" type="text" value="<?php if($model->date_modified) {echo Investment::ViewDate($model->date_modified) ;}else {echo Investment::ViewDate($model->date_created) ; } ?>"  >
    </div>
  </div>
	 	    <!--  <div class="col-lg-6">
	 	     	<div class="form-group">
	 	           <label for="disabledSelect">Ngày kết thúc</label>
	 	           <input class="form-control" name="date_fs" id="date_fs" type="text">
	 	        </div>
          </div> -->
        </div>
        <div class="form-group ">
         <label for="disabledSelect">Ghi chú</label>
         <textarea class="form-control" rows="5" id="Contract_note" name="Contract[note]"><?php echo $model->note; ?></textarea>
       </div>
       <div class="checkbox">
        <label id="remember_box" style="display: none;">
          <input name="remember" id="remember" type="checkbox">Gửi email cảm ơn tới khách hàng
        </label>
        <label id="eCompleted_box" style="display: none;">
          <input name="eCompleted" id="eCompleted" type="checkbox">Gửi thông báo tất toán thành công
        </label>
      </div>
      <button type="submit" id="btn_hdup" class="btn btn-primary">Đồng ý</button>
    </form>
    </div>  
  <div class="col-lg-4">

  </div>
</div>
	 
<script>
  $("form").submit(function () {

    var this_master = $(this);

    this_master.find('input[type="checkbox"]').each( function () {
        var checkbox_this = $(this);


        if( checkbox_this.is(":checked") == true ) {
            checkbox_this.attr('value','1');
        } else {
            checkbox_this.prop('checked',true);
            //DONT' ITS JUST CHECK THE CHECKBOX TO SUBMIT FORM DATA    
            checkbox_this.attr('value','0');
        }
    })
})
</script>
<script type="text/javascript">
$(document).ready(function(){
  if($("#Contract_status").val()=="2"){
    $("#remember_box").show();
  }else if($("#Contract_status").val()=="3"){
    $("#eCompleted_box").show();
  }else {
    $("#remember_box").hide();
    $("#eCompleted_box").hide();
  }
  $("#Contract_status").on('change', function(){
    if($(this).val()=="2"){
      $("#remember_box").show();
      $("#eCompleted_box").hide();
    }else if($(this).val()=="3"){
      $("#remember_box").hide();
      $("#eCompleted_box").show();
    }else {
      $("#remember_box").hide();
      $("#eCompleted_box").hide();
    }
  });
});

$(window).load(function(){
         $('#Contract_investment').formatCurrency();
     });
	$(function() {
    $( "#Contract_date_modified" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
    });
  });
	$(function() {
    $( "#date_fs" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy-mm-dd',
    });
  });
	 $('#Contract_investment').keyup(function() { 
		 if(($(this).val().trim() == null || $(this).val().trim() == "")){ 
		 	   $('#err_vonHD').show();
               $('#err_vonHD').html("Không được để trống!");
           }else {
           	$('#err_vonHD').hide();
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,''))) {
               $('#err_vonHD').show();
               $('#err_vonHD').html("Vốn hợp đồng phải là số!");
               
          }else  {
             $('#err_vonHD').hide();
             $('#btn_hd').prop( "disabled", false );
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
<script>
  function printDocFileCompleted(id) {
    $("#divLoading").addClass('show');
    $.ajax({
      type:"POST", 
      url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/printFileCompleted';?>',
      data:{
        id:id,
      },
      success:function(data){
        setTimeout(function() {
          $("#divLoading").removeClass('show')   
          var obj=jQuery.parseJSON(data);
          $("#content_print").html(obj.content);
          $("#content_print").wordExport(obj.name);
        },1000);

      },
      error: function (request, error) {
        alert("Lỗi không xuất được file word."+error);
      }
    });
  }
  function sendFileCompleted(id) {
    $("#divLoading").addClass('show');
    $.ajax({
      type:"POST", 
      url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/sendFileCompleted';?>',
      data:{
        id:id,
      },
      success:function(data){
        setTimeout(function() {
          $("#divLoading").removeClass('show');
          $("#sendFileCompleted_success").show();
          $("#sendFileCompleted_message").html(data);
        },1000);

      },
      error: function (request, error) {
        alert("Lỗi không gửi được biên bản tất toán."+error);
      }
    });
  }
</script>