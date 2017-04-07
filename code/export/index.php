<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
if(!isset($_SESSION['adid']) || $_SESSION['adid']=='')
	header( "Location: /piadmin/Home" );
else{
	require_once('libraries/libraries.php');
	$db = new MySQL;
	$db->connect();
	$query 	= "SELECT con.number_form, cus.code, cus.fullname, cus.email, cus.telephone, con.investment, con.status, con.date_modified, con.date_expiration, con.id_form, cus.address, cus.mst, cus.cmt, cus.cmt_datecreate, cus.cmt_addresscreate, cus.bankacount, cus.numberbank, cus.namebank, cus.chinhanh, con.note  FROM `#__contract`  AS con LEFT JOIN `#__customer` AS cus ON con.id_customer=cus.id WHERE con.status>0 ORDER BY con.date_created ASC" ;
	$db->setQuery($query);
	$rows = $db->loadObjectList();
	if(!isset($rows) && $rows==null) $warning = "Không có hợp đồng nào cả!";
	else{
		$titles[0]->number_form = 'Số HĐ';
		$titles[0]->code = 'Mã khách hàng';
		$titles[0]->fullname = 'Họ tên';
		$titles[0]->email = 'Email';
		$titles[0]->telephone = 'SĐT';
		$titles[0]->investment = 'Số tiền đầu tư';
		$titles[0]->status = 'Trạng thái hợp đồng';
        $titles[0]->date_modified = 'Ngày ký HĐ';
        $titles[0]->date_expiration = 'Ngày hết hạn';
		$titles[0]->id_form = 'Hình thức HĐ';
        $titles[0]->address = 'Địa chỉ';
		$titles[0]->mst = 'Mã số thuế';
		$titles[0]->cmt = 'Chứng minh thư';
		$titles[0]->cmt_datecreate = 'Ngày cấp';
		$titles[0]->cmt_addresscreate = 'Địa chỉ cấp';
		$titles[0]->bankacount = 'Chủ tk ngân hàng';
		$titles[0]->numberbank = 'Số tài khoản';
		$titles[0]->namebank = 'Ngân hàng';
		$titles[0]->chinhanh = 'Chi nhánh';
		$titles[0]->note = 'Ghi chú';
        foreach($rows as $row){
            if($row->status == 1) $row->status = 'Chờ chốt sổ';
            elseif($row->status == 2) $row->status = 'Đang hiệu lực';
            elseif($row->status == 3) $row->status = 'Đã tất toán';
            if($row->id_form == 3) $row->id_form = 'Chia sẻ';
            elseif($row->id_form == 4) $row->id_form ='Cam kết';
        }

		$c = (object)array_merge((array)$titles, (array)$rows);
		$createExcel = exportExcel($c);
		if($createExcel)
			$success = "Download file excel <a href='download.php?file=".$createExcel."'>tại đây</a>";
	}
}
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

    <title>Trang quản lý thành viên Passion Investment - Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="/templates/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/templates/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/templates/dist/css/timeline.css" rel="stylesheet">
    

    <!-- Custom CSS -->
    <link href="/templates/dist/css/sb-admin-2.css" rel="stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- Morris Charts CSS -->
    <link href="/templates/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/templates/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/templates/css/css.css" rel="stylesheet">
    <link href="/templates/css/magicsuggest.css" rel="stylesheet">
    <link href="/templates/plugin/icheck/all.css" rel="stylesheet">
     <!-- jQuery -->
    <script src="/templates/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
    <script src="/templates/plugin/icheck/icheck.min.js"></script>
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
                <a class="navbar-brand" href="#">Xin chào, Thế Lê</a>
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
                       <!--  <li><a href="/piadmin"><i class="fa fa-user fa-fw"></i>Trang cá nhân</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i>Cài đặt</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="/piadmin/Login/Logout"><i class="fa fa-sign-out fa-fw"></i>Đăng xuất</a>
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
                            <a href="/piadmin/Home"><i class="fa fa-dashboard fa-fw"></i> Bảng tin</a>
                        </li>
                                               <li>
                            <a href="#"><i class="fa fa-users"></i> Quản lý khách hàng <span class="fa arrow"></a>
                            
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="/piadmin/Customer"><i class="fa fa-users"></i> Tất cả khách hàng</a>
                            </li>
                            <li>
                                <a href="/piadmin/Contract/CreateKH"><i class="fa fa-plus"></i> Tạo mới khách hàng </a>
                            </li>
                             <li>
                                <a href="/piadmin/Customer/Trash"><i class="fa fa-trash-o" aria-hidden="true"></i> Thùng rác </a>
                            </li>
                           </ul>
                        </li>
                                                <li>
                            <a href="#"><i class="fa fa-file-text-o"></i> Quản lý hợp đồng<span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="/piadmin/Contract"><i class="fa fa-file-text-o"></i> Tất cả hợp đồng</a>
                            </li>
                            <li>
                                <a href="/piadmin/Contract/CreateHD"><i class="fa fa-plus"></i> Tạo mới hợp đồng </a>
                            </li>
                           </ul>

                        </li>
						                         <li>
                            <a href="#"><i class="fa fa fa-money"></i> Quản lý ĐVĐT<span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="/piadmin/Investment"><i class="fa fa-file-text-o"></i> Tất cả ĐVĐT</a>
                            </li>
                            <li>
                                <a href="/piadmin/Investment/Created"><i class="fa fa-plus"></i> Tạo mới ĐVĐT </a>
                            </li>
                           </ul>

                        </li>
						                                                    <li>
                            <a href="#"><i class="fa fa-cc"></i> Quản lý HQĐT<span class="fa arrow"></span> </a>
                            <ul class="nav nav-second-level">
                             <li>
                                <a href="/piadmin/Investeffect"><i class="fa fa-file-text-o"></i> Tất cả HQĐT</a>
                            </li>
                            <li>
                                <a href="/piadmin/Investeffect/Created"><i class="fa fa-plus"></i> Tạo mới HQĐT </a>
                            </li>
                           </ul>

                        </li>
                                                                           <li>
                            <a href="/piadmin/ContactPen"><i class="fa fa-user"></i> Khách hàng đầu tư ngay </a>
                           

                        </li>
                                                 <!-- <li>
                            <a href="/piadmin"><i class="fa fa fa-money"></i> Quản lý hiệu quả đầu tư </a>
                        </li>
                        <li>
                            <a href="/piadmin"><i class="fa fa-table fa-fw"></i> Quản lý giá trị ĐVĐT </a>
                           
                        </li> -->
                                                 <li>
                            <a href="#"><i class="fa fa-user-secret"  aria-hidden="true"></i> Quản lý quản trị viên <span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                             <li>
                                <a href="/piadmin/Admin"><i class="fa fa-table fa-fw"></i> Tất cả quản trị viên</a>
                            </li>
                            <li>
                                <a href="/piadmin/Admin/Createad"><i class="fa fa-user-plus"></i> Tạo mới quản trị viên </a>
                            </li>
                           </ul>
                        </li>
                                                 <li>
                            <a target="_blank" href="/export/"><i class="fa fa-cloud-download fa-fw"></i> Backup dữ liệu</a>
                        </li>
                        <li>
                            <a target="_blank" href="http://passioninvestment.vn/"><i class="fa fa-edit fa-fw"></i> Website passioninvestment</a>
                        </li>
                        
                        
                            <!-- /.nav-second-level -->
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
                        <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Backup dữ liệu</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
    		<div id="notification">
				<?php if(isset($error) && $error!='') {?><p class="alert alert-danger"> <?php echo $error; ?> </p> <?php } ?>
				<?php if(isset($success) && $success!='') {?><p class="alert alert-success"> <?php echo $success; ?> </p> <?php } ?>
				<?php if(isset($warning) && $warning!='') {?><p class="alert alert-warning"> <?php echo $warning; ?> </p> <?php } ?>
			</div>
           
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   

    <!-- Bootstrap Core JavaScript -->
    <script src="/templates/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/templates/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
  <!--  <script src="/templates/bower_components/raphael/raphael-min.js"></script>
    <script src="/templates/bower_components/morrisjs/morris.min.js"></script>
    <script src="/templates/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="/templates/dist/js/sb-admin-2.js"></script>

</body>

</html>
