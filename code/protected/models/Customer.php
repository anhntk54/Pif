<?php
class Customer extends CustomerBase
{
  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'pi_customer';
  }
  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return CustomerBase the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }
  static function getAllCustomer(){
    $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_customer')
            ->order('date_registration desc')
            ->queryAll();
          return $data;
  }
  
  // Đếm toàn bộ số khách hàng đang có trong DB - TL 23/11/2016
  static function getTotalNumber(){
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_customer')
            ->queryAll();
    $count = count($data);
    return $count;
  }

  // Đếm toàn bộ số khách hàng với điều kiện - TL 29/11/2016
  static function getTotalNumberBy($iscontract){
    $where = "status =1 ";
       if($iscontract==1) {
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
       if($iscontract==2) {
         $where.="AND id NOT IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
        if($iscontract==3){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==-3){
         $where.="AND id NOT IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==4){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=1 )";
       }
       if($iscontract==5){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=3 )";
       }
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_customer')
            ->where($where)
            ->queryAll();
    $count = count($data);
    return $count;
  }
  // Đếm toàn bộ số khách hàng trong 7 ngày với điều kiện - TL 02/12/2016
  static function getTotalNumberWeek($iscontract){
    $where = "status =1 ";
       if($iscontract==1) {
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
       if($iscontract==2) {
         $where.="AND id NOT IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
        if($iscontract==3){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==-3){
         $where.="AND id NOT IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==4){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=1 )";
       }
       if($iscontract==5){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=3 )";
       }
    $where .= ' AND DATE(date_registration) > (NOW() - INTERVAL 7 DAY)';
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_customer')
            ->where($where)
            ->queryAll();
    $count = count($data);
    return $count;
  }
  // Đếm toàn bộ số khách hàng trong tháng với điều kiện - TL 02/12/2016
  static function getTotalNumberMonth($iscontract){
    $where = "status =1 ";
       if($iscontract==1) {
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
       if($iscontract==2) {
         $where.="AND id NOT IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
        if($iscontract==3){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==-3){
         $where.="AND id NOT IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==4){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=1 )";
       }
       if($iscontract==5){
         $where.="AND id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=3 )";
       }
    $where .= ' AND MONTH(date_registration) = MONTH(NOW())';
    $data = Yii::app()->db->createCommand()
            ->select("id")
            ->from('pi_customer')
            ->where($where)
            ->queryAll();
    $count = count($data);
    return $count;
  }

  static function getCustomerByName($name){
         $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_customer')
            ->Where('fullname like "%' . $name .'%"')
            ->queryAll();
          return $data;
  }
  /** 
  get Max Khách hàng ID 
  */
  static function findMaxID(){
     $max = Yii::app()->db->createCommand()
            ->select('max(id) as max')
            ->from('pi_customer')
            ->queryScalar();
      return $max;      
  } 
  /**
  /**
    Hàm tạo mã khách hàng AUTO
  */
  static function AutoMaKH($id) {
     if($id) {
       $model=Customer::model()->findByPk($id);
       $oldma=$model->code;
       if($oldma){
          $stt=substr($oldma,strpos($oldma,'-')+1);
            $maID=$stt+1;
            return $sAutoMaPi="PIKH-".$maID;
       }else {
           return $sAutoMaPi="PIKH-1";
       }
       
     }else {
        return $sAutoMaPi="PIKH-1";
     }
        
    }
   /**
   Nếu mã sinh ra tự động tồn tại thì phải tạo lại một mã khác
   */ 
   static function AutoMaKHUpdate($ma) {
      if($ma){
         $stt=substr($ma,strpos($ma,'-')+1);
         $maID=$stt+1;
          return $sAutoMaPi="PIKH-".$maID;
      }
   }
   // xử lí limit
   //update 17/08/2016
    static function getTotalNumberRow() {
        $criteria = new CDbCriteria;
        $criteria->select="*";
        $condition="status =1 ";
        $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
        $criteria->condition =  $condition;
        $results = Customer::model()->findAll($criteria);
        $count = count( $results );
        return $count;
    }
     static function getLimitCustomer($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $criteria->select="*";
        $condition="status =1 ";
        $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
        $criteria->condition =  $condition;
        $criteria->offset = ($page * $apage);
        $criteria->order="date_registration desc"; 
        $criteria->limit = $apage;
        $data = Customer::model()->findAll($criteria);
        return $data;

     }
     //xử lí limit filer
     //update 17/08/2016
      static function getLimitCustomerBy($page = 0, $apage = 0,$search,$iscontract,$isadmin) {
        $criteria = new CDbCriteria;
        $condition="status =1 ";
        if($iscontract==1) {
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
       if($iscontract==2) {
         $condition.="AND t.id NOT IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
       if($iscontract==3){
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==-3){
         $condition.="AND t.id  NOT IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==4){
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=1 )";
       }
       if($iscontract==5){
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=3 )";
       }
       if($iscontract==0){
        $condition.="";
       }
        if($search){
          $condition.='AND t.fullname like "%' . $search .'%" or t.email like "%' . $search .'%" or t.telephone like "%' . $search .'%"';
        }
        if($isadmin){
          $condition.='AND t.id_admin='.$isadmin;
        }

        $criteria->offset = ($page * $apage);
        $criteria->condition =  $condition;
        $criteria->order="date_registration desc"; 
        $criteria->limit = $apage;
        $data = Customer::model()->findAll($criteria);
      //  print_r($criteria);die();
        return $data;

       
     }
     static function getTotalNumberRowBy($search,$iscontract,$isadmin) {
       
       $criteria = new CDbCriteria;
       $condition="status =1 ";
       if($iscontract==1) {
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
       if($iscontract==2) {
         $condition.="AND t.id NOT IN (SELECT pi_contract.id_customer FROM pi_contract )";
       }
        if($iscontract==3){
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==-3){
         $condition.="AND t.id  NOT IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=2 )";
       }
       if($iscontract==4){
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=1 )";
       }
       if($iscontract==5){
         $condition.="AND t.id  IN (SELECT pi_contract.id_customer FROM pi_contract where pi_contract.status=3 )";
       }
        if($iscontract==0){
        $condition.="";
       }
        if($search){
          $condition.='AND t.fullname like "%' . $search .'%" or t.email like "%' . $search .'%" or t.telephone like "%' . $search .'%"';
        }
         if($isadmin){
          $condition.='AND t.id_admin='.$isadmin;
        }
         $criteria->condition =  $condition;
         $criteria->order="date_registration desc"; 
         $data = Customer::model()->findAll($criteria);
        return $data;
    }
    /**
    Create by: Hoang Trung
    Update:13/09/2016
    Mô tả: xử lý liên quan đến thùng rác của khách hàng
    */
    static function getTotalNumberRowTrash() {
        $criteria = new CDbCriteria;
        $criteria->select="*";
        $condition="status =2 ";
        $criteria->condition =  $condition;
        $results = Customer::model()->findAll($criteria);
        $count = count( $results );
        return $count;
    }
     static function getLimitCustomerTrash($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->distinct = true;
        $criteria->select="*";
        $condition="status =2 ";
        $criteria->condition =  $condition;
        $criteria->offset = ($page * $apage);
        $criteria->order="date_registration desc"; 
        $criteria->limit = $apage;
        $data = Customer::model()->findAll($criteria);
        return $data;

     }
}
