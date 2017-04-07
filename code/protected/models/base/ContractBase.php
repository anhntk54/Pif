<?php

/**
 * This is the model class for table "pi_contract".
 *
 * The followings are the available columns in table 'pi_contract':
 * @property string $id
 * @property string $number_form
 * @property integer $id_customer
 * @property integer $id_form
 * @property double $investment
 * @property double $investment_unit
 * @property double $convert_investment_units
 * @property integer $status
 * @property string $content_contract
 * @property string $date_created
 * @property string $date_modified
 * @property string $note
 */
class ContractBase extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pi_contract';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, number_form, id_customer, status', 'required'),
            array('id_customer, id_form, status', 'numerical', 'integerOnly'=>true),
            array('investment, investment_unit, convert_investment_units', 'numerical'),
            array('id, number_form', 'length', 'max'=>100),
            array('content_contract, date_created, date_modified, note', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, number_form, id_customer, id_form, investment, investment_unit, convert_investment_units, status, content_contract, date_created, date_modified, note', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'number_form' => 'Number Form',
            'id_customer' => 'Id Customer',
            'id_form' => 'Id Form',
            'investment' => 'Investment',
            'investment_unit' => 'Investment Unit',
            'convert_investment_units' => 'Convert Investment Units',
            'status' => 'Status',
            'content_contract' => 'Content Contract',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'note' => 'Note',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('number_form',$this->number_form,true);
        $criteria->compare('id_customer',$this->id_customer);
        $criteria->compare('id_form',$this->id_form);
        $criteria->compare('investment',$this->investment);
        $criteria->compare('investment_unit',$this->investment_unit);
        $criteria->compare('convert_investment_units',$this->convert_investment_units);
        $criteria->compare('status',$this->status);
        $criteria->compare('content_contract',$this->content_contract,true);
        $criteria->compare('date_created',$this->date_created,true);
        $criteria->compare('date_modified',$this->date_modified,true);
        $criteria->compare('note',$this->note,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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
}