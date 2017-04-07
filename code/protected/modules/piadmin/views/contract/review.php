<?php ?>
<div class="row">
   <div class="col-lg-12">
                    <h1 class="page-header">Thông tin  hợp đồng số <?php echo $model->number_form ?></h1>
   </div>
</div> 
<div class="row">
<!--Thông báo -->
  
  <!--Review -->
  
  <!--Thông tin khách hàng -->
  <div class="col-lg-2">
    
  </div>
  <div class="col-lg-8">
      <div class="panel panel-default" >
        <div class="panel-heading">
             Hợp đồng số <?php echo $model->number_form ?>   <button style="margin-left: 20px;" type="button" class="btn btn-primary" onclick="printBill()">In hợp đồng</button><button style="margin-left: 20px;" type="button" class="btn btn-primary" onclick="printDoc()">Xuất File Doc</button>
        </div>
         <div class="panel-body" id="print_content">
          <p>  <?php echo Contract::GenHDView($hd) ?> </p>
         </div>
      </div>
  </div>
  <div class="col-lg-2">
    
  </div>
</div>
 <script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/FileSaver.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.wordexport.js"></script>
<script>
   function printBill() {
         var divContents = $("#print_content").html();
         var printWindow = window.open('', '', 'height=400,width=800');
         printWindow.document.write('<html><head><title><?php   $cus=Customer::model()->findByPk($model->id_customer); echo $model->number_form."_".$cus['fullname'] ?></title>');
            printWindow.document.write('<style>body{font-family: "Times New Roman"; font-size: 12pt; }a{text-decoration: none;}</style>'); 
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
       
    }
     function printDoc() {
      $("#print_content").wordExport('<?php   $cus=Customer::model()->findByPk($model->id_customer); echo $model->number_form."_".$cus['fullname'] ?>');
    }
</script>
