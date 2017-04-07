<?php
defined('_JEXEC') or die('Restricted access');
class MySQL{
	function connect(){
		include_once('config/config.php');
		$config = new Config;
		$hostname_dbconnect = $config->hostname;
		$database_dbconnect = $config->database;
		$username_dbconnect = $config->username;
		$password_dbconnect = $config->password;
		$this->dbprefix 	= $config->dbprefix;
		$this->connection 	= mysql_connect($hostname_dbconnect, $username_dbconnect,$password_dbconnect) or
			die ("Could not connect to database");
		mysql_select_db($database_dbconnect, $this->connection) or
			die ("Could not select database");
		mysql_query("SET NAMES 'utf8'", $this->connection);
	}
	function setQuery($sql){
		$sql = preg_replace('/#__/', $this->dbprefix, $sql);
		$this->result = mysql_query ($sql, $this->connection) or die (mysql_error($this->connection));
	}
	function query($sql){
		$sql = preg_replace('/#__/', $this->dbprefix, $sql);
        mysql_query($sql, $this->connection) or die(mysql_error($this->connection));
    }
	function numRows(){
		return @mysql_numRows($this->result);
	}
	function loadResult(){
		if(!$this->result)
			return null;
		if($row = mysql_fetch_row($this->result))
			$result = $row[0];
		mysql_free_result($this->result);
		if(isset($result)) return $result;
	}
	function loadRow(){
		if(!$this->result)
			return null;
		if($row = mysql_fetch_row($this->result))
			$result = $row;
		mysql_free_result($this->result);
		return $result;
	}
	function loadResultArray(){
		if(!$this->result)
			return null;
		while($row = mysql_fetch_row($this->result))
			$result[] = $row;
		mysql_free_result($this->result);
		return $result;
	}
	function loadObject(){
		if(!$this->result)
			return null;
		$row = mysql_fetch_object($this->result);
		mysql_free_result($this->result);
		return $row;
	}
	function loadObjectList(){
		if(!$this->result)
			return null;
		while ($row = mysql_fetch_object($this->result)){
				$rows[] = $row;
		}
		mysql_free_result($this->result);
		return $rows;
	}
	function close(){
		mysql_close($this->connection);
	}
}
//Xây dựng thư viện phục vụ phân trang
//Viết code theo hướng đối tượng : sử dụng class
class thuvien
{
	//Tạo 2 thuộc tính: Tổng số phần tử, số phần tử/ 1 trang
	public $tong=0,$page=0;
	private $tongpage=0;//Tổng số trang tính đc: sử dụng nội bộ
	//1: Xây dựng phương thức (hàm) tính số lượng trang
	public function numpage()
	{
		//Tính số dữ giữa tong và page
		$sodu=$this->tong%$this->page;
		//Kiểm tra giá trị của số dư tính đc
		if($sodu==0) $this->tongpage=$this->tong/$this->page;
		else $this->tongpage=($this->tong-$sodu)/$this->page + 1 ;
	}
	public $link='';//Mẫu index.php?n=
	//2: Xây dựng phương thức (hàm) để in ra phần phân trang (các đường link)
	public $n;
	public function viewpage()
	{
		if($this->tongpage>1){
			//Sử dụng vòng lặp để in ra số lượng trang
			echo '<ul class="pagination">';
			for($i=1;$i<=$this->tongpage;$i++)
			{
				if($this->n==$i || (!isset($this->n) && $i==1))
					echo '<li class="active"><a href="'.$this->link.$i.'">'.$i.'</a></li>';
				else
					echo '<li><a href="'.$this->link.$i.'">'.$i.'</a></li>';
			}
			echo '</ul>';
		}
	}
}
function save_image($inPath){
		//Download images from remote server
		$time = getdate();
		$folder = $time['mday'].$time['mon'].$time['year'];
		$path = 'images/baiviet/';
		if(!is_dir($path.$folder))
			mkdir($path."$folder", 0777);
		$outPath = $path.$folder.'/baokinhdoanh'.$time[0].'.jpg';
    	$in=    fopen($inPath, "rb");
	    $out=   fopen($outPath, "wb");
	    while ($chunk = fread($in,8192))
	    {
    	    fwrite($out, $chunk, 8192);
	    }
    	fclose($in);
	    fclose($out);
		return $outPath;
	}

	function create_alias($str){
  		if(!$str) return false;
		$str = preg_replace("/ /",'-',$str);
		$str = strtolower($str);
   		$unicode = array(
      		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|A|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
      		'd'=>'đ|D|Đ',
      		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		    'i'=>'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
      		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
      		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ứ|Ử|Ữ|Ự',
      		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
   		);
		foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
		$str = preg_replace('/[^a-zA-Z0-9\-]/','',$str);
		return $str;
	}
	function create_name_img($str){
  		if(!$str) return false;
		$str = preg_replace("/ /",'_',$str);
		$str = strtolower($str);
   		$unicode = array(
      		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|A|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
      		'd'=>'đ|D|Đ',
      		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		    'i'=>'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
      		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
      		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ứ|Ử|Ữ|Ự',
      		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
   		);
		foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
		$str = preg_replace('/[^a-zA-Z0-9\_]/','',$str);

		return $str;
	}

	function create_folder(){
		$time = getdate();
		if(!is_dir('images/')) mkdir('images/', 0777);
					$path = 'images/';
					if(!is_dir($path.$time['year'].'/'.$time['mon'].'/'.$time['mday'].'/')){
							if(!is_dir($path.$time['year'].'/'.$time['mon'].'/')){
								if(!is_dir($path.$time['year']))
									mkdir($path.$time['year'], 0777);
								mkdir($path.$time['year']."/".$time['mon'], 0777);
							}
							mkdir($path.$time['year'].'/'.$time['mon'].'/'.$time['mday'], 0777);
					}
					$folder = $path.$time['year'].'/'.$time['mon'].'/'.$time['mday'].'/';
		return $folder;
	}
	function create_image_intro($inPath){
		$image = new SimpleImage();
	   $image->load($inPath);
	   $image->resizeToWidth(380);
	   $inPath = substr($inPath, 0, -4);
	   $outPath = $inPath.'_intro.jpg';
	   $image->save($outPath);
	   return $outPath;
	}
function get_danhsachhocsinh(){
	$db = new MySQL;
	$db->connect();
	$q = "SELECT * FROM `#__hocsinh` ORDER BY hoten ASC";
	$db->setQuery($q);
	$rows = $db->loadObjectList();
	$db->close();
	return $rows;
}
function get_hocsinh($id_hocsinh){
	$db = new MySQL;
	$db->connect();
	$q = "SELECT * FROM `#__hocsinh` WHERE id='$id_hocsinh'";
	$db->setQuery($q);
	$row = $db->loadObject();
	$db->close();
	return $row;
}
function add_hocsinh($item){
	if($item->id){
		$db = new MySQL;
		$db->connect();
		$item->ngaysinh = textToDate($item->ngaysinh);
		$q2 = "INSERT INTO `#__hocsinh` (`id`, `hoten`, `ngaysinh`, `lop`) VALUES ('$item->id', '$item->hoten', '$item->ngaysinh', '$item->lop')";
		$db->query($q2);
		$db->close();
		return 1;
	}
}
function add_hocphi($item){
	if($item->id_hocsinh){
		$db = new MySQL;
		$db->connect();
		$q2 = "INSERT INTO `#__hocphi` (`ten`, `tongtien`, `chitiet`, `id_hocsinh`) VALUES ('$item->ten', '$item->tongtien', '$item->chitiet', '$item->id_hocsinh')";
		$db->query($q2);
		$db->close();
		return 1;
	}
}
function get_maxid_hocsinh(){
    $db = new MySQL;
    $db->connect();
    $q = "SELECT id FROM `#__hocsinh` ORDER BY id DESC LIMIT 1";
    $db->setQuery($q);
    return $db->loadResult();
    $db->close();
}
function remove_hocsinh($id){
	$db = new MySQL;
	$db->connect();
	$q="DELETE FROM `#__hocsinh` WHERE `id`='$id'";
	$db->query($q);
	$db->close();
	/* $hocsinh = new stdClass;
	$hocsinh->id_hocsinh = $id;
	remove_hocsinh_lop($hocsinh); */
	return 1;
}
function remove_hocphi($id){
	$db = new MySQL;
	$db->connect();
	$q="DELETE FROM `#__hocphi` WHERE `id`='$id'";
	$db->query($q);
	$db->close();
	return 1;
}
function add_hocsinh_lop($item){
	$db = new MySQL;
	$db->connect();
	$q = "INSERT INTO `#__hocsinh_lop` (`id_hocsinh`, `id_lop`) VALUES ('$item->id_hocsinh', '$item->id_lop')";
	$db->query($q);
	$db->close();
	return 1;
}
function remove_hocsinh_lop($item){
	$db = new MySQL;
	$db->connect();
	$q="DELETE FROM `#__hocsinh_lop` WHERE `id_hocsinh`='$item->id_hocsinh' OR `id_lop`='$item->id_lop'";
	$db->query($q);
	$db->close();
	return 1;
}
function get_danhmuclop(){
	$db = new MySQL;
	$db->connect();
	$q = "SELECT DISTINCT lop FROM `#__hocsinh` ORDER BY lop ASC";
	$db->setQuery($q);
	$cats = $db->loadObjectList();
	$db->close();
	return $cats;
}
function get_danhmuchocphi(){
	$db = new MySQL;
	$db->connect();
	$q = "SELECT DISTINCT ten FROM `#__hocphi` ORDER BY ten ASC";
	$db->setQuery($q);
	$cats = $db->loadObjectList();
	$db->close();
	return $cats;
}
function get_lops(){
    $db = new MySQL;
    $db->connect();
    $q = "SELECT * FROM `#__lop` ORDER BY ten ASC";
    $db->setQuery($q);
    $cats = $db->loadObjectList();
    $db->close();
    return $cats;
}
function add_lop($item){
	$db = new MySQL;
	$db->connect();
	$q = "INSERT INTO `#__lop` (`ten`, `giaovien`, `hocphi`, `ghichu`) VALUES ('$item->ten', '$item->giaovien', '$item->hocphi', '$item->ghichu')";
	$db->query($q);
	$db->close();
	return 1;
}
function edit_lop($item){
	$db = new MySQL;
	$db->connect();
	$q = "UPDATE `#__lop` SET `ten`='$item->ten', `giaovien`='$item->giaovien', `hocphi`='$item->hocphi', `ghichu`='$item->ghichu' WHERE `id`='$item->id'";
	$db->query($q);
	$db->close();
	return 1;
}
function get_danhmuclop_cuagiaodich($id_giaodich){
	$db = new MySQL;
	$db->connect();
	$q = "SELECT l.* FROM `#__lop` AS l"
		." INNER JOIN `#__hocsinh_lop` AS hl ON l.id=hl.id_lop"
		." WHERE hl.state=1 AND hl.id_giaodich='$id_giaodich'"
		." ORDER BY ten ASC";
	$db->setQuery($q);
	$cats = $db->loadObjectList();
	$db->close();
	return $cats;
}
function get_danhmuclop_cuahocsinh($id_hocsinh, $dathanhtoan='0'){
	$where = " WHERE hl.id_hocsinh = '".$id_hocsinh."'";
	if($dathanhtoan == 1) $where .= " AND hl.state = 1";
	elseif ($dathanhtoan == 0) $where .= " AND hl.state = 0";
	$db = new MySQL;
	$db->connect();
	$q 	= "SELECT l.* FROM `#__lop` AS l "
		. " INNER JOIN `#__hocsinh_lop` AS hl ON l.id=hl.id_lop"
		. $where
		. " ORDER BY l.ten ASC";
	$db->setQuery($q);
	$cats = $db->loadObjectList();
	$db->close();
	return $cats;
}
function get_lop($id_lop){
	$db = new MySQL;
	$db->connect();
	$q = "SELECT * FROM `#__lop` WHERE id='$id_lop'";
	$db->setQuery($q);
	$row = $db->loadObject();
	$db->close();
	return $row;
}
function remove_lop($id){
	$db = new MySQL;
	$db->connect();
	$q="DELETE FROM #__lop WHERE id=$id";
	$db->query($q);
	$db->close();
	return 1;
}
function gettime_string(){
	date_default_timezone_set('Asia/Bangkok');
	return time();
}
function get_hocphi($id_hocphi){
    $db = new MySQL;
    $db->connect();
    $q = "SELECT * FROM `#__hocphi` WHERE id='$id_hocphi'";
    $db->setQuery($q);
    $row = $db->loadObject();
    $db->close();
    return $row;
}
function get_hocphi2($id_giaodich){
    $db = new MySQL;
    $db->connect();
    $q = "SELECT * FROM `#__hocphi` WHERE id_giaodich='$id_giaodich'";
    $db->setQuery($q);
    $row = $db->loadObject();
    $db->close();
    return $row;
}
function get_hocphichitiet($id_hocphi){
    $hocphi = get_hocphi($id_hocphi);
    $chitiet = preg_split('/[,;\n]/',$hocphi->chitiet);
    foreach($chitiet as $item){
        if($item != NULL) {
            $item = preg_split('/[=]/', $item);
            $tmp = new stdClass;
            $tmp->name = $item[0];
            $tmp->value = $item[1];
            $chitiethocphi[] = $tmp;
        }
    }
    return $chitiethocphi;
}
function get_hocphichitiet2($id_giaodich){
    $hocphi = get_hocphi($id_giaodich);
    $chitiet = preg_split('/[,;\n]/',$hocphi->chitiet);
    foreach($chitiet as $item){
        if($item != NULL) {
            $item = preg_split('/[=]/', $item);
            $tmp = new stdClass;
            $tmp->name = $item[0];
            $tmp->value = $item[1];
            $chitiethocphi[] = $tmp;
        }
    }
    return $chitiethocphi;
}
function get_hocphi_cuahocsinh($id_hocsinh, $dathanhtoan='2'){
    $where = " WHERE hp.id_hocsinh = '".$id_hocsinh."'";
    if($dathanhtoan == 1) $where .= " AND gd.state = '1'";
    elseif ($dathanhtoan == 0) $where .= " AND (gd.state = '0' OR hp.id_giaodich='')";
    $db = new MySQL;
    $db->connect();
    $q 	= "SELECT hp.*, gd.state AS giaodich_state FROM `#__hocphi` AS hp "
        . " INNER JOIN `#__hocsinh` AS hs ON hs.id=hp.id_hocsinh"
        . " LEFT JOIN `#__giaodich` AS gd ON gd.id=hp.id_giaodich"
        . $where
        . " ORDER BY hp.id ASC";
    $db->setQuery($q);
    $cats = $db->loadObjectList();
    $db->close();
    return $cats;
}
function hocsinh_exist($id_hocsinh){
    $db = new MySQL;
    $db->connect();
    $q = "SELECT id FROM `#__hocsinh` WHERE id='$id_hocsinh'";
    $db->setQuery($q);
    $id = $db->loadResult();
    $db->close();
    if($id) return 1;
    else return 0;
}
function get_danhsach_giaodich(){
	$db = new MySQL;
	$db->connect();
	$q 	= "SELECT gd.*,hs.hoten AS hs_hoten, hs.ngaysinh AS hs_ngaysinh, hs.lop AS lop_ten, hp.tongtien AS lop_hocphi FROM `#__giaodich` AS gd "
		. " INNER JOIN `#__hocphi` AS hp ON gd.id=hp.id_giaodich"
		. " INNER JOIN `#__hocsinh` AS hs ON hs.id=hp.id_hocsinh"
		. " ORDER BY id DESC";
	$db->setQuery($q);
	$rows = $db->loadObjectList();
	$db->close();
	return $rows;
}
function get_giaodich($id){
	$db = new MySQL;
	$db->connect();
	$q 	= "SELECT gd.*,hs.hoten AS hs_hoten, hs.ngaysinh AS hs_ngaysinh, hs.lop AS lop_ten, hp.ten AS hocphi_ten, hp.tongtien AS hocphi_tongtien FROM `#__giaodich` AS gd "
		. " INNER JOIN `#__hocphi` AS hp ON gd.id=hp.id_giaodich"
		. " INNER JOIN `#__hocsinh` AS hs ON hs.id=hp.id_hocsinh"
		. " WHERE gd.id = '$id'";
	$db->setQuery($q);
	$rows = $db->loadObject();
	$db->close();
	return $rows;
}
function add_giaodich($params){
    date_default_timezone_set('Asia/Bangkok');
    $time = time();
    $id_hocsinh		= $params['id_hocsinh'][0];
    $id_hocphi		= $params['khoahoc'][0];
    $hs = get_hocsinh($id_hocsinh);
    $hp = get_hocphi($id_hocphi);

    $hotenphuhuynh 	= $params['hotenphuhuynh'];
    $email			= $params['email'];
    $dienthoai		= $params['dienthoai'];
    $khoahoc		= $params['khoahoc'];
    $tongtien		= $params['amount'];
    $customer_ip_address		= $params['customer_ip_address'];
    $reference_number		= $params['reference_number'];
    $card_number		= $params['card_number'];
    $thoigian		= date('Y-m-d H:i:s', $time);
    $hs_id      = $hs->id;
    $hs_hoten   = $hs->hoten;
    $hs_ngaysinh = $hs->ngaysinh;
    $hs_lop     = $hs->lop;
    $hp_ten     = $hp->ten;
    $hp_tongtien = $hp->tongtien;
    $hp_chitiet = $hp->chitiet;

    $db = new MySQL;
    $db->connect();
    $id_giaodich = $reference_number;
    $sql_str = "INSERT INTO `#__giaodich`  (`id`,`hs_id`, `hs_hoten`, `hs_ngaysinh`, `hs_lop`, `hp_ten`, `hp_tongtien`, `hp_chitiet`, `hotenphuhuynh`, `email`, `dienthoai`, `tongtien`, `thoigian`, `customer_ip_address`, `reference_number`, `card_number`) VALUES ('$id_giaodich', '$hs_id', '$hs_hoten', '$hs_ngaysinh', '$hs_lop', '$hp_ten', '$hp_tongtien', '$hp_chitiet', '$hotenphuhuynh', '$email', '$dienthoai', '$tongtien', '$thoigian', '$customer_ip_address', '$reference_number', '$card_number')";
    $db->query($sql_str);
    foreach($khoahoc AS $id_khoahoc){
        $q = "UPDATE `#__hocphi` SET id_giaodich='$id_giaodich' WHERE id_hocsinh='$id_hocsinh' AND id='$id_khoahoc'";
        $db->query($q);
    }

    $db->close();
    return 1;
}
function save_giaodich($params){
	$db = new MySQL;
	$db->connect();
	$req_reference_number = $params['req_reference_number'];
	$q = "UPDATE `#__giaodich` SET state='1' WHERE id='$req_reference_number'";
	$db->query($q);
	$db->close();
	return 1;
}
function send_mail($params){
	$to = $params['req_bill_to_email'];
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	// Additional headers
	$headers .= 'From: Trường mầm non Họa Mi - Thanh Hóa <info@mamnonhoami.vn>' . "\r\n";
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$time = date('d/m/Y H:m:s', time());
	$item = get_giaodich($params['req_reference_number']);
	$hocphichitiet = get_hocphichitiet2($params['req_reference_number']);
	$subject = "[Hóa đơn] Hóa đơn thanh toán học phí - Trường mầm non Họa Mi - Thanh Hóa ";
	$body = '<table border="1" cellspacing="0" cellpadding="0" width="678" style="width:508.8pt;border:solid #999999 1.0pt">
<tbody>
<tr>
<td width="678" style="width:508.8pt;border:none;padding:7.5pt 7.5pt 7.5pt 7.5pt">
<table border="0" cellspacing="0" cellpadding="0" width="650" style="width:487.5pt">
<tbody>
<tr>
<td width="238" style="width:178.5pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">
<img src="http://ecpvietnam.com/sacombank/cambridge/payment_form/images/logo.jpg" width="200" height="105" class="CToWUd">
<span style="font-size:12.0pt"></span></p>
</td>
<td width="410" style="width:307.5pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<h2 style="margin-right:0cm;margin-bottom:3.75pt;margin-left:36.0pt;text-indent:0cm">
<span style="font-size:10.5pt;text-transform:uppercase">Trường mầm non Họa Mi - Thanh Hóa</span></h2>
<p style="margin-top:0cm;line-height:12.0pt;margin-left:36.0pt">Khu đô thị mới Đông Bắc Ga, TP Thanh Hóa<br>
ĐT: (0373) 719 719 | www.mamnonhoami.vn </p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td width="678" style="width:508.8pt;border:none;padding:7.5pt 7.5pt 7.5pt 7.5pt">
<h3 align="center" style="margin-right:0cm;margin-bottom:2.25pt;margin-left:36.0pt;text-align:center;text-indent:0cm">
<span style="font-size:15.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;">HÓA ĐƠN THU HỌC PHÍ</span></h3>
<p align="center" style="margin-top:0cm;text-align:center;line-height:12.0pt"><span style="font-size:9.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;"><span lang="FR" style="font-size:9.0pt;font-family:&quot;Tahoma&quot;,&quot;sans-serif&quot;">Thanh Hóa, Ngày '.$time.'</span></p>
</td>
</tr>
<tr>
<td width="678" style="width:508.8pt;border:none;padding:7.5pt 7.5pt 7.5pt 7.5pt">
<table border="0" cellspacing="0" cellpadding="0" width="650" style="width:487.5pt">
<tbody>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Phụ huynh:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'.$params['req_bill_to_forename'].'</span></strong><span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Email:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal"><a href="'.$params['req_bill_to_email'].'" target="_blank">'.$params['req_bill_to_email'].'</a><span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Điện thoại di động:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$params['req_bill_to_phone'].'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Phương thức thanh toán:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Thẻ tín dụng Visa</span></strong><span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Số thẻ:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$params['req_card_number'].'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Ngày hết hạn thẻ:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$params['req_card_expiry_date'].'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Authorization Code:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$params['auth_code'].'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Transaction ID:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$params['transaction_id'].'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="188" style="width:141.35pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Tình trạng thanh toán:<span style="font-size:12.0pt"></span></p>
</td>
<td width="462" style="width:346.15pt;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Thanh toán thành công</span></strong><span style="font-size:12.0pt"></span></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td width="678" style="width:508.8pt;border:none;padding:7.5pt 7.5pt 7.5pt 7.5pt">
<table border="0" cellspacing="0" cellpadding="0" width="650" style="width:487.5pt">
<tbody>
<tr>
<td width="320" style="width:240.0pt;padding:0cm 0cm 0cm 0cm">
<table border="1" cellspacing="0" cellpadding="0" width="653" style="width:490.1pt;border-top:solid #e5e5e5 1.0pt;border-left:none;border-bottom:none;border-right:solid #e5e5e5 1.0pt">
<tbody>
<tr>
<td width="653" colspan="2" style="width:490.1pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;background:#f9f9f9;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="center" style="text-align:center"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;text-transform:uppercase">THÔNG TIN HỌC SINH</span></strong><span style="text-transform:uppercase">
</span><span style="font-size:12.0pt;text-transform:uppercase"></span></p>
</td>
</tr>
<tr>
<td width="98" style="width:73.6pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Họ tên:<span style="font-size:12.0pt"></span></p>
</td>
<td width="555" style="width:416.5pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$item->hs_hoten.'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
<tr>
<td width="98" style="width:73.6pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Ngày sinh:<span style="font-size:12.0pt"></span></p>
</td>
<td width="555" style="width:416.5pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">';
if ( $item->hs_ngaysinh!='1970-01-01' && $item->hs_ngaysinh!='0000-00-00' && $item->hs_ngaysinh!='' && $item->hs_ngaysinh != Null)
	$body .= dateToText($item->hs_ngaysinh);
$body .= '<span style="font-size:12.0pt"></span></p>
</td>
</tr>

<tr>
<td width="98" style="width:73.6pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Lớp:<span style="font-size:12.0pt"></span></p>
</td>
<td width="555" style="width:416.5pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">'.$item->lop_ten.'<span style="font-size:12.0pt"></span></p>
</td>
</tr>
</tbody>
</table>
</td>
<td width="10" style="width:7.5pt;padding:0cm 0cm 0cm 0cm">
<p class="MsoNormal">&nbsp;<span style="font-size:12.0pt"></span></p>
</td>
<td width="320" style="width:240.0pt;padding:0cm 0cm 0cm 0cm"></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td width="678" style="width:508.8pt;border:none;padding:7.5pt 7.5pt 7.5pt 7.5pt">
<table border="1" cellspacing="0" cellpadding="0" width="650" style="width:487.5pt;border-top:solid #e5e5e5 1.0pt;border-left:none;border-bottom:none;border-right:solid #e5e5e5 1.0pt">
<tbody>
<tr>
<td colspan="5" style="border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;background:#f9f9f9;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="center" style="text-align:center"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;text-transform:uppercase">CHI TIẾT hỌC PHÍ</span></strong><span style="text-transform:uppercase">
</span><span style="font-size:12.0pt;text-transform:uppercase"></span></p>
</td>
</tr>
<tr>
<td width="41" style="width:30.95pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="center" style="text-align:center"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">STT</span></strong>
<span style="font-size:12.0pt"></span></p>
</td>
<td width="316" style="width:236.85pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Tên các phí đã đóng</span></strong>
<span style="font-size:12.0pt"></span></p>
</td>
<td width="78" style="width:58.2pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="center" style="text-align:center"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Số lượng</span></strong>
<span style="font-size:12.0pt"></span></p>
</td>
<td width="100" style="width:75.2pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Đơn giá (VND)</span></strong>
<span style="font-size:12.0pt"></span></p>
</td>
<td width="115" style="width:86.3pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">Thành tiền (VND)</span></strong>
<span style="font-size:12.0pt"></span></p>
</td>
</tr>';
foreach($hocphichitiet as $chitiet)
        $body .= '<tr><td>'.$chitiet->name.'</td><td class="text-right">'. _money_format($chitiet->value) .'</td></tr>';
$body .='<tr>
<td width="41" style="width:30.95pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="center" style="text-align:center">1<span style="font-size:12.0pt"></span></p>
</td>
<td width="316" style="width:236.85pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal">Đóng học phí <b>'.$item->hocphi_ten.'</b><span style="font-size:12.0pt"></span></p>
</td>
<td width="78" style="width:58.2pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="center" style="text-align:center">1<span style="font-size:12.0pt"></span></p>
</td>
<td width="100" style="width:75.2pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right">'._money_format($item->hocphi_tongtien).' <span style="font-size:12.0pt">
</span></p>
</td>
<td width="115" style="width:86.3pt;border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right">'._money_format($item->hocphi_tongtien).' <span style="font-size:12.0pt">
</span></p>
</td>
</tr>
<tr>
<td colspan="4" style="border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right">Phí giao dịch: <span style="font-size:12.0pt">
</span></p>
</td>
<td style="border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right">20.000 <span style="font-size:12.0pt">
</span></p>
</td>
</tr>
<tr>
<td colspan="4" style="border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right">Tổng tiền thanh toán:
<span style="font-size:12.0pt"></span></p>
</td>
<td style="border-top:none;border-left:solid #e5e5e5 1.0pt;border-bottom:solid #e5e5e5 1.0pt;border-right:none;padding:3.75pt 3.75pt 3.75pt 3.75pt">
<p class="MsoNormal" align="right" style="text-align:right"><strong><span style="font-family:&quot;Arial&quot;,&quot;sans-serif&quot;">'._money_format($params['req_amount']).'</span></strong>
<span style="font-size:12.0pt"></span></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>';
	//mail($to, $subject, $body, $headers);

require('plugins/phpmailer/PHPMailerAutoload.php');
//Create a new PHPMailer instance
//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
//Set who the message is to be sent from
$mail->setFrom('info@mamnonhoami.vn', 'Trường mầm non Họa Mi - Thanh Hóa');
//Set an alternative reply-to address
$mail->addReplyTo('info@mamnonhoami.vn', 'Trường mầm non Họa Mi - Thanh Hóa');
//Set who the message is to be sent to
$mail->addAddress($to);
//Set the subject line
$mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML($body);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}


	return 1;
}
function textToDate($text){
	$text = str_replace('/', '-', $text);
	$time = strtotime($text);
	$date = date("Y-m-d",$time);
	return $date;
}
function dateToText($date){
	$text = date("d/m/Y", strtotime($date));
	return $text;
}
function _money_format($number){
	return '<span>'.number_format($number, 0, ',', '.').'</span><sup>đ</sup>';
}
function get_today($format='Y-m-d H:i:s'){
	date_default_timezone_set('Asia/Bangkok');
	$time = time();
	return date($format, $time);
}
function resetString($string){
	return preg_replace('/\n/', '', $string);
}
function exportExcel($rows){
	if ($rows != null) {
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		require_once('plugins/phpexcel/PHPExcel.php');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("The Le")
				->setLastModifiedBy("The Le")
				->setTitle("The Le")
				->setSubject("The Le")
				->setDescription("The Le")
				->setKeywords("The Le")
				->setCategory("The Le");
		$i = 2;
		$cols = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
		foreach($rows as $row){
			$j=0;
			foreach($row as $value){
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue($cols[$j++].$i, $value);
			}
			$i++;
		}
		$objPHPExcel->getDefaultStyle()
					->getNumberFormat()
					->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		//save file excel
		$objWriter =  PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$file = 'tmp/DSHD_'.date("Y-m-d_H:i:s").'.xlsx';
		$objWriter->save($file);
		return $file;
	}
	return false;
}
?>