<?php

/**
 * This is the model class for table "pi_investeffects".
 *
 * The followings are the available columns in table 'pi_investeffects':
 * @property integer $id
 * @property double $motdvdt
 * @property string $date
 * @property string $file
 * @property string $file_one
 * @property string $file_sc
 */
class InvesteffectsBase extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pi_investeffects';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('motdvdt', 'numerical'),
            array('date, file, file_one, file_sc', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, motdvdt, date, file, file_one, file_sc', 'safe', 'on'=>'search'),
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
            'motdvdt' => 'Motdvdt',
            'date' => 'Date',
            'file' => 'File',
            'file_one' => 'File One',
            'file_sc' => 'File Sc',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('motdvdt',$this->motdvdt);
        $criteria->compare('date',$this->date,true);
        $criteria->compare('file',$this->file,true);
        $criteria->compare('file_one',$this->file_one,true);
        $criteria->compare('file_sc',$this->file_sc,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InvesteffectsBase the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}