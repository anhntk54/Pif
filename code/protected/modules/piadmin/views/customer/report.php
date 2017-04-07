<?php
/* @var $this CustomerController */

$this->breadcrumbs=array(
  'Customer',
);
?>
<div class="row">
 <div class="col-lg-12">
 <h1 class="page-header">Gửi báo cáo tuần</h1>
</div>
</div>
<div class="row">
  <div class="col-md-4">
    <select class="form-control" onchange="location = this.value;">
      <option value="<?php echo Yii::app()->request->baseUrl?>/piadmin/Customer/Report" selected="selected">Khách hàng có hợp đồng đang hiệu lực</option>
      <option value="<?php echo Yii::app()->request->baseUrl?>/piadmin/Customer/ReportOther">Khách hàng tiềm năng và HĐ đã tất toán</option>
    </select>
  </div>
</div>
<div class="row">
      
      <div class="col-lg-12">
                <p class="count_hd">Có <b><?php echo ($item_count)  ?></b> khách hàng. <a onclick="sendReportAll()" class="btn btn-danger btn-sm pull-right" name="gets" style="" />Gửi báo cáo tuần</a></p>
                 <div class="table-responsive" style="width: 100%;">
                   <table class="table table-striped table-hover" style="font-size: 12px;">
                       <thead>
                          <tr>
                             <th>#</th>
                             <th>Họ và tên</th>
                             <th>Mã KH</th>
                             <th>Email</th>
                             <th>Số ĐT</th>
                             <th>Hợp đồng</th>
                             <th>Thao tác</th>
                              <th width="100">
                                  <input type="checkbox" id="checkall" name="checkall" />
                             </th>
                          </tr>
                       </thead>
                       <tbody id="listkh">
                        <?php $i=1; foreach ($cus as $item) { ?>
                          <tr>
                              <td><?php echo $i++; ?></td>
                              <td >
                                <a href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Customer/Views/id/'.$item['id']; ?>" title="" style="color:#141414;"><?php echo $item['fullname'] ?></a>
                              </td>
                              <td><?php echo $item['code'] ?></td>
                              <td><?php echo $item['email']; ?></td>
                              <td><?php echo $item['telephone']; ?></td>
                               <td>
                                <?php $ct=Contract::model()->findAllByAttributes(array('id_customer' => $item['id'], 'status' =>1));
                                   $countCt=count($ct); 
                                   $ct1=Contract::model()->findAllByAttributes(array('id_customer' => $item['id'], 'status' =>2));
                                   $countCt1=count($ct1);
                                   $ct2=Contract::model()->findAllByAttributes(array('id_customer' => $item['id'], 'status' =>3));
                                   $countCt2=count($ct2);
                                 ?>
                                   <span class="btn btn-danger btn-xs" title="Hợp đồng chờ chốt sổ" style="<?php if($countCt ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt ?></span>
                                   <span class="btn btn-success btn-xs"  title="Hợp đồng đã hiệu lực" style="<?php if($countCt1 ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt1 ?></span>
                                   <span class="btn btn-info btn-xs"  title="Hợp đồng đã tất toán" style="<?php if($countCt2 ==0) {echo "opacity: 0.3;";} ?>"><?php echo $countCt2 ?></span>
                               </td>
                               
                              <td>
                                <a style="cursor: pointer;text-decoration: underline;display: block;" onclick="ViewBC(<?php echo $item['id'] ?>)" title="Xem báo cáo tuần">Xem báo cáo tuần</a>
                              </td>
                               <td class="checkTD">
                                  <input type="hidden" name="cusID[]" class="cusID" value="<?php echo $item['id']; ?>" />
                                  <span id="reportkq-<?php echo $item['id']; ?>"><input class="checklist" id="checklist-<?php echo $item['id'] ?>" type="checkbox" name="arts[]" value="<?php echo $item['id'] ?>"></span>
                               </td>
                          </tr>
                         <?php  } ?> 
                       </tbody>
                   </table>
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
</div><!-- /.modal -->


<script type="text/javascript">
  var def = [];
	function sendReportAll() {
    var tmp = 0;
		$('.cusID').each(function(){
      var val = $(this).val();
      callRequestSendMail(val);
      
		}).promise().done( function(){ 
      //alert("All was done"); 
    });
	}
  function callRequestSendMail(val) {
    if($('#checklist-'+val).prop("checked")==true){ 
      //alert(val);
        var $id = '#reportkq-'+val;
        $($id).html('loading...');
        setTimeout(function() {
          loadAjax(val);
        }, 10000);
      }
    
  }
  //$.when.apply($, def).done(modalShow);
  function modalShow(){
    //$('#cus_info').modal('show'); 
    alert('DONE');
    $('#cus_sus').html('<p class="alert alert-success"><i class="fa fa-check"></i> Đã gửi báo cáo tới tất cả các khách hàng!</p>');
  }
	function loadAjax(id){
		var $id = '#reportkq-'+id;
		$.ajax({
			type:"POST", 
      async: false,
			url:'<?php echo Yii::app()->request->baseUrl.'/piadmin/Investeffect/BC' ?>', 
			data:{
				id:id,
			},
			success:function(data){   
				if(data == '1') $($id).html('<span class="btn btn-success btn-xs"><i class="fa fa-check"></i></span');
				else $($id).html('<span class="btn btn-danger btn-xs"><i class="fa fa-times"></i></span>');
			},
			error: function() {
				$($id).html('<span class="btn btn-danger btn-xs"><i class="fa fa-times"></i></span>'+data);
			}              
		});  	
	}



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