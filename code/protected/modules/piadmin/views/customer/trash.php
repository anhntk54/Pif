<?php
/* @var $this CustomerController */

$this->breadcrumbs=array(
  'Customer',
);
?>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Danh sách khách hàng <a  href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/CreateKH';?>" class="btn btn-success btn-xs">Tạo mới khách hàng</a></h1>
              
                
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
     <div class="panel panel-default">

        <div class="panel-body">
            <div class="row">
                   <form method="POST" name="filter" action="#">
                   <div class="col-lg-4">
                        <div class="form-group">
                           <input class="form-control" id="search" name="search"  placeholder="Tìm kiếm theo tên/email/sdt/mst" value="<?php echo  Yii::app()->session['search'] ?>"/>
                        </div>
                   </div>
                   <!--Created  17/08/2016-->
                   <div class="col-lg-2">
                     <button type="submit" class="btn btn-primary pull-right">Tìm kiếm</button>
                   </div>
                  </form>
               </div>
               
                <p class="count_hd">Có <b><?php echo ($item_count)  ?></b> khách hàng. </p>
                 <div class="table-responsive" style="width: 100%;">
                   <table class="table table-striped table-hover" style="font-size: 12px;">
                       <thead>
                          <tr>
                             <th>#</th>
                             <th>Họ và tên</th>
                             <th>Thông tin</th>
                             <th>Mã số thuế</th>
                             <th>Quản lý bởi</th>
                             <th>Thao tác</th>
                              
                          </tr>
                       </thead>
                       <tbody id="listkh">
                        <?php $i=1; ?>
                        <?php foreach ($data as $item) { ?>
                          <tr>
                              <td><?php echo $i++; ?></td>
                              <td >
                              <p><?php echo $item['fullname'] ?></p>
                              <p > <span style="font-size: 85%;color:#aaa;text-align: center;"><?php echo $item['code'] ?></span></p>
                              </td>
                              <td>
                                <p>
                                  <?php   echo $item['email']; ?>
                                </p>
                                 <p>
                                  <?php  echo $item['telephone']; ?>  
                                </p> 
                              </td>
                             
                              <td><?php echo $item['mst'] ?></td>
                              <td><?
                                     $admin=Admin::model()->findbyPK($item['id_admin']);
                                     echo $admin['fullname'];
                                  ?>
                               </td>
                               
                               
                              <td class="icon_action">
                                
                                <a  title="Phục hồi" onclick="refresh(<?php echo $item['id'] ?>)"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                <a  title="Xóa hẳn" onclick="Delete(<?php echo $item['id'] ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              </td>
                               
                          </tr>
                         <?php  } ?> 
                       </tbody>
                   </table>
                    
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
          
           Bạn có chắc muốn thực hiện hành động này?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delcus" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="customer_ref" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
           Bạn có chắc muốn thực hiện hành động này?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_ref" value="" />
        <button onclick="Refresh()" class="btn btn-primary">Đồng ý</button>
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
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/DeleteKHTrash' ?>', 
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
                    
               },                
           });
     }
  }
  function refresh(id) {
  		$('#customer_ref').modal('show'); 
        $('#id_ref').val(id);
  }
  function Refresh(){
   
     $('#customer_ref').modal('hide');
     var id= $('#id_ref').val(); 

     if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/Refresh' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
                    if(data==1){
                         $('#cus_info').modal('show'); 
                         $('#cus_sus').html('Phục hồi khách hàng thành công.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#cus_info').modal('show'); 
                         $('#cus_sus').html('Không phục hồi được!.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
                    
               },                
           });
     }
  }
</script>