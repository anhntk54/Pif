<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactPenForm extends CFormModel
{
	
	public $id;
	public $name;
	public $mst;
	public $cmt;
	public $cmt_datecreate;
	public $cmt_addresscreate;
	public $id_form;
	public $investment;
	public $numberbank;
	public $namebank;
	public $chinhanh;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name,id_form,cmt_datecreate,cmt_addresscreate,cmt,investment', 'required','message'=>"{attribute} không được để trống."),
			// email has to be a valid email address
			
			array('cmt,numberbank', 'length', 'max' => 100),
			array('cmt', 'numerical', 'integerOnly'=>true),
			

			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Mã capcha',
			'cmt'=>'Số CMTND',
			'cmt_datecreate'=>'Ngày cấp CMTND',
			'cmt_addresscreate'=>'Nơi cấp CMTND',
			'investment'=>'Vốn đầu tư',
			'numberbank'=>"Số tài khoản ngân hàng",
			'name'=>"Họ và tên",
			'id_form' =>"",
		);
	}
}