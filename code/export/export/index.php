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
	$query 	= "SELECT con.id, con.number_form, cus.fullname, cus.email, cus.telephone, con.investment, con.status, con.date_created, con.note  FROM `#__contract`  AS con LEFT JOIN `#__customer` AS cus ON con.id_customer=cus.id WHERE con.status>0 ORDER BY con.date_created ASC" ;
	$db->setQuery($query);
	$rows = $db->loadObjectList();
	echo count($rows);
	if(!isset($rows) && $rows==null) $warning = "Không có hợp đồng nào cả!";
	else{
		$titles[0]->id = 'ID';
		$titles[0]->number_form = 'Số HĐ';
		$titles[0]->fullname = 'Họ tên';
		$titles[0]->email = 'Email';
		$titles[0]->telephone = 'SĐT';
		$titles[0]->investment = 'Số tiền đầu tư';
		$titles[0]->status = 'Trạng thái hợp đồng';
		$titles[0]->date_created = 'Ngày tạo HĐ';
		$titles[0]->note = 'Ghi chú';

		$c = (object)array_merge((array)$titles, (array)$rows);
		$createExcel = exportExcel($c);
		if($createExcel)
			$success = "Download file excel <a href='download.php?file=".$createExcel."'>tại đây</a>";
	}
}
?>
<div id="notification">
	<?php if(isset($error) && $error!='') {?><p class="alert alert-danger"> <?php echo $error; ?> </p> <?php } ?>
	<?php if(isset($success) && $success!='') {?><p class="alert alert-success"> <?php echo $success; ?> </p> <?php } ?>
	<?php if(isset($warning) && $warning!='') {?><p class="alert alert-warning"> <?php echo $warning; ?> </p> <?php } ?>
</div>
