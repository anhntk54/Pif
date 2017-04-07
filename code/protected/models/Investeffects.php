<?php

/**
 * This is the model class for table "pi_investeffects".
 *
 * The followings are the available columns in table 'pi_investeffects':
 * @property integer $id
 * @property double $motdvdt
 * @property string $date
 */
class Investeffects extends InvesteffectsBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_investeffects';
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	 /**
   Xử lý phân trang
    */
   // xử lí limit
    static function getTotalNumberRow() {
       
        $results = Investeffects::model()->findAll();
        $count = count( $results );
        return $count;
    }
     static function getLimitInvesteffects($page = 0, $apage = 0) {
        $criteria = new CDbCriteria;
        $criteria->offset = ($page * $apage);
		$criteria->order="date desc"; 
        $criteria->limit = $apage;
        $data = Investeffects::model()->findAll($criteria);
        return $data;

     }
     //
     static function getALl() {
        $data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_investeffects')
            ->order('date ASC')
            ->queryAll();
          return $data;
     }
      static function ViewDate($date) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
           $temTime=strtotime($date);
            return  date('d/m',$temTime);
    }
     static function MailDate($date) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
           $temTime=strtotime($date);
            return  date('d-m-Y',$temTime);
    }
    static function getMaxDate() {
         $data = Yii::app()->db->createCommand()
        ->select("max(date)")
        ->from('pi_investeffects')
        -> queryScalar();
        return $data;
     }
}
