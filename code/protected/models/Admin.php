<?php

/**
 * This is the model class for table "pi_admin".
 *
 * The followings are the available columns in table 'pi_admin':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $telephone
 * @property string $fullname
 * @property integer $role
 * @property string $position
 * @property string $new_password
 * @property string $address_mac
 */
class Admin extends AdminBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_admin';
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	static function getAll(){
		$data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_admin')
            ->order('id desc')
            ->queryAll();
          return $data;
	}
	//update 17/08/2016
	// xử lý limit
	 static function getTotalNumberRow() {
       
        $results = Admin::model()->findAll();
        $count = count( $results );
        return $count;
    }
     static function getLimitAdmin($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->offset = ($page * $apage);
		$criteria->order="id desc"; 
        $criteria->limit = $apage;
        $data = Admin::model()->findAll($criteria);
        return $data;

     }
	//xử lý limit filer
	 static function getLimitAdminBy($page = 0, $apage = 0,$search) {
        $criteria = new CDbCriteria;
        $condition="";
        if($search){
          $condition='fullname like "%' . $search .'%" or email like "%' . $search .'%" or telephone like "%' . $search .'%" ';
        }
        $criteria->offset = ($page * $apage);
        $criteria->condition =  $condition;
        $criteria->order="id desc"; 
        $criteria->limit = $apage;
        $data = Admin::model()->findAll($criteria);
        return $data;

     }
     static function getTotalNumberRowBy($search) {
       
       $criteria = new CDbCriteria;
        $condition="";
        if($search){
          $condition='fullname like "%' . $search .'%" or email like "%' . $search .'%" or telephone like "%' . $search .'%" ';
        }
         $criteria->condition =  $condition;
         $criteria->order="id desc"; 
         $data = Admin::model()->findAll($criteria);
        return $data;
    }
}
