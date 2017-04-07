<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Thêm quản trị viên</h1>
              
                
   </div>
</div>
<div class="row">
	<div class="col-lg-3">
		<div id="divLoading">
			
		</div>
	</div>
	<div class="col-lg-6">
	    <form role="form" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Admin/SaveAD" method="post" id="form-admin">
	       
	 	   <div class="form-group has-feedback" id="divEmail">
	 	          <label for="disabledSelect">Email<span style="color:red">*</span></label>
	 	          <input class="form-control" name="ad_email" id="ad_email" type="email" required placeholder="Email"  >
	 	          <span id="divEmailErr" class="glyphicon  form-control-feedback" aria-hidden="true"></span>
	 	   </div>
	 	   <div class="form-group">
	 	          <label for="disabledSelect" id="err_ad_email" style="display: none;" class="error">Email đã tồn tại trong cơ sở dữ liệu</label>
	 	         
	 	   </div>
	 	    
	 	   <div class="row">
		 	    <div class="col-lg-8" id="input_pass_ad">
		 	    	 <div class="form-group">
		 	          <label for="disabledSelect">Mật khẩu<span style="color:red">*</span></label>
		 	          <input class="form-control" name="ad_password" id="ad_password" type="password" value="<?php echo $pass ?>" required placeholder="Số điện thoại"  >
		 	        </div>
		 	    </div>
		 	    <div class="col-lg-4">
		 	    	<div class="form-group" id="input_show_pass">
		 	    	   <input id="test2" type="checkbox"  />Hiển thị mật khẩu
		 	    	</div>
		 	    </div>
		 	</div> 
		 	<div class="form-group has-feedback" id="divEmail">
	 	          <label for="disabledSelect">Email để gửi thông báo và hướng dẫn chuyển tiền</label>
	 	          <input class="form-control" name="ad_email_send" id="ad_email_send" type="email"  placeholder="Email để gửi thông báo và hướng dẫn chuyển tiền"  >
	 	   </div>
	 	   <div class="form-group">
	 	          <label for="disabledSelect" id="err_ad_email_send" style="display: none;" class="error">Email không đúng định dạng</label>

	 	         
	 	   </div>
	 	    <div class="form-group">
	 	      <label for="disabledSelect">Mật khẩu email gửi thông báo</label>
	 	      <input class="form-control" name="ad_password_send" id="ad_password_send" type="password"  placeholder="Mật khẩu email gửi thông báo"  >
	 	    <div>

	 	   <div class="form-group">
	 	          <label for="disabledSelect">Họ và tên<span style="color:red">*</span></label>
	 	          <input class="form-control" name="ad_fullname" id="ad_fullname" type="text" required placeholder="Họ và tên"  >
	 	   </div>
	 	   <div class="form-group">
	 	          <label for="disabledSelect">Số điện thoại</label>
	 	          <input class="form-control" name="ad_telephone" id="ad_telephone" type="text" placeholder="Số điện thoại"  >
	 	   </div>
	 	   
	 	    <div class="form-group">
	 	          <label for="disabledSelect">Quyền</label>
	 	          <select name="ad_role" class="form-control">
	 	             <option value="1">Admin</option>
	 	             <option value="2">Manager</option>
	 	             <option value="3">CSKH</option>
	 	             <option value="4">Báo cáo</option>
	 	          </select>
	 	   </div>
	 	   <div class="form-group">
	 	      <label for="disabledSelect">Chữ ký Email(Dùng để gửi email hướng dẫn chuyển tiền)</label>
	 	       <?php
                $this->widget('application.extensions.ckeditor.CKEditor', array(
                  'name'=>'signature',
                  'language' => 'vi',
                  'width'=>'500px',
                  'theme' => 'default',
                   'editorTemplate' => 'full',));
                ?>
	 	   </div>
	 	    <button type="submit" id="btn_admin" class="btn btn-primary">Đồng ý</button>
	    </form>
		
	</div>
	<div class="col-lg-3">
		
	</div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.validate.min.js"></script>
<script>
	$(document).ready(function() {
		$("#form-admin").validate({ 
			rules: { 
				ad_email: {
					required: true,
					email: true,
				},
		        ad_password : {
		        	required: true,
		        },
		        ad_fullname : {
		        	required: true,
		        },
		        ad_email_send : {
		        	email: true,
		        }
		       		
			},
			messages: { 
				ad_email: {
					required: "Bạn phải nhập Email",
					email:"Email không đúng định dạng",
					
				},
				 ad_password : {
		        	required: "Bạn phải nhập Password",
		        	
		        },
		        ad_fullname : {
		        	required: "Bạn phải nhập họ tên ",
		        },
		         ad_email_send : {
		        	email:"Email không đúng định dạng",
		        }
		        	
			}

		});

	});

</script>
 <script type="text/javascript">
 $(window).load(function(){
         $('#err_ad_email').hide();
         
     });
  /*Check Email đã tồn tại hay chưa*/
   $('#ad_email').focusout(function() { 
        var email=$('#ad_email').val();
        if(email.length >0 ){
        	   $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Admin/CheckEmail';?>',
            data:
            {
            email:email
            },
           success:function(data){   
             if(data==1){
             	     $( "#divEmail" ).removeClass( "has-success" ).addClass( "has-error" );
                     $( "#divEmailErr" ).removeClass( "glyphicon-ok" ).addClass("glyphicon-remove");
                    $('#err_ad_email').show();
                 }else{
                     $( "#divEmail" ).removeClass( "has-error" ).addClass( "has-success" );
                   $( "#divEmailErr" ).removeClass( "glyphicon-remove" ).addClass("glyphicon-ok");
                     $('#err_ad_email').hide();
                }
            
       }
      });
        }
    });  
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
    field: '#ad_password',
    control: '#test2'
});
</script>