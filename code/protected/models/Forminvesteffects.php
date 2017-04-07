<?php

/**
 * This is the model class for table "pi_forminvesteffects".
 *
 * The followings are the available columns in table 'pi_forminvesteffects':
 * @property integer $id
 * @property string $name
 * @property string $content
 */
class Forminvesteffects extends ForminvesteffectsBase
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pi_forminvesteffects';
	}

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function getForm(){
		$data = Yii::app()->db->createCommand()
            ->select("*")
            ->from('pi_forminvesteffects')
            ->queryRow();
          return $data;
	}
}
