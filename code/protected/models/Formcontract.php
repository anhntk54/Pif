<?php

/**
 * This is the model class for table "pi_formcontract".
 *
 * The followings are the available columns in table 'pi_formcontract':
 * @property integer $id
 * @property string $name
 * @property string $content_form
 */
class Formcontract extends FormcontractBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_formcontract';
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormcontractBase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	static function getAllForm($field='*'){
		 $data = Yii::app()->db->createCommand()
                    ->select($field)
                    ->from('pi_formcontract')
                    ->queryAll();
            return $data;
	}
	/**
	Load content_form 
	param @id
	*/
	static function getFormByID() {
		
	}
}
