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
                
                <div class="col-xs-3 bs-wizard-step complete">
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
                        <h3 class="panel-title">THÔNG BÁO</h3>
                    </div>
                    <div class="panel-body">
                       
                          <div class="alert alert-success">
                          	<p>Quý khách đã đăng ký Hợp tác đầu tư thành công. Vui lòng kiểm tra Email để hoàn thiện 2 bước cuối cùng</p>
                            <ul>
                              <li><b>Bước 3</b>: Quý khách sẽ nhận được email hướng dẫn chuyển khoản vào tài khoản Hợp tác kinh doanh của Passion Investment.</li>
                              <li><b>Bước 4</b>: Sau khi nhận được thông báo từ phía ngân hàng. Passion Investment sẽ hoàn tất thủ tục và gửi bản cứng hợp đồng cho Quý khách.</li>
                            </ul>
                            <p><br /></p>
                            <p><i>Nếu có bất cứ thắc mắc nào, xin vui lòng liên hệ HOTLINE <b><a href="tel:0915849235">0915.849.235</a></b></i></p>
                          </div>
                               
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</body>

</html>
