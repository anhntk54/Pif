<?php
/* @var $this InvesteffectController */

$this->breadcrumbs=array(
  'Hiệu quả đầu tư',
);
?>
<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Danh sách HQĐT <a  href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/Created';?>" class="btn btn-success btn-xs">Tạo mới</a></h1>
                
   </div>
</div>
<?php if($sus==1){ ?>
<div class="row">
   <div class="col-md-12 alert alert-success" id="kh_info_update">
    <p>Tạo mới hiệu quả đầu tư thành công!.Bạn muốn  quay trở về <a href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Home'; ?>" title=""> trang chủ </a></p>
   </div>
</div>
<?php } ?>
<?php if($sus==0){ ?>
<div class="row">
   <div class="col-md-12 alert alert-danger" id="kh_info_update">
    <p>Tạo mới hiệu quả đầu tư lỗi!.Bạn muốn  quay trở về <a href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/Created'; ?>" title=""> tạo mới </a></p>
   </div>
</div>
<?php } ?>
<?php if($sus==3){ ?>
<div class="row">
   <div class="col-md-12 alert alert-danger" id="kh_info_update">
    <p>Ngày đã bị trùng!.Bạn muốn  quay trở về <a href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/Created'; ?>" title=""> tạo mới </a></p>
   </div>
</div>
<?php } ?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
       <div class="panel-body">
          <div class="table-responsive">
             <table class="table table-striped table-hover">
                 <thead>
                          <tr>
                             <th>#</th>
                             <th>Ngày</th>
                             <th>Giá trị 1 đơn vị đầu tư</th>
                             <th>File đính kèm</th>
                              <th>Thao tác</th> 
                          </tr>
                  </thead>
                  <tbody >
                     <?php $i=1; ?>
                      <?php foreach ($data as $item) { ?>
                        <tr>
                          <td><?php echo $i++ ?></td>
                          <td><?php echo Investment::ViewDate($item['date'])  ?></td>
                 
                          <td class="td_investment"><?php echo $item['motdvdt'] ?></td>
                          <td ><?php echo substr(strrchr($item->file, "/"), 1); ?></td>
              <td class="icon_action">
                 <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/Edits/id/'.$item['id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a>  
                 <a style="cursor: pointer;text-decoration: underline;" onclick="Delete(<?php echo $item['id'] ?>)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
          
           Bạn có chắc muốn xóa hiệu quả đầu tư này không ?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delcus" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
<script>
   $( window ).load(function() {
    $('.td_investment').formatCurrency();
  });
  function Delete(id) {
        $('#customer_del').modal('show'); 
        $('#id_delcus').val(id);

  }
  function DeleteHD(){ 
     $('#customer_del').modal('hide');
     var id= $('#id_delcus').val(); 
   if(id!=null){
     $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/DeleteKH' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
                    if(data==1){
                         $('#cus_info').modal('show'); 
                         $('#cus_sus').html('Đã xóa đơn vị đầu tư thành công.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect' ; ?>';
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
</script>