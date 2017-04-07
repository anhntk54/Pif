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

<body>

    <div class="container">
        <div class="row">
             <div class="col-md-1">
                 
             </div>
            <div class="col-md-10" id="header_pi">
              <h1>KHU VỰC THÀNH VIÊN</h1></br>
                <h3>PASSION  INVESTMENT</h3>
            </div>
            <div class="col-md-1">
                
            </div>
        </div>
        <div class="row">
           <div class="col-md-4 col-md-offset-4">
              <div class="login-panel panel panel-default">
                  <div class="panel-heading">
                        <h3 class="panel-title">THÔNG BÁO</h3>
                 </div>
                 <div class="panel-body alert alert-success">
                 <p>Bạn đã đổi mật khẩu thành công trên Hệ Thống Website của PI</p>
                  <p>Bạn hãy check Email để có mật khẩu mới</p>
<p>Nhấn <a style="text-decoration: inherit;cursor: pointer;" onclick="javascript:  window.location.href='<?php echo Yii::app()->request->baseUrl.'/Login'; ?>';"title="">tại đây</a> để chuyển về khu vực đăng nhập!</p>
                 </div>
              </div>
           </div>
        </div>
    </div>
<footer>
   <div class="container">
    <div class="row">
      <div class="copyright">
        <span style="font-size: 14px;">Passion Investment version 1.0</span></br>
        <span style="font-size: 12px;">Technology Supported & SEO Service by <a target="_blank" href="http://ecpvn.com"> ECPVietnam </a></span>
      </div>
    </div>
   </div>
 </footer>
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/js/sb-admin-2.js"></script>

</body>

</html>
