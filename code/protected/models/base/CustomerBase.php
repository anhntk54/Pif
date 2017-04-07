<?php

/**
 * This is the model class for table "pi_customer".
 *
 * The followings are the available columns in table 'pi_customer':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $fullname
 * @property string $telephone
 * @property string $email_secondary
 * @property string $email_third
 * @property string $mst
 * @property string $cmt
 * @property string $cmt_datecreate
 * @property string $cmt_addresscreate
 * @property string $date_registration
 * @property integer $status
 * @property string $key_active
 * @property string $address_mac
 * @property string $new_password
 * @property string $date_login
 * @property string $code
 * @property string $code_active
 * @property string $address
 * @property string $numberbank
 * @property string $namebank
 * @property string $chinhanh
 * @property integer $id_admin
 * @property string $bankacount
 */
class CustomerBase extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pi_customer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, fullname', 'required'),
            array('status, id_admin', 'numerical', 'integerOnly'=>true),
            array('email, cmt_addresscreate, key_active, address_mac, code_active, address, numberbank, namebank, chinhanh, bankacount', 'length', 'max'=>255),
            array('password, fullname, telephone, email_secondary, email_third, mst, cmt, new_password, code', 'length', 'max'=>100),
            array('cmt_datecreate, date_registration, date_login', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, email, password, fullname, telephone, email_secondary, email_third, mst, cmt, cmt_datecreate, cmt_addresscreate, date_registration, status, key_active, address_mac, new_password, date_login, code, code_active, address, numberbank, namebank, chinhanh, id_admin, bankacount', 'safe', 'on'=>'search'),
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
            'password' => 'Password',
            'fullname' => 'Fullname',
            'telephone' => 'Telephone',
            'email_secondary' => 'Email Secondary',
            'email_third' => 'Email Third',
            'mst' => 'Mst',
            'cmt' => 'Cmt',
            'cmt_datecreate' => 'Cmt Datecreate',
            'cmt_addresscreate' => 'Cmt Addresscreate',
            'date_registration' => 'Date Registration',
            'status' => 'Status',
            'key_active' => 'Key Active',
            'address_mac' => 'Address Mac',
            'new_password' => 'New Password',
            'date_login' => 'Date Login',
            'code' => 'Code',
            'code_active' => 'Code Active',
            'address' => 'Address',
            'numberbank' => 'Numberbank',
            'namebank' => 'Namebank',
            'chinhanh' => 'Chinhanh',
            'id_admin' => 'Id Admin',
            'bankacount' => 'Bankacount',
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
        $criteria->compare('password',$this->password,true);
        $criteria->compare('fullname',$this->fullname,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('email_secondary',$this->email_secondary,true);
        $criteria->compare('email_third',$this->email_third,true);
        $criteria->compare('mst',$this->mst,true);
        $criteria->compare('cmt',$this->cmt,true);
        $criteria->compare('cmt_datecreate',$this->cmt_datecreate,true);
        $criteria->compare('cmt_addresscreate',$this->cmt_addresscreate,true);
        $criteria->compare('date_registration',$this->date_registration,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('key_active',$this->key_active,true);
        $criteria->compare('address_mac',$this->address_mac,true);
        $criteria->compare('new_password',$this->new_password,true);
        $criteria->compare('date_login',$this->date_login,true);
        $criteria->compare('code',$this->code,true);
        $criteria->compare('code_active',$this->code_active,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('numberbank',$this->numberbank,true);
        $criteria->compare('namebank',$this->namebank,true);
        $criteria->compare('chinhanh',$this->chinhanh,true);
        $criteria->compare('id_admin',$this->id_admin);
        $criteria->compare('bankacount',$this->bankacount,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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
}