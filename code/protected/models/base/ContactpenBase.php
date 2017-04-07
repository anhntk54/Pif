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
 * @property string $numberbank
 * @property string $namebank
 * @property string $chinhanh
 */
class ContactpenBase extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pi_contactpen';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('status, id_form', 'numerical', 'integerOnly'=>true),
            array('investment', 'numerical'),
            array('email, numberbank, namebank, chinhanh', 'length', 'max'=>255),
            array('fullname, telephone, mst, cmt, cmt_addresscreate', 'length', 'max'=>100),
            array('cmt_datecreate, content_contract, date_created, date_modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, fullname, telephone, mst, cmt, cmt_datecreate, cmt_addresscreate, status, id_form, content_contract, date_created, date_modified, investment, numberbank, namebank, chinhanh', 'safe', 'on'=>'search'),
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
            'email' => 'Email',
            'fullname' => 'Fullname',
            'telephone' => 'Telephone',
            'mst' => 'Mst',
            'cmt' => 'Cmt',
            'cmt_datecreate' => 'Cmt Datecreate',
            'cmt_addresscreate' => 'Cmt Addresscreate',
            'status' => 'Status',
            'id_form' => 'Id Form',
            'content_contract' => 'Content Contract',
            'date_created' => 'Date Created',
            'date_modified' => 'Date Modified',
            'investment' => 'Investment',
            'numberbank' => 'Numberbank',
            'namebank' => 'Namebank',
            'chinhanh' => 'Chinhanh',
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
        $criteria->compare('email',$this->email,true);
        $criteria->compare('fullname',$this->fullname,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('mst',$this->mst,true);
        $criteria->compare('cmt',$this->cmt,true);
        $criteria->compare('cmt_datecreate',$this->cmt_datecreate,true);
        $criteria->compare('cmt_addresscreate',$this->cmt_addresscreate,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('id_form',$this->id_form);
        $criteria->compare('content_contract',$this->content_contract,true);
        $criteria->compare('date_created',$this->date_created,true);
        $criteria->compare('date_modified',$this->date_modified,true);
        $criteria->compare('investment',$this->investment);
        $criteria->compare('numberbank',$this->numberbank,true);
        $criteria->compare('namebank',$this->namebank,true);
        $criteria->compare('chinhanh',$this->chinhanh,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ContactpenBase the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}