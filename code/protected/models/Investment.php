<?php

/**
 * This is the model class for table "pi_investment".
 *
 * The followings are the available columns in table 'pi_investment':
 * @property integer $id
 * @property double $tongtkkinhdoanh
 * @property double $tongdvdt
 * @property double $motdvdt
 * @property string $date
 */
class Investment extends InvestmentBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_investment';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	 static function SaveDate($date) {
		 date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = str_replace('/', '-', $date);
        $temTime=strtotime($date);
        return  date('Y-m-d',$temTime);
    }
     static function ViewDate($date) {
    	    date_default_timezone_set('Asia/Ho_Chi_Minh');
    	   $temTime=strtotime($date);
    	    return  date('d/m/Y',$temTime);
    }
     /**
   Xử lý phân trang
    */
   // xử lí limit
    static function getTotalNumberRow() {
       
        $results = Investment::model()->findAll();
        $count = count( $results );
        return $count;
    }
     static function getLimitInvestment($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->offset = ($page * $apage);
		$criteria->order="date desc"; 
        $criteria->limit = $apage;
        $data = Investment::model()->findAll($criteria);
        return $data;

     }
     // update date 24-08-2016 by HoangTrung
     static function getMaxDate() {
         $data = Yii::app()->db->createCommand()
        ->select("max(date)")
        ->from('pi_investment')
        -> queryScalar();
        return $data;
     }
}
