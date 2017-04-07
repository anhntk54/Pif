<?php
/* @var $this ContractController */

$this->breadcrumbs=array(
  'Contract',
);
?>
<div class="row">
   <div class="col-lg-12">
                <?php if(Yii::app()->session['permission']=="nofull") { ?>
                      <h1 class="page-header">Thông báo</h1>
                <?php  }?>      
                
   </div>
</div>   
<div class="row">
      
      <div class="col-lg-12">
        
            <div class="alert alert-info panel-default">
               
                        <!-- /.panel-heading -->
                 <div class="panel-body">
                     <?php if(Yii::app()->session['permission']=="nofull") { ?>
                         
                               Để có thể tạo hợp đồng mới bạn phải <a style="font-size: 18px;font-weight: 600;" href="<?php echo Yii::app()->request->baseUrl; ?>/Customer">cập nhật đầy đủ thông  thông tin cá nhân</a>. &nbsp;&nbsp;&nbsp;</br>
                                Cập nhập thông tin <a style="font-size: 18px;font-weight: 600;" href="<?php echo Yii::app()->request->baseUrl; ?>/Customer"> tại đây </a>
                       <?php  
                         }
                       ?>       
                      
                        
                          
                 </div>        
            </div>
           
         
                
      </div>
      
</div>

<script>
  
</script>
