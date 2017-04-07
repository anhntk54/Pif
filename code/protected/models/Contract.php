<?php

/**
 * This is the model class for table "pi_contract".
 *
 * The followings are the available columns in table 'pi_contract':
 * @property integer $id
 * @property string $number_form
 * @property string $id_customer
 * @property integer $id_form
 * @property double $investment
 * @property double $investment_unit
 * @property double $convert_investment_units
 * @property integer $status
 * @property string $content_contract
 */
class Contract extends ContractBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_contract';
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 find hợp đồng trong trạng thái draff
	 */
	static function findContractByEmail($id){
        $data = Yii::app()->db->createCommand()
                ->select("*")
                ->from('pi_contract')
                ->where('id_customer="'.$id.'"')
                ->andWhere('status=0')
                ->queryAll();

        return $data;
	}
	/** 
	get Max contract ID 
	*/
	static function FindMax(){
        $data = Yii::app()->db->createCommand()
        ->select("max(id*1)")
        ->from('pi_contract')
        ->where("concat('',id * 1) = id")
        -> queryScalar();
        return $data;
  }
	/** 
	get Max contract ID 
	*/
	static function findMaxID(){
         $connection=Yii::app()->db;
         $sql="SELECT max(id*1) FROM pi_contract WHERE concat('',id * 1) = id";
         $command=$connection->createCommand();
         $command->text=$sql;
		 $max =$command->execute();  
		 return $max;      
	} 
	/**
	 check mã hợp đồng đã tồn tại hay chưa 
	 */
	static function checkMaHd($maHD) {
         $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->where('number_form="'.$maHD.'"')
            ->queryAll();
          return $data;
	}
  /**
  */
  static function getAllContract($id){
    $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->where('id_customer="'.$id.'"')
            ->order('date_created DESC')
            ->queryAll();
          return $data;
  }
	/**
	Get All tất cả danh sách hợp đồng by
	*/
    static function getAllContractBy($id,$value,$status,$type) {
       $order = '';
        if ($value == 0) {
            $order = 'date_created DESC ';
        }
        if ($value == 1) {
            $order = 'date_created DESC ';
        }
         if ($value == 2) {
            $order = 'date_created ASC ';
        }
        if ($value == 3) {
            $order = '(id*1) DESC ';
        }
         if ($value == 4) {
            $order = '(id*1) ASC ';
        }
        $condition='id_customer="'.$id.'"';
        if($status && $type){
           $condition.='AND status="'.$status.'" AND id_form="'.$type.'"';
           if($status==0){
            $condition.='AND id_form="'.$type.'"';
           }
           if($type==0){
             $condition.='AND status="'.$status.'"';
           }
           if($type==0 &&$status==0 ){
              $condition.='';
           }
        }else {
            if($status){
              $condition.='AND status="'.$status.'"';
             }
             if($status==0){
               $condition.='';
                }
             if($type){
                $condition.='AND id_form="'.$type.'"';
             }
             if($type==0){
                $condition.='';
             }
        }
        
        $criteria = new CDbCriteria;
        $criteria->condition =  $condition;
        $criteria->order= $order;
        $data = Contract::model()->findAll($criteria);
        return $data;
    }
    static function SaveDate($date) {
		 date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = str_replace('/', '-', $date);
        $temTime=strtotime($date);
        return  date('Y-m-d H:i:s',$temTime);
    }
    static function ViewDate($date) {
    	    date_default_timezone_set('Asia/Ho_Chi_Minh');
    	   $temTime=strtotime($date);
    	    return  date('d/m/Y H:i:s',$temTime);
    }
    /**
    Xử lý limit khách hàng
    */
   
    /**
    Code phần Admin
    */
    static function adGetAllContract() {
    	 $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->order('date_created DESC')
            ->queryAll();
          return $data;
    }
    static function getByStatus($status){
         $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->order('id desc')
            ->where('status="'.$status.'"')
            ->queryAll();
          return $data;
    }
    static function getByTT($id){
         $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->order('id desc')
            ->where('id_form="'.$id.'"')
            ->queryAll();
          return $data;
    }
     static function getByIDKH($id){
         $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->order('id desc')
            ->where('id_customer="'.$id.'"')
            ->queryAll();
          return $data;
    }
    static function getByMa($ma){
        $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->order('id desc')
            ->Where('number_form like "%' . $ma .'%"')
            ->queryAll();
          return $data;
    }
     /**
     Hàm tạo mã hợp đồng theo maxID của column ID
     param @ID
    */
   static function AutoMaPi($id) {
     if($id) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
       $sYear=date("Y");
      
       // $oldma=$id;
       
       // if(is_numeric($oldma)==true) {
       //    $MA=$oldma;
       // }else {
       //    preg_match('/\d+/', $oldma, $matches);
       //    $MA=$matches[0];
       // }
      // $stt=substr($oldma,strpos($oldma,'-')+1);
       $maID=$id;
       return $sAutoMaPi=$maID."/".$sYear."/HĐBCC";
     }else {
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $sYear=date("Y"); 
        return $sAutoMaPi="1/".$sYear."/"."HĐBCC";// 1/2016/HĐBCC
     }
        
    }
      /**
     Hàm tạo ra hợp đồng để in / Được view ra để in
    */
     static function GenHDView($content){
       $contents=str_replace("so_hd",".........",$content);
       $contents=str_replace("hd_date",".........",$contents);
       $contents=str_replace("hd_month",".........",$contents);
       $contents=str_replace("hd_address",".........",$contents);
       $contents=str_replace("hd_year",".........",$contents);
       $contents=str_replace("hd_cmt",".........",$contents);
       $contents=str_replace("hd_name",".........",$contents);
       $contents=str_replace("hd_created",".........",$contents);
       $contents=str_replace("hd_telephone",".........",$contents);
       $contents=str_replace("hd_mst",".........",$contents);
       $contents=str_replace("hd_mst",".........",$contents);
       $contents=str_replace("hd_email",".........",$contents);
       $contents=str_replace("hd_update_datest",".........",$contents);
       $contents=str_replace("hd_update_totalvalue",".........",$contents);
       $contents=str_replace("hd_update_dvdt",".........",$contents);
       $contents=str_replace("hd_up_date_one_dvdt",".........",$contents);
       $contents=str_replace("hd_up_date_one_dvdt",".........",$contents);
       $contents=str_replace("hd_update_money",".........",$contents);
       $contents=str_replace("hds_updates_moneys_text",".........",$contents);
       $contents=str_replace("hd_update_convertdvdt",".........",$contents);
       $contents=str_replace("hds_updates_convertdvdts_text",".........",$contents);
       $contents=str_replace("hd_update_date",".........",$contents);
       $contents=str_replace("hd_update_month",".........",$contents);
        $contents=str_replace("hd_update_year",".........",$contents);
        $contents=str_replace("hds_updates_dates_fn",".........",$contents);
        $contents=str_replace("hds_updates_months_fn",".........",$contents);
        $contents=str_replace("hds_updates_years_fn",".........",$contents);
		 $contents=str_replace("hd_banks",".........",$contents);
      $contents=str_replace("hd_bank_number",".........",$contents);
		  $contents=str_replace("hd_bankacount",".........",$contents);
       return $contents;
     }
    /**
    Nếu nhập bằng tay thì từ Mã hợp đồng tạo ra ID
    param $id:Chính lã maxID
    */
    static function AutoID($id){
        if($id) {
           // $newID="";
           // if(is_numeric($id)==true) {
           //    $newID=$id;
           // }else {
           //    preg_match('/\d+/', $id, $matches);
           //    $newID=$matches[0];
           // }
           $ID=$id +1;
           return $ID;
        }else {
            return $ID="1";
        }
    }
    /**
    Hàm lấy được ID từ mã hợp đồng nhập vào(nếu người dùng tự nhập vào)
    */
    static function GetIDAuto($maHD) {
      if($maHD) {
         $stt=substr($maHD,0,strpos($maHD,'/'));
         return $stt;
      }
    }
	 /**
   Xử lý phân trang
    */
    static function getTotalNumberRow() {
        $results = Contract::model()->findAll();
        $count = count( $results );
        return $count;
    }
   static function getLimitContract($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->offset = ($page * $apage);
		    $criteria->order="date_created DESC";
        $criteria->limit = $apage;
        $data = Contract::model()->findAll($criteria);
        return $data;
     }
  /**
  Lấy toàn bộ Hợp đồng sắp hết hạn - TL 07/12/2016
  */
  static function getAllContractExpiration($day=7){
    $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_contract')
            ->where('DATE(date_expiration) < (NOW() + INTERVAL '.$day.' DAY)')
            ->order('date_created DESC')
            ->queryAll();
          return $data;
  }
  // Lấy Hợp đồng sắp hết hạn theo từng trang - TL 07/12/2016
  static function getLimitContractExpiration($page = 0, $apage = 0, $day=7) {
        $criteria = new CDbCriteria;
        $criteria->where = "DATE(date_expiration) < (NOW() + INTERVAL ".$day." DAY)";
        $criteria->offset = ($page * $apage);
        $criteria->order="date_created DESC";
        $criteria->limit = $apage;
        $data = Contract::model()->findAll($criteria);
        return $data;
     }
     //Đếm số lượng để phân trang
      static function getLimitContractTotal($value=0,$status=0,$type=0,$ma) {
         $order = '';
        if ($value == 0) {
            $order = 'date_created DESC ';
        }
        if ($value == 1) {
            $order = 'date_created DESC ';
        }
         if ($value == 2) {
            $order = 'date_created ASC ';
        }
        if ($value == 3) {
            $order = '(t.id*1) DESC ';
        }
         if ($value == 4) {
            $order = '(t.id*1) ASC ';
        }
        $condition='';
        if($status!=null && $type!=null ){
           $condition='t.status="'.$status.'" AND id_form="'.$type.'"';
           if($status==0){
            $condition='id_form="'.$type.'"';
           }
           if($type==0){
             $condition='t.status="'.$status.'"';
           }
           if($type==0 &&$status==0 ){
              $condition='';
           }
        }else {
            if($status){
              $condition='t.status="'.$status.'"';
             }
             if($status==0){
               $condition='';
                }
             if($type){
                $condition='id_form="'.$type.'"';
             }
             if($type==0){
                $condition='';
             }
        }
        if($ma){
            $condition='t.number_form like "%' . $ma .'%" or c.fullname like "%' . $ma .'%" or c.telephone  like "%' . $ma .'%" ';
        }
        
        $criteria = new CDbCriteria;
         $criteria->select="*";
        $criteria->join="JOIN pi_customer c ON c.id=t.id_customer";
        $criteria->condition =  $condition;
        $criteria->order= $order;
        $data = Contract::model()->findAll($criteria);
        return $data;
     }
      static function getLimitContractBy($value=0,$page = 0, $apage = 0,$status,$type,$ma) {
        $order = '';
        if ($value == 0) {
            $order = 'date_created DESC ';
        }
        if ($value == 1) {
            $order = 'date_created DESC ';
        }
         if ($value == 2) {
            $order = 'date_created ASC ';
        }
        if ($value == 3) {
            $order = '(t.id*1) DESC ';
        }
         if ($value == 4) {
            $order = '(t.id*1) ASC ';
        }
        $condition='';
        if($status!=null && $type!=null ){
           $condition='t.status="'.$status.'" AND id_form="'.$type.'"';
           if($status==0){
            $condition='id_form="'.$type.'"';
           }
           if($type==0){
             $condition='t.status="'.$status.'"';
           }
           if($type==0 &&$status==0 ){
              $condition='';
           }
        }else {
            if($status){
              $condition='t.status="'.$status.'"';
             }
             if($status==0){
               $condition='';
                }
             if($type){
                $condition='id_form="'.$type.'"';
             }
             if($type==0){
                $condition='';
             }
        }
        if($ma){
            $condition='t.number_form like "%' . $ma .'%" or c.fullname like "%' . $ma .'%" or c.telephone  like "%' . $ma .'%" ';
        }
        
        $criteria = new CDbCriteria;  
        $criteria->select="*";
        $criteria->join="JOIN pi_customer c ON c.id=t.id_customer";
        $criteria->condition =  $condition;
        $criteria->offset = ($page * $apage);
        $criteria->order= $order;
        $criteria->limit = $apage;
        $data = Contract::model()->findAll($criteria);
        return $data;
     }
	  /**
     Chuyển từ tiếng việt có dấu sang không dấu
     */
     static function convert_vi_to_en($str){
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
       $str = preg_replace("/(Đ)/", 'D', $str);
  //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
       return $str;
     }
     /**
     Lấy fullName từ ID
     */
     static function getFullName($id){
        $cus=Customer::model()->findByPk($id);
        return $cus->fullname;
     }
     /**
     Set permission
     */
     static function getPermisson($id){
       $permission='';
       $contract=Contract::model()->findByPk($id);
        if($contract->status==1){
              $permission='edit';
         }
         return $permission;
     }
  
  // Đếm toàn bộ số hợp đồng đang có trong DB - TL 02/12/2016
  static function getTotalNumber(){
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_contract')
            ->queryAll();
    $count = count($data);
    return $count;
  }
  // Đếm toàn bộ số hợp đồng sắp hết hạn - TL 07/12/2016
  static function getTotalNumberExpiration($day=7){
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_contract')
            ->where('DATE(date_expiration) < (NOW() + INTERVAL '.$day.' DAY)')
            ->queryAll();
    $count = count($data);
    return $count;
  }

  // Đếm toàn bộ số hợp đồng với điều kiện - TL 02/12/2016
  static function getTotalNumberBy($status=null, $id_form=null){
    $where = '1';
    if(isset($status) && $status!='') $where .= " AND status=".$status;
    if(isset($id_form) && $id_form!='') $where .= " AND id_form=".$id_form;
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_contract')
            ->where($where)
            ->queryAll();
    $count = count($data);
    return $count;
}
  // Đếm toàn bộ số hợp đồng trong 7 ngày với điều kiện - TL 02/12/2016
  static function getTotalNumberWeek($status=null, $id_form=null){
    $where = '2';
    if(isset($status) && $status!='') $where .= " AND status=".$status;
    if(isset($id_form) && $id_form!='') $where .= " AND id_form=".$id_form;
    $where .= ' AND DATE(date_modified) > (NOW() - INTERVAL 7 DAY)';
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_contract')
            ->where($where)
            ->queryAll();
    $count = count($data);
    return $count;
  }
  // Đếm toàn bộ số hợp đồng trong tháng với điều kiện - TL 02/12/2016
  static function getTotalNumberMonth($status=null, $id_form=null){
    $where = '2';
    if(isset($status) && $status!='') $where .= " AND status=".$status;
    if(isset($id_form) && $id_form!='') $where .= " AND id_form=".$id_form;
    $where .= ' AND MONTH(date_modified) = MONTH(NOW())';
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_contract')
            ->where($where)
            ->queryAll();
    $count = count($data);
    return $count;
  }    
}
