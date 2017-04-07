<?php
/* @var $this HomeController */
$this->breadcrumbs=array(
    'Home',
    );
if(Yii::app()->session['adrole']==1 || Yii::app()->session['adrole']==2 || Yii::app()->session['adrole']==3 ) $link = true;
date_default_timezone_set('Asia/Ho_Chi_Minh');
$today = time();
$monthYear = date('m/Y', $today);
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Bảng điều khiển</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <?php if(isset($link)) echo '<a href="'.Yii::app()->createUrl("/piadmin/Customer").'" title="Danh sách khách hàng">' ?>
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countcus ?></div>
                        <div> khách hàng</div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <span class="pull-left">Chi tiết</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
            <?php if(isset($link)) echo '</a>' ?>
        </div>
    </div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <?php if(isset($link)) echo '<a href="'.Yii::app()->createUrl("/piadmin/Contract").'" class="panel-primary" title="Danh sách hợp đồng">' ?>
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-tasks fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $countC ?></div>
                    <div>hợp đồng</div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <span class="pull-left">Chi tiết</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
        </div>
        <?php if(isset($link)) echo '</a>' ?>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
        <?php if(isset($link)) echo '<a href="'.Yii::app()->createUrl("/piadmin/Contract/CreateHD") .'" title="Thêm hợp đồng mới" class="panel-yellow">' ?>
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa fa-money fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge">
                        <?php if($maxDate['tongtkkinhdoanh']/1000000000 > 1) echo number_format($maxDate['tongtkkinhdoanh']/1000000000, 2, ',', '.').'<span style="font-size: 17px;margin-top: 30px;">tỷ</span>' ?>
                    </div>
                    <div>/ <?php if($von/1000000000 > 1) echo number_format($von/1000000000, 2, ',', '.').' tỷ';?> vốn đầu tư</div>
                </div>
            </div>
        </div>
            <div class="panel-footer">
                <span class="pull-left">Thêm hợp đồng mới</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        <?php if(isset($link)) echo '</a> ' ?>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
        <?php if(isset($link)) echo '<a href="'. Yii::app()->createUrl("/piadmin/Contract/CreateHD").'" title="Thêm hợp đồng mới" class="panel-red">' ?>
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-truck fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><span id="dvdt"><?php echo $maxDate['motdvdt'] ;?></span><span style="font-size: 17px;margin-top: 30px;">đ</span></div>
                    <div> 1 ĐVĐT</div>
                </div>
            </div>
        </div>
            <div class="panel-footer">
                <span class="pull-left">Thêm hợp đồng mới</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        <?php if(isset($link)) echo '</a>' ?>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-3">
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tổng số khách hàng</th>
                <th class="text-right"><?php echo $kh->tongso ?></th>
            </tr>
            <tr>
                <td>KH có HĐ đang hiệu lực</td>
                <td class="text-right"><?php echo $kh->hieuluc ?></td>
            </tr>
            <tr>
                <td>Khách hàng tiềm năng</td>
                <td class="text-right"><?php echo $kh->tiemnang ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-striped table-responsive">
            <tr>
                <th>Tổng số hợp đồng</th>
                <th class="text-right"><?php echo $hd->tongso ?></th>
            </tr>
            <tr>
                <td>HĐ đang hiệu lực</td>
                <td class="text-right"><?php echo $hd->hieuluc ?></td>
            </tr>
            <tr>
                <td>HĐ đã tất toán</td>
                <td class="text-right"><?php echo $hd->tattoan ?></td>
            </tr>
            <tr>
                <td>HĐ chờ chốt sổ</td>
                <td class="text-right"><?php echo $hd->chochot ?></td>
            </tr>
            <tr>
                <td>HĐ cam kết lợi nhuận</td>
                <td class="text-right"><?php echo $hd->camket ?></td>
            </tr>
            <tr>
                <td>HĐ chia sẻ lợi nhuận</td>
                <td class="text-right"><?php echo $hd->chiase ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-striped table-responsive">
            <tr>
                <th>7 ngày qua</th>
            </tr>
            <tr>
                <td>KH mới có HĐ hiệu lực</td>
                <td class="text-right"><?php echo $kh->week_hieuluc ?></td>
            </tr>
            <tr>
                <td>KH tiềm năng mới</td>
                <td class="text-right"><?php echo $kh->week_tiemnang ?></td>
            </tr>
            <tr>
                <td>HĐ mới hiệu lực</td>
                <td class="text-right"><?php echo $hd->week_hieuluc ?></td>
            </tr>
            <tr>
                <td>HĐ tất toán</td>
                <td class="text-right"><?php echo $hd->week_tattoan ?></td>
            </tr>
            <tr>
                <td>HĐ mới chờ chốt sổ</td>
                <td class="text-right"><?php echo $hd->week_chochot ?></td>
            </tr>
            <tr>
                <td>HĐ mới cam kết lợi nhuận</td>
                <td class="text-right"><?php echo $hd->week_camket ?></td>
            </tr>
            <tr>
                <td>HĐ mới chia sẻ lợi nhuận</td>
                <td class="text-right"><?php echo $hd->week_chiase ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-striped table-responsive">
            <tr>
                <th>Trong tháng <?php echo $monthYear; ?></th>
            </tr>
            <tr>
                <td>KH mới có HĐ hiệu lực</td>
                <td class="text-right"><?php echo $kh->month_hieuluc ?></td>
            </tr>
            <tr>
                <td>KH tiềm năng mới</td>
                <td class="text-right"><?php echo $kh->month_tiemnang ?></td>
            </tr>
            <tr>
                <td>HĐ mới hiệu lực</td>
                <td class="text-right"><?php echo $hd->month_hieuluc ?></td>
            </tr>
            <tr>
                <td>HĐ tất toán</td>
                <td class="text-right"><?php echo $hd->month_tattoan ?></td>
            </tr>
            <tr>
                <td>HĐ mới chờ chốt sổ</td>
                <td class="text-right"><?php echo $hd->month_chochot ?></td>
            </tr>
            <tr>
                <td>HĐ mới cam kết lợi nhuận</td>
                <td class="text-right"><?php echo $hd->month_camket ?></td>
            </tr>
            <tr>
                <td>HĐ mới chia sẻ lợi nhuận</td>
                <td class="text-right"><?php echo $hd->month_chiase ?></td>
            </tr>
        </table>
    </div>
</div>
<script>
    $( window ).load(function() {
        $('#divcount').formatCurrency();
        $('#dvdt').formatCurrency();
    });
</script> 


