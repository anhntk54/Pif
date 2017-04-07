<?php 

class ContactPenUserForm extends CFormModel
{
	public $name;
	public $email;
	public $telephone;
	public function rules()
	{
		return array(
			array('name, email, telephone', 'required','message'=>"{attribute} không được để trống."),
			array('email', 'email'),
			array('name,email,telephone', 'length', 'max' => 100),
			array('telephone','match','pattern'=>'/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/'),
			);
	}
	public function attributeLabels()
	{
		return array(
			'name'=>'Họ và tên',
			'email'=>'Email',
			'telephone'=>'Số điện thoại',
		);
	}
}
 ?>