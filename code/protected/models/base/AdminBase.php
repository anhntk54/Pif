<?php

/**
 * This is the model class for table "pi_admin".
 *
 * The followings are the available columns in table 'pi_admin':
 * @property integer $id
 * @property string $password
 * @property string $email
 * @property string $telephone
 * @property string $fullname
 * @property integer $role
 * @property string $position
 * @property string $new_password
 * @property string $address_mac
 * @property string $email_send
 * @property string $signature
 * @property string $pass_email
 */
class AdminBase extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pi_admin';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('password, email, role', 'required'),
            array('role', 'numerical', 'integerOnly'=>true),
            array('password, email, telephone, fullname, new_password, email_send, pass_email', 'length', 'max'=>100),
            array('position, address_mac', 'length', 'max'=>255),
            array('signature', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, password, email, telephone, fullname, role, position, new_password, address_mac, email_send, signature, pass_email', 'safe', 'on'=>'search'),
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
            'password' => 'Password',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'fullname' => 'Fullname',
            'role' => 'Role',
            'position' => 'Position',
            'new_password' => 'New Password',
            'address_mac' => 'Address Mac',
            'email_send' => 'Email Send',
            'signature' => 'Signature',
            'pass_email' => 'Pass Email',
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
        $criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('telephone',$this->telephone,true);
        $criteria->compare('fullname',$this->fullname,true);
        $criteria->compare('role',$this->role);
        $criteria->compare('position',$this->position,true);
        $criteria->compare('new_password',$this->new_password,true);
        $criteria->compare('address_mac',$this->address_mac,true);
        $criteria->compare('email_send',$this->email_send,true);
        $criteria->compare('signature',$this->signature,true);
        $criteria->compare('pass_email',$this->pass_email,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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
}