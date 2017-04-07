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
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- Morris Charts CSS -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/css/css.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/css/magicsuggest.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/templates/plugin/icheck/all.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/plugin/icheck/icheck.min.js"></script>

    <script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/FileSaver.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.wordexport.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                <a class="navbar-brand" href="#">Xin chào, <?php echo  Yii::app()->session['adname'] ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                  <!-- /.dropdown -->
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       <!--  <li><a href="<?php  echo Yii::app()->createUrl("/piadmin") ?>"><i class="fa fa-user fa-fw"></i>Trang cá nhân</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i>Cài đặt</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="<?php  echo Yii::app()->createUrl("/piadmin/Login/Logout") ?>"><i class="fa fa-sign-out fa-fw"></i>Đăng xuất</a>
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
                            <a href="<?php  echo Yii::app()->createUrl("/piadmin/Home/") ?>"><i class="fa fa-dashboard fa-fw"></i> Bảng tin</a>
                        </li>
                       <?php  if(Yii::app()->session['adrole']==1 || Yii::app()->session['adrole']==2 ||Yii::app()->session['adrole']==3):  ?>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Quản lý khách hàng <span class="fa arrow"></a>
                            
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Customer") ?>"><i class="fa fa-users"></i> Tất cả khách hàng</a>
                            </li>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Contract/CreateKH") ?>"><i class="fa fa-plus"></i> Tạo mới khách hàng </a>
                            </li>
                             <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Customer/Trash") ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Thùng rác </a>
                            </li>
                           </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text-o"></i> Quản lý hợp đồng<span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Contract") ?>"><i class="fa fa-file-text-o"></i> Tất cả hợp đồng</a>
                            </li>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Contract/CreateHD") ?>"><i class="fa fa-plus"></i> Tạo mới hợp đồng </a>
                            </li>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Contract/Expiration") ?>"><i class="fa fa-bell"></i> Hợp đồng sắp hết hạn</a>
                            </li>
                           </ul>

                        </li>
                        <li>
                            <a href="#"><i class="fa fa fa-money"></i> Quản lý ĐVĐT<span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Investment") ?>"><i class="fa fa-file-text-o"></i> Tất cả ĐVĐT</a>
                            </li>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Investment/Created") ?>"><i class="fa fa-plus"></i> Tạo mới ĐVĐT </a>
                            </li>
                           </ul>

                        </li>
                        <?php endif; ?>
                           <?php  if(Yii::app()->session['adrole']==1 || Yii::app()->session['adrole']==2 || Yii::app()->session['adrole']==4):  ?>
                        <li>
                            <a href="#"><i class="fa fa-cc"></i> Quản lý HQĐT<span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Investeffect") ?>"><i class="fa fa-file-text-o"></i> Tất cả HQĐT</a>
                            </li>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Investeffect/Created") ?>"><i class="fa fa-plus"></i> Tạo mới HQĐT </a>
                            </li>
                           </ul>

                        </li>
                         <?php endif; ?>
                         <?php  if(Yii::app()->session['adrole']==1 || Yii::app()->session['adrole']==4): ?>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Customer/Report") ?>"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Gửi báo cáo tuần</a>
                            </li>
                            <?php endif; ?>
                        <?php  if(Yii::app()->session['adrole']==1): ?>
                         <li>
                            <a href="#"><i class="fa fa-user-secret"  aria-hidden="true"></i> Quản lý quản trị viên <span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                             <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Admin") ?>"><i class="fa fa-table fa-fw"></i> Tất cả quản trị viên</a>
                            </li>
                            <li>
                                <a href="<?php  echo Yii::app()->createUrl("/piadmin/Admin/Createad") ?>"><i class="fa fa-user-plus"></i> Tạo mới quản trị viên </a>
                            </li>
                           </ul>
                        </li>
                        <?php endif; ?>
                        <?php  if(Yii::app()->session['adrole']==1 || Yii::app()->session['adrole']==2): ?>
                         <li>
                            <a target="_blank" href="/export/"><i class="fa fa-cloud-download fa-fw"></i> Backup dữ liệu</a>
                        </li>
                    <?php endif; ?>
                        
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

</body>

</html>
