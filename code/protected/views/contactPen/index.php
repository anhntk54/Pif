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
    <title><?php echo CHtml::encode($this->pageTitle); ?> - Đầu tư ngay</title>

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
                
                <div class="col-xs-3 bs-wizard-step active">
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center">Bước 1: Đăng ký đầu tư</div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step disabled">
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
              
            <div class="col-md-4 col-md-offset-4">
                <div id="divLoading" > 
                </div>
                <div class="login-panel panel panel-default" style="margin-top: 5%;">
                    <div class="panel-heading" id="title_login">
                        <h3 class="panel-title">Bước 1: ĐĂNG KÝ ĐẦU TƯ</h3>
                    </div>
                    <div class="panel-body">
                        <p>Quý khách vui lòng nhập đầy đủ các thông tin dưới đây để Đăng ký đầu tư</p>     
                          <?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'contact-form',
							'enableClientValidation'=>true,
							'clientOptions'=>array(
								'validateOnSubmit'=>true,
							),
						)); ?>							
								<div class="form-group">
								  <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'Họ và tên *')); ?>
								</div>
									<div class="form-group">
	                                  <?php echo $form->error($model,'name',array('class'=>'error')); ?>
	                                </div>
								<div class="form-group">
								  <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'Email *')); ?>
								</div>
								    <div class="form-group">
	                                  <?php echo $form->error($model,'email',array('class'=>'error')); ?>
	                                </div>
								<div class="form-group">
								  <?php echo $form->textField($model,'telephone',array('class'=>'form-control','placeholder'=>'Số điện thoại *')); ?>
								</div>
								     <div class="form-group">
	                                  <?php echo $form->error($model,'telephone',array('class'=>'error')); ?>
	                                </div>
							
				
								   
								  <?php echo CHtml::submitButton('Đăng ký',array('class'=>'btn btn-success ')); ?>     
                  <p></p>
                  <p class="small" style="color: #aaa"><i>Nếu Quý khách đã đăng ký đầu tư tại Passion Investment, vui lòng nhập đúng Email và Họ tên đầy đủ đã đăng ký trước đó</i></p>
							</div>
							
						<?php $this->endWidget(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <?php Yii::app()->clientScript->registerCoreScript('jquery.ui') ?>
 
</body>

</html>
