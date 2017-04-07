<style type="text/css" media="screen">
	
</style>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Sửa thông tin quản trị viên</h1>
              
                
   </div>
</div>
<div class="row">
  <div class="col-lg-3">
		<div id="divLoading">
			
		</div>
 </div>
 <div class="col-lg-6">
 	 <form role="form" id="admin-form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Admin/Edits/id/<?php echo $model->id ?>" method="post">
 	    <div class="form-group">
	 	         <label for="disabledSelect">Email</label>
	 	         <input class="form-control" name="Admin[email]" id="Admin_email" type="email" value="<?php echo $model->email ?>"  >
	    </div>
	    
	     <div class="row">
	            <div class="col-lg-4" style="margin-top: 25px;">
	                <div class="form-group">
	            	<a class="btn btn-default" onclick="GenPass()" >Tạo mật khẩu mới</a>
	            	 </div>
	            </div>
		 	    <div class="col-lg-5" id="input_pass_admin" >
		 	    	 <div class="form-group">
		 	          <label for="disabledSelect">Mật khẩu</label>
		 	          <input class="form-control" name="Admin[password]" id="Admin_password" type="password" value="<?php echo $model->password ?>" >
		 	        </div>
		 	    </div>
		 	    <div class="col-lg-3" id="check_admin" >
		 	    	<div class="form-group" id="input_show_pass">
		 	    	   <input id="test2" type="checkbox"  />Hiển thị 
		 	    	</div>
		 	    </div>
		 	</div>  
		   <div class="form-group">
	 	         <label for="disabledSelect">Email để gửi thông báo và hướng dẫn chuyển tiền</label>
	 	         <input class="form-control" name="Admin[email_send]" id="Admin_email_send" type="email" value="<?php echo $model->email_send ?>"  >
	      </div>
	      <div class="form-group">
	      		  <label for="disabledSelect">Mật khẩu email gửi thông báo</label>
	      		  <input class="form-control" name="Admin[pass_email]" id="Admin_pass_email" type="password" value="<?php echo $model->pass_email ?>" placeholder="Mật khẩu email gửi thông báo"  >
	      </div>	
		  <div class="form-group">
	 	         <label for="disabledSelect">Họ và tên</label>
	 	         <input class="form-control" name="Admin[fullname]" id="Admin_fullname" type="text" value="<?php echo $model->fullname ?>"  >
	     </div>	 
	     <div class="form-group">
	 	         <label for="disabledSelect">Số điện thoại</label>
	 	         <input class="form-control" name="Admin[telephone]" id="Admin_telephone" type="text" value="<?php echo $model->telephone ?>"  >
	     </div>	
	      <div class="form-group">
	 	          <label for="disabledSelect">Quyền</label>
	 	          <select name="Admin[role]" id="Admin_role" class="form-control">
	 	             <option value="1" <?php if($model->role==1) echo "selected" ?> >Admin</option>
	 	             <option value="2" <?php if($model->role==2) echo "selected" ?>>Manager</option>
	 	             <option value="3" <?php if($model->role==3) echo "selected" ?>>CSKH</option>
	 	             <option value="4" <?php if($model->role==4) echo "selected" ?>>Báo cáo</option>
	 	          </select>
	 	   </div>
	 	    <div class="form-group">
	 	      <label for="disabledSelect">Chữ ký Email(Dùng để gửi email tự động hướng dẫn chuyển tiền)</label>
	 	      <?php
                $this->widget('application.extensions.ckeditor.CKEditor', array('model' => $model,
                'attribute' => 'signature',
                'language' => 'vi',
                'width'=>'500px',
                'theme' => 'default',
                'editorTemplate' => 'full',));
           ?>
	 	   </div>
	 	    <button type="submit" id="btn_upadmin" class="btn btn-primary">Đồng ý</button>
 	 </form>
 </div>
 <div class="col-lg-6">
 	
 </div>
</div>
<script >
     $(window).load(function(){
         $('#input_pass_admin').hide();
         $('#check_admin').hide();
     });
	function GenPass()  {
		$('#input_pass_admin').show();
		 $('#check_admin').show();
		 $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Admin/GenPass';?>',
           success:function(data){   
            $('#Admin_password').val(data);
             
           }
      });
	}
</script>
<script>
	//Place this plugin snippet into another file in your applicationb
(function ($) {
    $.toggleShowPassword = function (options) {
        var settings = $.extend({
            field: "#password",
            control: "#toggle_show_password",
        }, options);

        var control = $(settings.control);
        var field = $(settings.field)

        control.bind('click', function () {
            if (control.is(':checked')) {
                field.attr('type', 'text');
            } else {
                field.attr('type', 'password');
            }
        })
    };
}(jQuery));

//Here how to call above plugin from everywhere in your application document body
$.toggleShowPassword({
    field: '#Admin_password',
    control: '#test2'
});
</script>