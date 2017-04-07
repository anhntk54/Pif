<div class="row">
   <div class="col-lg-12">
               
                      <h1 class="page-header">Chi tiết hợp đồng <?php echo $model->number_form ?><a  href="<?php echo Yii::app()->request->baseUrl.'/piadmin/Contract/CreateHD';?>" class="btn btn-success btn-xs">Tạo mới hợp đồng</a></h1>
              
                
   </div>
</div>
<div class="row">
	<div class="col-lg-2">
	
    </div>
    <div class="col-lg-8">
	    <div class="panel panel-default" >
	     <div class="panel-heading">
	     	 <p>Để in hợp đồng  <i class="fa fa-hand-o-right" aria-hidden="true"></i>  <button type="button" class="btn btn-primary" onclick="printBill()">In hợp đồng</button></p>
	     </div>
         <div class="panel-body" id="print_content">

          <p>  <?php echo Contract::GenHDView($model->content_contract) ?> </p>
         </div>
      </div>
    </div>
    <div class="col-lg-2">
	
</div>
</div>
<script>
   function printBill() {
         var divContents = $("#print_content").html();
         var printWindow = window.open('', '', 'height=400,width=800');
         printWindow.document.write('<html><head><title>Hợp Đồng</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
       
    }
</script>