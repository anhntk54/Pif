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

    <!-- Timeline CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/css/css.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/jquery/dist/jquery.min.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Xin chào, <?php echo Yii::app()->session['username'] ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a style="font-size: 15px;" href="tell:(04)32646480"><i class="fa fa-phone"></i>  (04).32.646.480</a>
                </li>
                  <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                      <?php 
                         if(Yii::app()->session['permission']=="nofull") {

                      ?>
                        <li>
                            <a href="<?php echo Yii::app()->request->baseUrl; ?>/Customer">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Cập nhập thông tin tài khoản
                                    
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                      <?php } ?>  
                       
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php  echo Yii::app()->createUrl("/Customer") ?>"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</a>
                        </li>
                        <li><a href="<?php  echo Yii::app()->createUrl("/Customer/forgot") ?>"><i class="fa fa-gear fa-fw"></i> Đổi mật khẩu</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php  echo Yii::app()->createUrl("/Login/Logout") ?>"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php  echo Yii::app()->createUrl("/Home/") ?>"><i class="fa fa-dashboard fa-fw"></i> Bảng tin</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-file-text-o"></i> Danh sách hợp đồng<span class="fa arrow"></a>
							
                            <ul class="nav nav-second-level">
							     <li>
                                    <a href="<?php  echo Yii::app()->createUrl("/Contract/AllContract") ?>"><i class="fa fa-file-text-o"></i>  Tất cả hợp đồng</a>
                                </li>
                                <li>
                                    <a href="<?php  echo Yii::app()->createUrl("/Contract/RegContractPending") ?>"><i class="fa fa-plus"></i>  Thêm hợp đồng mới</a>
                                </li>
                               
                            </ul>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-user"></i> Thông tin cá nhân <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php  echo Yii::app()->createUrl("/Customer") ?>"><i class="fa fa-user"></i>  Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a href="<?php  echo Yii::app()->createUrl("/Customer/forgot") ?>"><i class="fa fa-user"></i> Đổi mật khẩu</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a target="_blank" href="http://passioninvestment.vn/"><i class="fa fa-edit fa-fw"></i>  Website passioninvestment</a>
                        </li>
                        
                        
                            <!-- /.nav-second-level -->
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php echo $content ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
  <!--  <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/dist/js/sb-admin-2.js"></script>
    <!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?4EFqqR4jryvtSHFkQGyJqJ53aJK1MTrW";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
</body>

</html>
