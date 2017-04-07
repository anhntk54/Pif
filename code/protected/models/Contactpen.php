<?php

/**
 * This is the model class for table "pi_contactpen".
 *
 * The followings are the available columns in table 'pi_contactpen':
 * @property integer $id
 * @property string $email
 * @property string $fullname
 * @property string $telephone
 * @property string $mst
 * @property string $cmt
 * @property string $cmt_datecreate
 * @property string $cmt_addresscreate
 * @property integer $status
 * @property integer $id_form
 * @property string $content_contract
 * @property string $date_created
 * @property string $date_modified
 * @property double $investment
 */
class Contactpen extends ContactpenBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_contactpen';
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	 
   // xử lí limit
    static function getTotalNumberRow() {
       
        $results = Contactpen::model()->findAll();
        $count = count( $results );
        return $count;
    }
     static function getLimitContactPen($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->offset = ($page * $apage);
		$criteria->order="id desc"; 
        $criteria->limit = $apage;
        $data = Contactpen::model()->findAll($criteria);
        return $data;

     }
     //
}
