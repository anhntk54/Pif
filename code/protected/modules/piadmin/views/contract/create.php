<style type="text/css" media="screen">
.ms-ctn {
    position: relative;
    
    height: auto;
}
</style>
<div class="row">
   <div class="col-lg-12">
               
       <h1 class="page-header">Tạo mới hợp đồng</h1>
              
                
   </div>
</div>
<div class="row">
	 <div class="col-lg-3">
	 	
	 </div>
	 <div class="col-lg-6">
     
        <?php $this->renderPartial('err', array('err'=>$err)); ?>
      
	 	  <form role="form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Contract/SaveHD" method="post">
	 	       <div class="form-group">
	 	          <label for="disabledSelect">Mã hợp đồng</label>
	 	          <input class="form-control" name="maHD" id="maHD" type="text" onkeyup="checkHD(this.value)" placeholder="Để trống hệ thống sẽ tự sinh"  >
	 	       </div>
           <div class="form-group">
              <label for="disabledSelect" id="err_maHD" style="color:red; display:none;font-size: 85%;font-style: italic">Mã hợp đồng đã tồn tại!Nhập hợp đồng khác</label>
             
           </div>
	 	       <div class="form-group">
                  <label for="disabledSelect">Chọn hình thức ký hợp đồng<span style="color:red">*</span></label>
                	      <select name="htHD" class="form-control">
                	        <?php foreach ($form as $item) { ?>
                	           <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                	        <?php  } ?>
                                  
                                   
                        </select>
               </div>
               
                 <div class="form-group ">
                            <label for="disabledSelect">Chọn khách hàng<span style="color:red">*</span></label>
                            <select name="kh" required="" id="kh" class="form-control"  placeholder="Gõ tên khách hàng">
                                  <?php foreach ($cus as $item) { ?>
                	               <option value="<?php echo $item['id'] ?>"><?php echo $item['fullname']."--".$item['code']  ?></option>
                	                <?php  } ?>
                            </select>
                       <!--  <input class="form-control" name="" id="" type="text" onkeyup="getKH(this)" placeholder="Gõ và chọn khách hàng" > -->
                            
                </div>
                 <div class="form-group ">
                            <label for="disabledSelect">Số vốn đầu tư</label>
                            <div class="input-group">
                               <input class="form-control" name="vonHD" id="vonHD" type="text" placeholder="Số vốn đầu tư"  >
                               <span class="input-group-addon" id="basic-addon2">đ</span>
                            </div>
                            
                </div>
                <div class="form-group">
                            <label for="disabledSelect" id="err_vonHD" style="color:red;"></label>
                             
                </div>
                 <div class="form-group ">
                   <label for="disabledSelect">Ghi chú</label>
                   <textarea class="form-control" rows="5" id="note" name="note"></textarea>
                </div>
                 <div class="checkbox">
                                    <label>
                                        <input name="remember" id="remember" type="checkbox" checked >Gửi email thông báo và email hướng dẫn chuyển tiền tới khách hàng
                                    </label>
                </div>
                
                       <button type="submit" id="btn_hd" class="btn btn-primary">Đồng ý</button>
	 	  </form>
	 </div>
	 <div class="col-lg-3">
	 	
	 </div>
</div>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/magicsuggest.js"></script>
   <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
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
 <script>
    $(window).load(function(){
         $('#err_vonHD').hide();
         $('#err_maHD').hide();
          $('#btn_hd').prop( "disabled", false );
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
      function checkHD(hd){
         $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/CheckHD';?>',
            data:
            {
            hd:hd,
            },
           success:function(data){   
             if(data==1) {
                 $('#maHD').focus();
                 $('#err_maHD').show();
                 $('#btn_hd').prop( "disabled", true );
             }else {
               $('#btn_hd').prop( "disabled", false );
                $('#err_maHD').hide();
             }
            
           
            }
      });
      } 
      function getKH(kh){
      	 $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/GetCustomer';?>',
            data:
            {
            name:kh.value,
            },
           success:function(data){   
             // alert(data);
            //  $('#listkh').html(data);
           
       }
      });

      }
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
jQuery(function() {
    var ms = jQuery('#kh').magicSuggest({
        allowFreeEntries: false,
        selectionStacked: true,
		    maxSelection: 1,
		maxSelectionRenderer: function(v){
			return 'Đã chọn khách hàng';
		},
		selectFirst: true,
		hideTrigger: true,
		maxSuggestions: 10
    });
	jQuery(ms).on(
	  'selectionchange', function(e, cb, s){
		 getKH(cb.getValue());
	  }
	);
});
</script>