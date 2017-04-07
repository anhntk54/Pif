<?php
/* @var $this CustomerController */

$this->breadcrumbs=array(
  'Customer',
);
?>
<div class="row">
 <div class="col-lg-12">
 <h1 class="page-header">Danh sách khách hàng <a  href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/CreateKH';?>" class="btn btn-success btn-xs">Tạo mới khách hàng</a>
 </h1>
</div>
</div>
<div class="row">
      
      <div class="col-lg-12">
        <div class="panel panel-default">
           
             <div class="panel-body">
               <div class="row">
                   <form method="POST" name="filter" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Customer/Filter">
                   <div class="col-lg-4">
                        <div class="form-group">
                           <input class="form-control" id="search" name="search"  placeholder="Tìm kiếm theo tên/email/sdt/mst" value="<?php echo  Yii::app()->session['search'] ?>"/>
                        </div>
                   </div>
                   <!--Created  17/08/2016-->
                    <div class="col-lg-3">
                        <div class="form-group">
                           <select name="iscontract" class="form-control"  >
                            <option value="0" <?php if(Yii::app()->session['iscontract']==0) { echo "selected";} ?>>---Xem tất cả khách hàng---</option>
                            <option value="1" <?php if(Yii::app()->session['iscontract'] && Yii::app()->session['iscontract']==1){echo "selected";}else {echo "selected";}  ?> >Khách hàng đã có hợp đồng</option>
                            <option value="3"  >---->Hợp đồng đang hiệu lực</option>
                            <option value="4"  >---->Hợp đồng chưa hiệu lực</option>
                            <option value="5"  >---->Hợp đồng đã tất toán</option>
                            <option value="2" <?php if(Yii::app()->session['iscontract']==2) { echo "selected";} ?>>Khách hàng chưa có hợp đồng</option>
                          </select>
                        </div>
                   </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                           <select name="isadmin" class="form-control"  >
                            <option value="0" >---Lọc theo quản trị viên---</option>
                            <?php foreach($admin as $item) { ?>
                              <option value="<?php echo $item['id'] ?>" <?php if($item['id']==Yii::app()->session['isadmin']){echo "selected";} ?> ><?php echo $item['fullname'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                   </div>
                   <div class="col-lg-2">
                     <button type="submit" class="btn btn-primary pull-right">Tìm kiếm</button>
                   </div>
                  </form>
               </div>
                <form name="formlist" method="POST" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Investeffect/BcAll">
                 <div class="table-responsive" style="width: 100%;">
                   <table class="table table-striped table-hover" style="font-size: 12px;">
                       <thead>
                          <tr>
                             <th>#</th>
                             <th>Họ và tên</th>
                             <th>Thông tin</th>
                             <th>Mã số thuế</th>
                             <th>Quản lý bởi</th>
                             <th>Hợp đồng</th>
                             <th>Thao tác</th>
                          </tr>
                       </thead>
                       <tbody id="listkh">
                        <?php 
                          if($pages->getCurrentPage()>0){

                           $i=1*($pages->getCurrentPage())*20+1; 
                          }else {
                            $i=1;
                          }


                        ?>
                        <?php foreach ($data as $item) { ?>
                          <tr>
                              <td><?php echo $i++; ?></td>
                              <td >
                              <a href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/Views/id/'.$item['id']; ?>" title="" style="color:#141414;"><?php echo $item['fullname'] ?></a>
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
                              <td><?php
                                     $admin=Admin::model()->findbyPK($item['id_admin']);
                                     echo $admin['fullname'];
                                  ?>
                               </td>
                               <td>
                                <?php $ct=Contract::model()->findAllByAttributes(array('id_customer' => $item['id'], 'status' =>1));
                                   $countCt=count($ct); 
                                   $ct1=Contract::model()->findAllByAttributes(array('id_customer' => $item['id'], 'status' =>2));
                                   $countCt1=count($ct1);
                                   $ct2=Contract::model()->findAllByAttributes(array('id_customer' => $item['id'], 'status' =>3));
                                   $countCt2=count($ct2);
                                 ?>
                                   <span class="btn btn-danger btn-circle" title="Hợp đồng chờ chốt sổ" style="<?php if($countCt ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt ?></span>
                                   <span class="btn btn-success btn-circle"  title="Hợp đồng đã hiệu lực" style="<?php if($countCt1 ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt1 ?></span>
                                   <span class="btn btn-info btn-circle"  title="Hợp đồng đã tất toán" style="<?php if($countCt2 ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt2 ?></span>
                               </td>
                               
                              <td>
                                <!-- <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/Views/id/'.$item['id']; ?>" >Xem</a> | 
                                <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/Edits/id/'.$item['id']; ?>" >Sửa</a> | 
                                <a style="cursor: pointer;text-decoration: underline;" onclick="Delete(<?php echo $item['id'] ?>)" >Xóa</a>| -->
                                <a style="cursor: pointer;text-decoration: underline;display: block;" onclick="ViewBC(<?php echo $item['id'] ?>)" title="Xem báo cáo tuần">Xem báo cáo tuần</a>
                              </td>
                          </tr>
                         <?php  } ?> 
                       </tbody>
                   </table>
                    </form>
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
          
           Bạn có chắc muốn xóa khách hàng này không ?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delcus" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="emailkh" tabindex="-1" role="dialog">
  <div class="modal-dialog" style="width: 800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Báo cáo hiệu quả đầu tư</h4>
      </div>
      <div class="modal-body">
          
         <div class="" id="viewBC">
           
         </div>
         <div id="editor"></div>
      </div>
      <div class="modal-footer">
       <form name="filter" id="filter-<?php echo $item['id'] ?>" action="<?php echo Yii::app()->request->baseUrl; ?>/piadmin/Investeffect/Bc" method="post" accept-charset="utf-8">
          <input type="hidden" id="idkhemail" value="" name="chkall"/>
         <a onclick="printBill()" class="btn btn-primary">Download pdf</a>
          <button type="submit" class="btn btn-primary">Gửi báo cáo tuần</button>
       </form>
       
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
  function Delete(id) {
       $('#customer_del').modal('show'); 
        $('#id_delcus').val(id);

  }
   function sendMail(id){
    $('#emailkh').modal('show'); 
    $('#idkhemail').val(id);
  }
   // xem báo cáo tuần
  function ViewBC(id){
      //  $('#emailkh').modal('show'); 
        $('#idkhemail').val(id);
        
         if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/ViewBC' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
              
                        $('#emailkh').modal('show');  
                        $('#viewBC').html(data);
 
               },                
           });
     }
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
  function Search(name){
       
      $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/getByName';?>',
            data:
            {
              name:name,
            },
           success:function(data){   
        
              $('#listkh').html(data);
           
       }
      });
  }
  function pdf() {
       var doc = new jsPDF();
       var specialElementHandlers = {
           '#editor': function (element, renderer) {
          return true;
         }
      };
       doc.fromHTML($('#viewBC').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
           });
         doc.save('BCT.pdf');
  }
   function printBill() {
         var divContents = $("#viewBC").html();
         var printWindow = window.open('', '', 'height=400,width=800');
         printWindow.document.write('<html><head><title>BCT</title>');
            printWindow.document.write('<style></style>'); 
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
       
    }
</script>
<script>
$(document).ready(function() {
  $("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
  });
 });
  $("#checkall").on('ifChanged', function(){
    if($(this).prop('checked')==true)
      $(".checklist").iCheck('check');
    else $(".checklist").iCheck('uncheck');
   }); 
</script>