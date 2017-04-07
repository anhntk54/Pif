<style>
.error {
    font-size: 85%;
    font-style: italic;
    color: red;
    font-weight: 500;
	}
#err_iv_totaltk {
	display: none;
}
#err_iv_totaldvdt {
	display: none;
}
#err_iv_onedvdt {
	display: none;
}		
</style>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Sửa đơn vị đầu tư</h1>
              
                
   </div>
</div>
<div class="row">
 <?php if($sus==1){ ?>
   <div class="col-lg-12 alert alert-success">
     <p>Cập nhật đơn vị đầu tư thành công.Nhấn <a href="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Investment" title="">tại đây </a> để quay về trang danh sách đơn vị đầu tư</p>
   </div>
  <?php } ?> 
  <!--  <div class="col-lg-12 alert alert-danger">
     <p>Cập nhật hợp đồng thất bại!</p>
   </div> -->
</div>
<div class="row">
  <div class="col-lg-4">
		<div id="divLoading">
			
		</div>
  </div>
  <div class="col-lg-4">
      <form role="form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Investment/Editss/id/<?php echo $model->id ?>" method="post" id="investment-form">
        <div class="form-group">
          <label for="disabledSelect">Ngày<span style="color:red"> *</span></label>
          <input class="form-control" name="Investment[date]" id="iv_date" type="text" value="<?php echo Investment::ViewDate($model->date) ?>" placeholder="Ngày" required >

        </div>
        <div class="form-group">
          <label for="disabledSelect">Tổng giá trị tài sản tài khoản kinh doanh<span style="color:red"> *</span></label>
          <input class="form-control" name="Investment[tongtkkinhdoanh]" id="iv_totaltk" type="text" value="<?php echo $model->tongtkkinhdoanh ?>"  placeholder="Tổng giá trị tài sản tài khoản kinh doanh"  required>
           <label  id="err_iv_totaltk" class="error"></label>
        </div>
        <div class="form-group">
          <label for="disabledSelect">Tổng số lượng ĐVĐT<span style="color:red"> *</span></label>
          <input class="form-control" name="Investment[tongdvdt]" id="iv_totaldvdt" type="text" value="<?php echo $model->tongdvdt ?>" placeholder="Tổng số lượng ĐVĐT"  required>
           <label  id="err_iv_totaldvdt" class="error"></label>
        </div>
         <div class="form-group">
          <label for="disabledSelect">Giá trị 1 ĐVĐT<span style="color:red"> *</span></label>
          <input class="form-control" name="Investment[motdvdt]" id="iv_onedvdt" type="text" value="<?php echo $model->motdvdt ?>" placeholder="Giá trị 1 ĐVĐT"  required>
          <label  id="err_iv_onedvdt" class="error"></label>
        </div>
         <button type="submit" id="btn_admin" class="btn btn-primary">Cập nhật</button>
      </form>
  </div>
  <div class="col-lg-4">
  	
  </div>
</div>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.validate.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
<script>
$(window).load(function(){
         $('#iv_totaltk').formatCurrency();
         $('#iv_totaldvdt').formatCurrency();
         $('#iv_onedvdt').formatCurrency();
     });
	$(document).ready(function() {
		$("#investment-form").validate({ 
			rules: { 
				iv_date: {
					required: true,
					
				},
		        iv_totaltk : {
		        	required: true,
		        },
		        iv_totaldvdt : {
		        	required: true,
		        },
		        iv_onedvdt : {
		        	required: true,
		        },		
			},
			messages: { 
				iv_date: {
					required: "Bạn phải nhập ngày tháng",
					
				},
				 iv_totaltk : {
		        	required: "Bạn phải nhập Tổng giá trị tài sản tài khoản kinh doanh ",
		        	
		        },
		        iv_totaldvdt : {
		        	required: "Bạn phải nhập tổng số lượng ĐVĐT ",
		        },
		         iv_onedvdt : {
		        	required: "Bạn phải nhập giá trị ĐVĐT ",
		        },		
			}

		});

	});

</script>
<script>
 $('#iv_totaltk').keyup(function() { 
		 if(($(this).val().trim() == null || $(this).val().trim() == "")){ 
           }else {
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,''))) {
               $('#err_iv_totaltk').show();
               $('#err_iv_totaltk').html("Tổng giá trị tài sản tài khoản kinh doanh phải là số!");
              
          }else  {
             $('#err_iv_totaltk').hide();
             updateTotal();
        } 
       }
		 
      });
  $('#iv_totaldvdt').keyup(function() { 
		 if(($(this).val().trim() == null || $(this).val().trim() == "")){ 
           }else {
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,''))) {
               $('#err_iv_totaldvdt').show();
               $('#err_iv_totaldvdt').html("Tổng số lượng ĐVĐT phải là số!");
              
          }else  {
             $('#err_iv_totaldvdt').hide();
             updateTotal();
        } 
       }
		 
      });
   $('#iv_onedvdt').keyup(function() { 
		 if(($(this).val().trim() == null || $(this).val().trim() == "")){ 
           }else {
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,''))) {
               $('#err_iv_onedvdt').show();
               $('#err_iv_onedvdt').html("Giá trị ĐVĐT phải là số!");
              
          }else  {
             $('#err_iv_onedvdt').hide();
            
        } 
       }
		 
      });
 // tính giá trị 1 đơn vị đầu tư
   function updateTotal() {
    var input1 = parseInt($('#iv_totaltk').val().trim().replace(/\./g,''));
    var input2 = parseInt($('#iv_totaldvdt').val().trim().replace(/\./g,''));
    var total=input1/input2;
    $('#iv_onedvdt').val(format(Math.round(total,0)));

  }  
// ngày tạo đơn vị đầu tư
$(function() {
    $( "#iv_date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
    });
  });
// format tiền
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
