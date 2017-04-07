<style>
.error {
    font-size: 85%;
    font-style: italic;
    color: red;
    font-weight: 500;
  }

#err_iv_onedvdt {
  display: none;
}   
</style>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Sửa hiệu quả đầu tư</h1>
              
                
   </div>
</div>
<div class="row">
 <?php if($sus==1){ ?>
   <div class="col-lg-12 alert alert-success">
     <p>Cập nhật hiệu quả đầu tư thành công.Nhấn <a href="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Investeffect" title="">tại đây </a> để quay về trang danh sách hiệu quả đầu tư</p>
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
      <form role="form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Investeffect/Editss/id/<?php echo $model->id ?>" method="post" id="investeffects-form" enctype="multipart/form-data">
        <div class="form-group">
          <label for="disabledSelect">Ngày<span style="color:red"> *</span></label>
          <input class="form-control" name="Investeffects[date]" id="iv_date" type="text" value="<?php echo Investment::ViewDate($model->date) ?>" placeholder="Ngày" required >

        </div>
         <div class="form-group">
          <label for="disabledSelect">Giá trị 1 ĐVĐT<span style="color:red"> *</span></label>
          <input class="form-control" name="Investeffects[motdvdt]" id="iv_onedvdt" type="text" value="<?php echo $model->motdvdt ?>" placeholder="Giá trị 1 ĐVĐT"  required>
          <label  id="err_iv_onedvdt" class="error"></label>
        </div>
         <div class="form-group">
         <label for="disabledSelect">File</label></br>
           <?php if($model->file){?>
            <span id="file_name"><i class='fa fa-file-pdf-o'></i> <?php echo substr(strrchr($model->file, "/"), 1); ?></span> 
            <?php } ?>
            <input type="file" class="form-control" name="file"  id="file" />
         </div>
          <!-- <div class="form-group">
            <label for="disabledSelect">File thứ hai</label></br>
            <?php if($model->file_one){?>
              <span id="file_name01"><i class='fa fa-file-pdf-o'></i> <?php echo substr(strrchr($model->file_one, "/"), 1); ?></span> 
              <?php } ?>
            <input type="file" class="form-control" name="Investeffects[file_one]" id="fileone" />
         </div>
          <div class="form-group">
            <label for="disabledSelect">File thứ ba</label></br>
            <?php if($model->file_sc){?>
              <span id="file_name02"><i class='fa fa-file-pdf-o'></i> <?php echo substr(strrchr($model->file_sc, "/"), 1); ?></span> 
              <?php } ?>
            <input type="file" class="form-control" name="Investeffects[file_sc]"  id="filesc" placeholder="<?php echo substr(strrchr($model->file_sc, "/"), 1); ?>"/>
         </div> -->
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
 $('#iv_onedvdt').formatCurrency();
 // $('#file').hide();
 // $('#fileone').hide();
 // $('#filesc').hide();
});
 $(document).ready(function() {
    $("#investments-form").validate({ 
      rules: { 
        iv_date: {
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
      
             iv_onedvdt : {
              required: "Bạn phải nhập giá trị ĐVĐT ",
            },    
      }

    });

  });
</script>
<script>
//kiểm tra giá 1 đơn vị đầu tư
//Nếu khác null thì kiểm tra xem có phải là số hay không
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