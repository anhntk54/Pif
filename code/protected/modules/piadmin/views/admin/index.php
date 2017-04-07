<?php
/* @var $this AdminController */

$this->breadcrumbs=array(
  'Admin',
);
?>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Danh sách quản trị viên 
                         <?php if(Yii::app()->session['adrole']==1){ ?>
                       <a  href="<?php  echo Yii::app()->createUrl("/piadmin/Admin/Createad") ?>" class="btn btn-success btn-xs">Thêm mới tài khoản</a>
                      <?php } ?>

                      </h1>
                      
                
   </div>
</div>
<div class="row">
      
      <div class="col-lg-12">
        <div class="panel panel-default">
           
             <div class="panel-body">
               <div class="row">
                    <form method="POST" name="filter" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Admin/Filter">
                   <div class="col-lg-3">
                        <div class="form-group">
                           <input class="form-control" id="adsearch" name="adsearch" placeholder="Tìm kiếm quản trị viên" value="<?php echo Yii::app()->session['adsearch'] ?>" />
                        </div>

                   </div>
                   <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                  </form>
                  
               </div>
                <p class="count_hd">Có <b><?php echo $item_count  ?></b> quản trị viên.</p>
                 <div class="table-responsive">
                   <table class="table table-hover">
                       <thead>
                          <tr>
                             <th>#</th>
                             <th>Email</th>
                             <th>Số điện thoại</th>
                             <th>Họ Tên</th>
                             <th>Quyền </th>
                              <th>Email phụ </th>
                             <th>Thao tác</th>
                          </tr>
                       </thead>
                       <tbody >
                        <?php $i=1; ?>
                        <?php foreach ($data as $item) { ?>
                          <tr>
                              <td><?php echo $i++; ?></td>
                              <td><?php echo  $item['email'] ?></td>
                              <td>
                                 <?php echo $item['telephone'] ?>
                              </td>
                              <td>
                                 <?php 
                                     echo $item['fullname'];
                                  ?>
                              </td>
                              <td>
                                <?php 
                                  switch ($item['role']) {
                                    case '1': echo "Admin"; break;
                                    case '2': echo "Manager"; break;
                                    case '3': echo "CSKH"; break;
                                    case '4': echo "Báo cáo"; break;
                                  }
                                ?>
                              </td>
                              <td>
                                <?php 
                                     echo $item['email_send'];
                                 ?>
                              </td>
                              <td class="icon_action">
                                <?php if($item['role']!=1 && Yii::app()->session['adid']==$item['id'] || Yii::app()->session['adrole']==1 &&Yii::app()->session['adid']!=$item['id']){ ?> 
                           
                                <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Admin/Edits/id/'.$item['id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                <a style="cursor: pointer;text-decoration: underline;" onclick="DelAdmin(<?php echo $item['id'] ?>)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                 
                                <?php } ?>
                                <?php if(Yii::app()->session['adid']==$item['id'] && $item['role']==1 ) { ?>
                                  
                                  <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Admin/Edits/id/'.$item['id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                <?php } ?>
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
<div class="row">
   <div class="col-lg-12">
   <?php
          $this->widget('CLinkPager', array(
              'currentPage' => $pages->getCurrentPage(),
              'itemCount' => $item_count,
              'pageSize' => $page_size,
              'maxButtonCount' => 5,
              'header' => '',
              'firstPageLabel' => '|<',
              'prevPageLabel' => '<<',
              'nextPageLabel' => '>>',
              'lastPageLabel' => '>|',
              'htmlOptions'=>array(
                    'class'=>'pagination'
                                ),          
          ));
          ?>   
    </div>      
</div>
<!--Modal Kết quả -->
<div class="modal fade" id="contact_info" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
        <div id="status_sus">
            
          </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" id="id_hd" value="" />
      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
     
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal Xóa -->
<div class="modal fade" id="contact_del" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
           Bạn có chắc muốn xóa thành viên này ?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delAdmin" value="" />
        <button onclick="DeleteAdmin()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
 function DelAdmin(id){
        $('#contact_del').modal('show'); 
        $('#id_delAdmin').val(id);

   }
   function DeleteAdmin(){
     $('#contact_del').modal('hide');
     var id= $('#id_delAdmin').val(); 
     if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Admin/DeleteAdmin' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){
                    if(data==1){
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Đã xóa Admin thành công. Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Không xóa được Admin!. Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
               },                
           });
     }
   }
</script>