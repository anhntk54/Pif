<div class="row">
   <div class="col-lg-12">
              
                      <h1 class="page-header">Thông tin cá nhân khách hàng <?php echo $model->fullname ?></h1>
               
   </div>
</div>
<!--Profile -->
<div class="row">
   <div class="col-lg-3">
           
        <div class="box box-primary">
               <div class="box-body box-profile">
                   <img class="profile-user-img img-responsive img-circle" src="http://members.pif.vn/templates/images/person.jpg" alt="">
                   <h3 class="profile-username text-center"><?php echo $model->fullname?></h3>
                   <ul class="list-group list-group-unbordered">
                       <li class="list-group-item">
                        <b style="font-weight: 500;">HĐ đang chờ hiệu lực</b>
                         <?php  $ct=Contract::model()->findAllByAttributes(array('id_customer' => $model['id'], 'status' =>1));
                                     $countCt=count($ct);   
                                     $ct1=Contract::model()->findAllByAttributes(array('id_customer' => $model['id'], 'status' =>2));
                                     $countCt1=count($ct1);
                                     $ct2=Contract::model()->findAllByAttributes(array('id_customer' => $model['id'], 'status' =>3));
                                     $countCt2=count($ct2);
                          ?>
                        <a class="pull-right btn btn-danger btn-circle" title="" style="<?php if($countCt ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt; ?></a>
                       </li>
                        <li class="list-group-item">
                          <b style="font-weight: 500;">HĐ đã hiệu lực</b>
                          <a class="pull-right btn btn-success btn-circle" style="<?php if($countCt1 ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt1; ?></a>
                        </li>
                        <li class="list-group-item">
                          <b style="font-weight: 500;">HĐ đã tất toán</b>
                          <a class="pull-right btn btn-info btn-circle" style="<?php if($countCt2 ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt2; ?></a>
                        </li>
                   </ul>
                   <a onclick="Delete(<?php echo $model->id ?>)"class="btn btn-primary btn-block"><b>Xóa khách hàng</b></a>
               </div>
        </div>   
             
  </div> 
  <div class="col-lg-9">
             <div class="nav-tabs-custom">
                   <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin khách hàng</a>
                        </li>
                        <li class="setting">
                            <a href="#setting" data-toggle="tab" aria-expanded="false">Cập nhật thông tin</a>
                        </li>
                    </ul> 
                    <div class="tab-content">
                        <!--Tab thông tin khách hàng -->
                        <div class="tab-pane active" id="activity">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Họ và tên</td>
                                            <td><?php echo $model->fullname; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $model->email; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td><?php echo $model->telephone; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ngày sinh</td>
                                            <td><?php echo Investment::ViewDate($model->birthday); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ</td>
                                            <td><?php echo $model->address; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Số CMND</td>
                                            <td><?php echo $model->cmt; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Ngày cấp</td>
                                            <td><?php echo Investment::ViewDate($model->cmt_datecreate); ?></td>
                                        </tr>
                                         <tr>
                                            <td>Nơi cấp</td>
                                            <td><?php echo $model->cmt_addresscreate; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Mã số thuế</td>
                                            <td><?php echo $model->mst; ?></td>
                                        </tr>
                                         <tr>
                                            <td>Số tài khoản ngân hàng</td>
                                            <td><?php echo $model->numberbank; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Chủ tài khoản ngân hàng</td>
                                            <td><?php echo $model->bankacount; ?></td>
                                        </tr>
                                         <tr>
                                            <td>Tên ngân hàng</td>
                                            <td><?php echo $model->namebank; ?></td>
                                        </tr>
                                         <tr>
                                            <td>Chi nhánh</td>
                                            <td><?php echo $model->chinhanh; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nguồn</td>
                                            <td><?php echo $model->note; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email phụ 1</td>
                                            <td><?php echo $model->email_secondary; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email phụ 2</td>
                                            <td><?php echo $model->email_third; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Lần cuối Login</td>
                                            <td><?php if(date('Y', strtotime($model->date_login))>2015) echo Contract::ViewDate($model->date_login); else echo 'Chưa đăng nhập lần nào' ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Tab cập nhật thông tin -->
                        <div class="tab-pane " id="setting">
                         <div class="panel-body" style="background-color:#fff;">
                            <div class="row">
                              <div class="col-md-12 alert alert-success" id="tt" style="display: none">
                                <span id="regsus"></span>
                              </div>
                            </div>
                            <input type="hidden" id="id" value="<?php echo  $model->id?>" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="disabledSelect">Họ và tên<span style="color:red"> *</span></label>
                                      <input class="form-control" placeholder="Họ và tên(*)" id="reg_fullname" name="fullname" type="text" value="<?php echo  $model->fullname?>">
                                    </div>
                                    <div class="form-group">
                                      <label id="err_fullname_reg" style="color: red;"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="disabledSelect">Email<span style="color:red"> *</span></label>
                                    <input class="form-control" placeholder="E-mail(*)" id="reg_email" name="email" type="text" value="<?php echo $model->email?>">
                                  </div>
                                  <div class="form-group">
                                    <label id="err_email_reg" style="color: red;"></label>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Số điện thoại</label>
                                  <input class="form-control" id="reg_telephone" value="<?php echo  $model->telephone ?>" placeholder="Số điện thoại" name="reg_telephone" type="text" >
                                </div>
                                <div class="form-group">
                                  <label id="err_telephone_reg" style="color: red;"></label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Mã số thuế cá nhân</label>
                                  <input class="form-control" id="reg_mst" value="<?php echo  $model->mst ?>" placeholder="Mã số thuế cá nhân" name="reg_mst" type="text" >
                                </div>
                                <div class="form-group">
                                  <label id="err_mst_reg" style="color: red;"></label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Ngày sinh</label>
                                  <input class="form-control datepicker" id="birthday" value="<?php if($model->birthday) echo Investment::ViewDate($model->birthday) ?>" placeholder="Ngày sinh" name="birthday" type="text" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Địa chỉ</label>
                                  <input class="form-control" id="address" value="<?php echo  $model->address ?>" placeholder="Địa chỉ" name="address" type="text" >
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="disabledSelect">Số CMTND/ Hộ Chiếu<span style="color:red"> *</span></label>
                                  <input class="form-control" placeholder="Số CMTND/Hộ chiếu *" value="<?php echo  $model->cmt?>" id="reg_cmt" name="cmt" type="text" >
                                </div>
                                <div class="form-group">
                                  <label   id="err_cmt_reg" style="color: red;"></label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="disabledSelect">Ngày cấp<span style="color:red"> *</span></label>
                                  <input class="form-control datepicker" placeholder="Ngày Cấp *" value="<?php if( $model->cmt_datecreate) { echo Investment::ViewDate($model->cmt_datecreate); }?>" id="datepicker" name="cmt_date" type="text" >
                                </div>
                                <div class="form-group">
                                  <label   id="err_cmt_date_reg" style="color: red;"></label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="disabledSelect">Nơi cấp<span style="color:red"> *</span></label>
                                  <input class="form-control" placeholder="Nơi cấp *" value="<?php echo  $model->cmt_addresscreate ?>" id="reg_cmt_address" name="reg_cmt_address" type="text" >
                                </div>
                                <div class="form-group">
                                  <label   id="err_cmt_address_reg" style="color: red;"></label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Chủ tài khoản ngân hàng</label>
                                  <input class="form-control" placeholder="Chủ tài khoản ngân hàng" value="<?php echo  $model->bankacount ?>"  id="bankacount" type="text" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Số tài khoản</label>
                                  <input class="form-control" placeholder="Số tài khoản" value="<?php echo  $model->numberbank ?>" id="numberbank"  type="text" >
                                </div>    
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Ngân hàng</label>
                                  <input class="form-control" placeholder="Chọn ngân hàng" value="<?php echo  $model->namebank ?>" id="namebank" name="namebank" type="text" >

                                </div>   
                              </div>  
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Chi nhánh</label>
                                  <input class="form-control" placeholder="Chi nhánh" value="<?php echo  $model->chinhanh ?>"  id="addressbank" type="text" >
                                </div>  
                              </div> 
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Chọn quản trị viên</label>
                                  <select  class="form-control" name="admin" id="admin">
                                   <option value="">--Chọn quản trị viên--</option>
                                   <?php foreach($admin as $item) { ?>
                                   <option value="<?php echo $item['id'] ?>" <?php if( $model->id_admin==$item['id']) echo "selected"; ?>><?php echo $item['fullname'] ?></option>
                                   <?php } ?>
                                 </select>
                               </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Nguồn</label>
                                  <input class="form-control" placeholder="Nguồn" value="<?php echo  $model->note ?>"  id="note" type="text" >
                                </div>  
                              </div> 
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Email phụ 1</label>
                                  <input class="form-control" value="<?php echo  $model->email_secondary ?>" id="reg_email_sc" placeholder="Email phụ 1" name="reg_email_sc" type="text" >
                                </div>
                                <div class="form-group">
                                  <label   id="err_email_sc_reg" style="color: red;"></label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="disabledSelect">Email phụ 2</label>
                                  <input class="form-control" id="reg_email_tr" value="<?php echo  $model->email_third ?>" placeholder="Email phụ 2" name="reg_email_tr" type="text" >
                                </div>
                                <div class="form-group">
                                  <label   id="err_email_tr_reg" style="color: red;"></label>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <button onclick="reg()" class="btn btn-primary">Cập nhật</button>     
                              </div> 
                            </div>

             </div>
           </div>
                    </div>
            </div>    
  </div>           
</div> 
<!--Modal Kết quả -->
<div class="modal fade" id="cus_info" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
        <div id="cus_sus">
            
          </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" id="id_hd" value="" />
      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
     
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="customer_del" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
           Bạn có chắc muốn xóa khách hàng này không ?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delcus" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
function Delete(id) {
       $('#customer_del').modal('show'); 
        $('#id_delcus').val(id);

  }
 function DeleteHD(){
   
     $('#customer_del').modal('hide');
     var id= $('#id_delcus').val(); 

     if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/DeleteKH' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
                    if(data==1){
                         $('#cus_info').modal('show'); 
                         $('#cus_sus').html('Đã xóa khách hàng  thành công.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#cus_info').modal('show'); 
                         $('#cus_sus').html('Không xóa được!.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
                    if(data==2){
                      $('#cus_info').modal('show'); 
                         $('#cus_sus').html('Không thể xóa khách hàng vì khách hàng còn hợp đồng trên hệ thống.');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
               },                
           });
     }
  }  
</script>     
<!--Code update -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
 $(window).load(function(){
         $('#err_email_reg').hide();
         $('#err_password_reg').hide();
         $('#err_email_sc_reg').hide();
         $('#err_email_tr_reg').hide();
         $('#err_mst_reg').hide();
         $('#err_telephone_reg').hide();
         $('#err_fullname_reg').hide();
         $('#err_cmt_reg').hide();
          $('#err_cmt_date_reg').hide();
         $('#err_cmt_address_reg').hide();
          $('#tt').hide();
        
     });
 //Đăng ký
      function reg(){ 
          var email=  $('#reg_email').val();
          var password=  $('#reg_password').val();
          var email_sc= $('#reg_email_sc').val(); 
          var email_tr= $('#reg_email_tr').val(); 
          var mst= $('#reg_mst').val();
          var telephone= $('#reg_telephone').val();
          var address= $('#address').val();
          var birthday= $('#birthday').val();
          var fullname=$('#reg_fullname').val();
          var cmt=$('#reg_cmt').val();
          var cmt_date=$('#datepicker').val();
          var cmt_addrress=$('#reg_cmt_address').val();
          var numberbank=$('#numberbank').val();
          var namebank=$('#namebank').val();
          var addressbank=$('#addressbank').val();
           var bankacount=$('#bankacount').val();
           var note=$('#note').val();
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
           if(email.length>0 && IsEmail(email)==true && fullname.length>0) {
               $.ajax({   
                   type: "POST",
                    url: '<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/UpdateInfo';?>',
                    data:
                     {
                        email:email,
                        email_sc:email_sc,
                        email_tr:email_tr,
                        mst:mst,
                        telephone:telephone,
                        address:address,
                        birthday:birthday,
                        fullname:fullname,
                        cmt:cmt,
                        cmt_date:cmt_date,
                        cmt_addrress:cmt_addrress,
                        numberbank:numberbank,
                        namebank:namebank,
                        addressbank:addressbank,
                         bankacount:bankacount,
                         note:note,
                        id:$('#id').val(),
                         reg_password:$('#reg_password').val()
                     },
                     success: function (result)
                        {
                           
                            if(result==0){
                               $("#divLoading").addClass('show');
                               $("#tt").show();
                               $("#tt").addClass('alert alert-danger');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#regsus').html('Cập nhật không thành công! Vui lòng kiểm tra lại!');  
                             }, 2000);
                         }
                          if(result==1){
                           // $("#divLoading").addClass('show');
                               $('#tt').show();
                               $('#regsus').html('Cập nhật thông tin cá nhân  thành công! Sau 5s hệ thống sẽ tải lại');
                                setTimeout(function() {
                                     // $("#divLoading").removeClass('show')   
                                    // window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';  
                                     window.location.href='<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer'; ?>';
                             }, 5000);
                                
                            }
                        },
                     error: function(err){
           
                      }
               } );
           }

      }
  // /*Check Email đã tồn tại hay chưa*/
  //  $('#reg_email').focusout(function() { 
  //       var email=$('#reg_email').val();
  //        $.ajax({
  //            type:"POST", 
  //            url:'<?php echo Yii::app()->request->baseUrl.'/Register/CheckEmail';?>',
  //           data:
  //           {
  //           email:email
  //           },
  //          success:function(data){   
  //            if(data==1){
  //                   $("#divLoading").addClass('show');
  //                              setTimeout(function() {
  //                                    $("#divLoading").removeClass('show')   
  //                                    $('#regsus').html('Email này đã được đăng ký!Vui lòng chọn Email khác');  
  //                                    $('#reg_email').focus();
  //                            }, 2000);
                  
  //            }else{
                  
  //            }
            
  //      }
  //     });
  //   });    
 /**
  Kiểm tra Email
 */
  $('#reg_email').focusout(function() {
            if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){
               $('#err_email_reg').show();  
               $('#err_email_reg').html('Email không được để trống');
              $(this).focus();
            }else{
               $('#err_email_reg').hide();
               if(IsEmail($(this).val())==false){
                 $('#err_email_reg').show(); 
                 $('#err_email_reg').html('Email không đúng định dạng!');
                 $(this).focus();
             }else{
                $('#err_email_reg').hide();
             }
          } 
             
         });
  /*Kiểm tra mật khẩu*/
   $('#reg_password').focusout(function() { 
         if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
              $('#err_password_reg').show();
              $('#err_password_reg').html("Mật khẩu không được để trống");
              $(this).focus();
         }else {
             $('#err_password_reg').hide();
              if($(this).val().trim().length <=6) {
                   $('#err_password_reg').show();
                   $('#err_password_reg').html("Mật khẩu không được ngắn hơn 6");
                   $(this).focus();
              }else {
                 $('#err_password_reg').hide();
              }
         }
   }); 
   /*Kiểm tra Email phụ*/
    // $('#reg_email_sc').focusout(function() { 
    //     if(($(this).val().trim().length != 0)) {
    //      if(IsEmail($(this).val())==false){
    //              $('#err_email_sc_reg').show(); 
    //              $('#err_email_sc_reg').html('Email không đúng định dạng!');
    //              $(this).focus();
    //          }else{
    //             $('#err_email_sc_reg').hide();
    //          }
    //     }
    // });  
    // /*Kiểm tra Email phụ*/
    // $('#reg_email_tr').focusout(function() { 
    //     if(($(this).val().trim().length != 0)) {
    //      if(IsEmail($(this).val())==false){
    //              $('#err_email_tr_reg').show(); 
    //              $('#err_email_tr_reg').html('Email không đúng định dạng!');
    //              $(this).focus();
    //          }else{
    //             $('#err_email_tr_reg').hide();
    //          }
    //     }
    // });  
    
    /*Kiểm tra họ tên*/
      $('#reg_fullname').focusout(function() { 
          if(($(this).val().trim().length == 0 || $(this).val().trim() == " ")){ 
               $('#err_fullname_reg').show();
                $('#err_fullname_reg').html("Họ tên không được trống!");
                $(this).focus();
          }else{
             $('#err_fullname_reg').hide();
          }
    });
    
     
 // Hàm check validate
 function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }   
  function validatePhone(txtPhone) {
       var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
       if (!filter.test(txtPhone)) {
        return false;
        }else {
        return true;
      }
      }      
 $(function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'dd/mm/yy',
    yearRange: "1970:+nn"
    });
  });
 </script>    