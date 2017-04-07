<?php
?>
<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="no index, no follow" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- css-trungcode -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/css/css.css" rel="stylesheet">

</head>

<body id="contactPen">
<header>
    <div class="container">
        <nav class="">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://pif.vn" target="_blank"><img src="/web/images/logo-white.png" height="50"/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://members.pif.vn/contactPen/">Đầu tư ngay <span class="sr-only">(current)</span></a></li>
        <li><a href="http://pif.vn" target="_blank">Website</a></li>
        <li><a href="https://www.facebook.com/pif.vn/" target="_blank">Facebook</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="tel:0915849235"><i class="fa fa-phone" ></i> 0915.849.235</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    </div>
</header>

    <div class="container">
        <div class="row">
             <div class="col-md-1">
                 
             </div>
            <div class="col-md-10" id="header_pi">
              <h1>HỢP TÁC ĐẦU TƯ</h1></br>
            </div>
            <div class="col-md-1">
                
            </div>
        </div>
        <div class="row bs-wizard" style="border-bottom:0;">
                
                <div class="col-xs-3 bs-wizard-step complete">
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Bước 1: Đăng ký đầu tư</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step active">
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Bước 2: Lấy số hợp đồng</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled">
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Bước 3: Chuyển khoản</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled">
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Bước 4: Hoàn tất</div>
                </div>
            </div>
        <div class="row">
              
            <div class="col-md-8 col-md-offset-2">
                <div id="divLoading" > 
                </div>
                <div class="login-panel panel panel-default" style="margin-top: 5%;">
                    <div class="panel-heading" id="title_login">
                        <h3 class="panel-title">Bước 2: LẤY SỐ HỢP ĐỒNG</h3>
                    </div>
                    <div class="panel-body">
                       
                          <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'contact-form',
                            'enableClientValidation'=>true,
                            'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                            ),
                        )); ?>
                            

                            <div class="col-md-12">
                                <h4>THÔNG TIN</h4>
                            </div>
                            <div class="col-md-8">
                              <label>Họ và tên *</label>
                              <div class="form-group">
                                  <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'Họ và tên ','value'=>$user->fullname)); ?>
                              </div>
                              <div class="form-group">
                                      <?php echo $form->error($model,'name',array('class'=>'error')); ?>
                                    </div>
                            </div>

                            <div class="col-md-4">
                              <label>Mã số thuế</label>
                              <div class="form-group">
                                  <?php echo $form->textField($model,'mst',array('class'=>'form-control','placeholder'=>'Mã số thuế ','value'=>$user->mst)); ?>
                                </div>
                                     <div class="form-group">
                                      <?php echo $form->error($model,'mst',array('class'=>'error')); ?>
                                    </div>
                            </div>
                            <div class="col-md-4">
                              <label>Số CMTND *</label>
                                <div class="form-group">
                                  <?php echo $form->textField($model,'cmt',array('class'=>'form-control','placeholder'=>'Số CMTND * ','value'=>$user->cmt)); ?>
                                </div>
                                     <div class="form-group">
                                      <?php echo $form->error($model,'cmt',array('class'=>'error')); ?>
                                    </div>
                            </div>
                            <div class="col-md-3">
                              <label>Ngày cấp CMTND *</label>
                                <div class="form-group">
                                 <!--  <?php echo $form->textField($model,'cmt_datecreate',array('class'=>'form-control','placeholder'=>'Ngày cấp CMTND *')); ?> -->
                                  <?php
                                        Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
                                        $this->widget('CJuiDateTimePicker', array(
                                            'model' => $model, //Model object
                                            'language'=>'vi',
                                            'attribute' => 'cmt_datecreate', //attribute name
                                            'mode' => 'date', //use "time","date" or "datetime" (default)
                                            'options' => array(
                                                'showSecond'=>true,
                                                'showOtherMonths' => true, // Show Other month in jquery
                                               'selectOtherMonths' => true, // Select Other month in jquery
                                               'changeMonth'=>true,
                                               'changeYear'=>true,
                                               'showAnim'=>'fold',
                                                "dateFormat"=>'dd/mm/yy',
                                                
                                            ), // jquery plugin options
                                            'htmlOptions' => array(
                                                'class'=>'form-control',
                                                'placeholder'=>'Ngày cấp CMTND *',
                                                'value'=>Investment::ViewDate($user->cmt_datecreate)
                                            ),
                                        ));
                                        ?>
                                </div>
                                     <div class="form-group">
                                      <?php echo $form->error($model,'cmt_datecreate',array('class'=>'error')); ?>
                                    </div>
                              </div>
                              <div class="col-md-5">
                                <label>Nơi cấp CMTND *</label>
                                <div class="form-group">
                                  <?php echo $form->textField($model,'cmt_addresscreate',array('class'=>'form-control','placeholder'=>'Nơi cấp CMTND *','value'=>$user->cmt_addresscreate)); ?>
                                </div>
                                    <div class="form-group">
                                      <?php echo $form->error($model,'cmt_addresscreate',array('class'=>'error')); ?>
                                    </div>

                            </div>
                            <div class="col-md-12">
                                <h4>DỰ KIẾN ĐẦU TƯ</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <?php echo $form->dropDownList($model,'id_form',$dataCat,array('class'=>'form-control','placeholder'=>'Chọn loại hợp đồng *')); ?>
                                </div>
                                    <div class="form-group">
                                      <?php echo $form->error($model,'id_form',array('class'=>'error')); ?>
                                    </div>
                                  <?php echo CHtml::submitButton('Đầu tư',array('class'=>'btn btn-success ','id'=>'btnDK')); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <?php echo $form->textField($model,'investment',array('class'=>'form-control','placeholder'=>'Vốn đầu tư *')); ?>
                                </div>
                                     <div class="form-group">
                                      <?php echo $form->error($model,'investment',array('class'=>'error')); ?>
                                    </div>
                            </div>
                        <?php $this->endWidget(); ?>

                               
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <?php Yii::app()->clientScript->registerCoreScript('jquery.ui') ?>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
    <script type="text/javascript">
       $( window ).load(function() {
        $('#ContactPenForm_investment').formatCurrency();
      });
       $('#ContactPenForm_investment').keyup(function() { 
          if(($(this).val().trim() == null || $(this).val().trim() == "")){
               
           }else {
            $(this).val(format($(this).val().trim()));
           if(isNaN($(this).val().trim().replace(/\./g,""))) {
           $('#ContactPenForm_investment_em_').show();
           $('#ContactPenForm_investment_em_').html("Vốn hợp đồng phải là số!");
           $("#btnDK").prop('disabled', true);
          }else  {
             $('#ContactPenForm_investment_em_').hide();
             if($(this).val().trim().replace(/\./g,'')<20000000){
                $('#ContactPenForm_investment_em_').show();
                $('#ContactPenForm_investment_em_').html("Vốn hợp đồng phải lớn hơn 20 triệu!");
                $("#btnDK").prop('disabled', true);
             }else {
                $('#ContactPenForm_investment_em_').hide();
                $("#btnDK").prop('disabled', false);
             }  
            
        } 
       }
         
      });
    function format(num) {
        var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
          // if(str.indexOf(".") > 0) {
          //   parts = str.split(".");
          //   str = parts[0];
          // }
          str = str.split("").reverse();
          for(var j = 0, len = str.length; j < len; j++) {
            if(str[j] != ".") {
              output.push(str[j]);
              if(i%3 == 0 && j < (len - 1)) {
                output.push(".");
              }
              i++;
            }
          }
          formatted = output.reverse().join("");
          return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
      }
    </script>
<?php
function hiddenStr($str){
  if($str=='') return '';
  return '*******'.substr($str,-3);
}
?>
</body>

</html>
