<?php
/* @var $this InvesteffectController */

$this->breadcrumbs=array(
  'Thành viên đăng ký hợp đồng',
);
?>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Danh sách khách hàng đầu tư ngay </h1>
              
                
   </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-body">
          <div class="table-responsive">
             <table class="table table-striped table-hover">
                 <thead>
                          <tr>
                             <th>#</th>
                             <th>Ngày ĐK</th>
                             <th>Họ và Tên</th>
                             <th>Thông tin KH</th>
                             <th>Hợp đồng</th>
                             <th>Trạng thái</th>
                             <th>Thao tác</th>  
                          </tr>
                  </thead>
                  <tbody >
                     <?php $i=1; ?>
                      <?php foreach ($data as $item) { ?>
                        <tr class="<?php echo $item['status']==1 ? 'danger':''?>
                          <?php echo $item['status']==2 ? 'success':''?>
                          <?php echo $item['status']==3 ? 'info':''?>
                          ">
                          <td><?php echo $i++ ?></td>
                          <td><?php echo Contract::ViewDate($item['date_created'])  ?></td>
                 		  <td><?php echo $item['fullname']  ?></td>
                 		  <td>
                 		  	<p>Sđt: <?php echo $item['telephone']  ?></p>
                 		  	<p>Mst: <?php echo $item['mst']  ?></p>
                 		  	<p>Cmtnd: <?php echo $item['cmt']  ?></p>
                 		  	<p>Ngày cấp: <?php echo $item['cmt_datecreate']  ?></p>
                 		  	<p>Nơi cấp: <?php echo $item['cmt_addresscreate']  ?></p>
                 		  </td>
                 		  
                 		  <td>
		             		  <p>
		             		  	<?php 
		                                $form=Formcontract::model()->findbyPK($item['id_form']);
		                                echo $form['name'];
		                             ?>
		             		  </p>
		             		  <p class="vonHD">
		             		  	<?php echo $item['investment'] ?>
		             		  </p>
                 		  	
                 		  </td>
                 		  <td>
                 		  	<?php if($item['status']==1){ ?>
                 		  		<span>Chưa xác nhận</span>
                 		  	<?php } ?>
                 		  	<?php if($item['status']==2){ ?>
                 		  		<span>Đã xác nhận</span>
                 		  	<?php } ?>
                 		  </td>
                 		  <td class="icon_action">
                 		  	 <a style="cursor: pointer;text-decoration: underline;" title="Đã xác nhận" onclick="updateStatus(<?php echo $item['id'] ?>)" ><i class="glyphicon glyphicon-ok" ></i></a>
                 		  	
                             <a style="cursor: pointer;text-decoration: underline;" title="Xóa khách hàng" onclick="DelHD(<?php echo $item['id'] ?>)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                             <a onclick="printDoc(<?php echo $item['id'] ?>)"><i class="fa fa-file-word-o" aria-hidden="true"></i></a>	
                 		  </td>
                         
              <td class="icon_action">
                 
              </td>
                        </tr>
                      <?php } ?>
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
<!--Modal thông báo kết quả -->
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
<!--Modal hỏi đáp -->
<div class="modal fade" id="contactPen_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
           Bạn có chắc muốn thực hiện thoa tác này?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_contactPen" value="" />
        <button onclick="UpdateStatus()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
 <script type="text/javascript">
       $( window ).load(function() {
        $('.vonHD').formatCurrency();
      });
 </script>    
 <script>
   function updateStatus(id) {
   	 $('#contactPen_modal').modal('show'); 
     $('#id_contactPen').val(id); 
   }
   function UpdateStatus() {
     $('#contactPen_modal').modal('hide');
     var id= $('#id_contactPen').val(); 
     if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/ContactPen/UpdateStatus' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
                     
                    if(data==1){
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Đã cập nhật trạng thái thành công.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Không cập nhật được!.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
               },                
           });
     }
   }
 </script>  