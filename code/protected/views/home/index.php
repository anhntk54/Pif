<?php
/* @var $this HomeController */

$this->breadcrumbs=array(
    'Home',
);
?>
 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bảng điều khiển</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row">
           <div class="col-lg-12">
            <?php if(Yii::app()->session['permission']=="nofull") { ?>
              <div class="alert alert-info  panel-default">
                  
                    <div class="panel-body">
                      <span>Hãy<a style="font-size: 16px;font-weight: 600;" href="<?php echo Yii::app()->request->baseUrl; ?>/Customer/"> cập nhật thông tin cá nhân</a> để tạo hợp đồng mới.Cập nhật thông tin <a style="font-size: 16px;font-weight: 600;" href="<?php echo Yii::app()->request->baseUrl; ?>/Customer"> tại đây </a></span>
                    </div>
               </div>
            <?php } ?>   
           </div>
           <div class="col-lg-4">
           </div>
           <div class="col-lg-4">
               
           </div>
        </div>     
            <div class="row">
               
                <div class="col-lg-3 col-md-6">
                   <a href="<?php  echo Yii::app()->createUrl("/Contract/RegContractPending") ?>" title="Tạo mới hợp đồng">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Thêm</div>
                                    <div>Hợp đồng</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php  echo Yii::app()->createUrl("/Contract/RegContractPending") ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    </a>
                </div>
                 <div class="col-lg-3 col-md-6">
                   <a href="<?php  echo Yii::app()->createUrl("/Contract/AllContract") ?>" class="panel-primary" title="Danh sách hợp đồng">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_contract ?></div>
                                    <div>Hợp đồng</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php  echo Yii::app()->createUrl("/Contract/AllContract") ?>">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-md-6">
                  <a href="#" title="" class="panel-yellow">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" style="font-size: 20px;margin-top: 30px;" id="divcount"><?php echo $count ?></div>
                                    <div>Vốn đầu tư</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                   </a> 
                </div>
                <div class="col-lg-3 col-md-6">
                  <a href="#" title="" class="panel-red">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="dvdt"><?php echo $maxDate['motdvdt'] ;?></div>
                                    <div>Giá trị 1 ĐVĐT</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                   </a> 
                </div>
            </div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
<script>
    $( window ).load(function() {
    $('#divcount').formatCurrency();
    $('#dvdt').formatCurrency();
  });
</script>            


          
           
