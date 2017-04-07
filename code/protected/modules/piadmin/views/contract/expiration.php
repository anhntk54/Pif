<?php
/* @var $this ContractController */

$this->breadcrumbs=array(
  'Expiration',
);
?>
<div class="row">
 <div class="col-lg-12">
 <h1 class="page-header">Danh sách hợp đồng sắp hết hạn</h1>
</div>
</div>
<?php if($item_count==0):?>
  <div class="alert alert-warning">
  <p><i class="fa fa-exclamation-circle"></i> Không có hợp đồng nào sắp hết hạn!</p>
  </div>
<?php else: ?>
<div class="row">
 <?php if($sus==1){ ?>
   <div class="col-lg-12 alert alert-success">
     <p><i class="fa fa-exclamation-check"></i>Cập nhật hợp đồng thành công.Nhấn <a href="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Home" title="">tại đây </a> để quay về trang chủ</p>
   </div>
  <?php } ?> 
  <!--  <div class="col-lg-12 alert alert-danger">
     <p>Cập nhật hợp đồng thất bại!</p>
   </div> -->
</div>
<div class="row">
      <div id="divLoading">
      
    </div>
      <div class="col-lg-12">
        <div class="panel">
           
             <div >
              <form method="POST" name="filter" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Contract/Filter">
               <div class="row">
                   <div class="col-lg-3">
                        <div class="form-group">
                          <select name="typecontract" class="form-control" id="filter" onchange="document.filter.submit( );" >
                            <option  value="0" <?php if(Yii::app()->session['type']==0 ){ echo 'selected' ;} ?>>---Xem tất cả loại hợp đồng---</option>
                            <?php
                              foreach($form as $item) { 
                             ?>
                            <option value="<?php echo $item['id'] ?>" <?php if(Yii::app()->session['type']==$item['id'] ){ echo 'selected' ;} ?>><?php echo $item['name'] ?></option>
      
                            <?php } ?>
                          </select>
                       </div>
                   </div>
                   <div class="col-lg-3">
                        <div class="form-group">
                          <select name="status" class="form-control" onchange="document.filter.submit( );" >
                            <option  value="0" <?php if(Yii::app()->session['status']==0){ echo 'selected' ;} ?>>---Xem tất cả trạng thái---</option>
                            <option value="1" <?php if(Yii::app()->session['status']==1){ echo 'selected' ;} ?>>Chờ chốt số</option>
                            <option value="2" <?php if(Yii::app()->session['status']==2){ echo 'selected' ;} ?> >Đã hiệu lực</option>
                            <option value="3" <?php if(Yii::app()->session['status']==3){ echo 'selected' ;} ?>>Đã tất toán</option>
                          </select>
                       </div>
                   </div>
                    <div class="col-lg-3">
                     
                        <div class="form-group">
                          <select class="form-control" name="filters" onchange="document.filter.submit( );">
                            <option value="0" <?php if(Yii::app()->session['filters']==0){ echo 'selected' ;} ?> >--Sắp xếp--</option>
                            <option value="1" <?php if(Yii::app()->session['filters']==1){ echo 'selected' ;} ?>>Theo thời gian: mới nhất</option>
                            <option value="2" <?php if(Yii::app()->session['filters']==2){ echo 'selected' ;} ?>>Theo thời gian: lâu nhất</option>
                            <option value="3" <?php if(Yii::app()->session['filters']==3){ echo 'selected' ;} ?>>Theo số hợp đồng: cao đến thấp</option>
                            <option value="4" <?php if(Yii::app()->session['filters']==4){ echo 'selected' ;} ?>>Theo số hợp đồng: thấp đến cao</option>
                          </select>
                        </div>
                      
                   </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                           <input class="form-control"  onchange="document.filter.submit( );" name="ma" placeholder="Tìm kiếm" />
                        </div>
                   </div>
                   <button type="submit" class="btn btn-primary">Tìm kiếm</button>
               </div>
             </form>  
         <p class="count_hd">Có <b><?php echo $item_count  ?></b> hợp đồng.</p>
                 <div class="table-responsive" >
                   <table class="table table-hover" style="font-size: 12px;">
                       <thead>
                          <tr>
                             <th>#</th>
                             <th>Ngày tạo HĐ</th>
                             <th>Thông tin HĐ</th>
                             <th>Ngày ký</th>
                             <th>Thông tin</th>
                              <th>Ghi chú</th>
                             <th>Thao tác</th>
                          </tr>
                       </thead>
                       <tbody id="listpro" style="font-size: 12px;">
                        <?php
                          if($pages->getCurrentPage()>0){

                           $i=1*($pages->getCurrentPage())*30+1; 
                          }else {
                            $i=1;
                          }
                         ?>
                        <?php foreach ($data as $item) { ?>
                          <tr class="<?php echo $item['status']==1 ? 'danger':''?>
                          <?php echo $item['status']==2 ? 'success':''?>
                          <?php echo $item['status']==3 ? 'info':''?>
                          " >
                              <td><?php echo $i++; ?></td>
                              <td><?php echo Contract::ViewDate($item['date_created'])  ?></td>
                              <td>
                               <?php echo '<b>'.$item['number_form'].'</b>' ?>
                                  <br />
                                 <?php 
                                    $form=Formcontract::model()->findbyPK($item['id_form']);
                                    echo $form['name'];
                                 ?>
                              </td>
                              <td><?php echo date('d/m/Y', strtotime($item['date_modified']))  ?></td>
                              <td>
                                 <?php 
                                   $kh=Customer::model()->findbyPK($item['id_customer']);
                                   echo '<b>'.$kh['fullname'].'</b>';
                                  ?>
                                  <br />
                                    <?php echo $kh['email'];  ?> 
                                  <br />
                                     <?php echo $kh['telephone'];  ?> 
                              </td>
                              <td>
                                
                                  <?php echo $item['note'] ?>
                              </td>
                              <td class="icon_action">
                                <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/Review/id/'.$item['id']; ?>" ><i class="fa fa-search" aria-hidden="true"></i></a>  
                                <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/Edits/id/'.$item['id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                <a style="cursor: pointer;text-decoration: underline;" onclick="DelHD(<?php echo $item['id'] ?>)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                  <a onclick="printDoc(<?php echo $item['id'] ?>)"><i class="fa fa-file-word-o" aria-hidden="true"></i></a>

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
<!--Modal Hỏi đáp -->
<div class="modal fade" id="updateHD" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chọn trạng thái hợp đồng</h4>
      </div>
      <div class="modal-body">
          <form id="hd_status">
                    <label>
                        <input name="status_hd"  checked  type="radio" value="1">Chờ chốt số
                    </label>
                    <label style="color: #5cb85c;">
                        <input name="status_hd"  type="radio" value="2"> Đã hiệu lực
                    </label>
                     <label style="color:#d9edf7;">
                        <input name="status_hd"  type="radio" value="3"> Đã tất toán
                    </label>
          </form>
          <input type="hidden" id="id_hd" value="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button onclick="UpdateHD()" class="btn btn-primary">Lưu</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- -->
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
          
           Bạn có chắc muốn xóa hợp đồng này ?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delhd" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal in hợp đồng -->
 <div class="modal fade" id="content_hd" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
         <div id="content_print_hd">
           
         </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delhd" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- -->
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/magicsuggest.js"></script>
<script type="text/javascript">
   function updateHD (id,status) {
    $('#updateHD').modal('show'); 
      $('#id_hd').val(id); 
       var $radios = $('input:radio[name=status_hd]');
      if(status === 1) {
        $radios.filter('[value=1]').prop('checked', true);
      }
      if(status === 2) {
        $radios.filter('[value=2]').prop('checked', true);
     }
     if(status === 3) {
        $radios.filter('[value=3]').prop('checked', true);
     }
   }
   function DelHD(id){
        $('#contact_del').modal('show'); 
        $('#id_delhd').val(id);

   }
   function DeleteHD(){
     $('#contact_del').modal('hide');
     var id= $('#id_delhd').val(); 

     if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/DeleteHD' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
                     
                    if(data==1){
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Đã xóa hợp đồng thành công.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Không xóa được! Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
               },                
           });
     }
   }
   function UpdateHD() {
    
    $('#updateHD').modal('hide');
       var status=$('input[name="status_hd"]:checked', '#hd_status').val()
       var id= $('#id_hd').val(); 
       if(1<=id && id <=9){
          id="0"+id;
       }
       if(status!=null && id!=null) {
            $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/updateHD' ?>', 
               data:{
                            id:id,
                            status:status,
                        },
               success:function(data){   
                    if(data==1){
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Đã cập nhật thành công trạng thái hợp đồng.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Cập nhật lỗi!.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->getRequest()->getRequestUri() ; ?>';
                                 }, 2000);
                    }
               },                
           });
       }else {
        alert("Chưa chọn trạng thái!");
       }
        
    }
    function getTT(sel){
      
       $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/getByStatus';?>',
            data:
            {
              status:sel.value,
            },
           success:function(data){   
                $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#listpro').html(data);
                             }, 3000);
             
           
       }
      });
    }
    function gethd(sel) {
        
         $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/getByLoai';?>',
            data:
            {
              id:sel.value,
            },
           success:function(data){   
           
              $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#listpro').html(data);
                             }, 3000);
           
           },error: function(err){
           
          }
      });
    }
    function getKHS(id) {
      
          $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/getByID';?>',
            data:
            {
              id:id,
            },
           success:function(data){   
              $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#listpro').html(data);
                             }, 3000);
           
       }
      });
    }
     function search(ma){
       
      $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/getByMa';?>',
            data:
            {
              ma:ma,
            },
           success:function(data){   
        
               $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                     $('#listpro').html(data);
                             }, 3000);
           
       }
      });
  }
</script>
<script>
jQuery(function() {
    var ms = jQuery('#khs').magicSuggest({
        allowFreeEntries: true,
        selectionStacked: true,
        maxSelection: 3,
        maxSelectionRenderer: function(v){
      return 'Đã chọn khách hàng';
    },
    selectFirst: true,
    hideTrigger: true,
    maxSuggestions: 10
    });
  jQuery(ms).on(
    'selectionchange', function(e, cb, s){
     getKHS(cb.getValue());
    }
  );
});
</script>
<script>
 function printBill() {
         var divContents = $("#content_print_hd").html();
         var printWindow = window.open('', '', 'height=400,width=800');
         printWindow.document.write('<html><head><title>Hợp Đồng</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
       
    }
function printHD(id) {
      
          $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/printHD';?>',
            data:
            {
              id:id,
            },
           success:function(data){   
             alert(data);
             $('#content_print_hd').html(data);
              printBill();
           
       }
      });
    }
    
  
</script>

<script>
  function printDoc(id) {
       $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/printHD';?>',
            data:
            {
              id:id,
            },
           success:function(data){   
            $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                      var obj=jQuery.parseJSON(data);
                                      $("#content_print_hd").html(obj.content);
                                       $("#content_print_hd").wordExport(obj.name);
                             }, 2000);
           
       },
       error: function (request, error) {
             alert("Lỗi không xuất được file word."+error);
           }
      });
      
    }
</script>
     
<?php endif; ?>