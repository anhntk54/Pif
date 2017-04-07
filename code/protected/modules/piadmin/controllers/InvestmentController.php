<?php

class InvestmentController extends Controller
{
	public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
    /**
    Mặc định sẽ chạy vào trang này và đưa ra danh sách các đơn vị đầu tư đang có
    */
	public function actionIndex()
	{ 
		 if(Yii::app()->session['adid']) {
		    	$param = Yii::app()->request->getParam('page');
		    	$page = (isset($param) ? $param - 1 : 0);
		    	$count = Investment::getTotalNumberRow();
		    	$pages = new CPagination($count);
		    	$apage = Yii::app()->params['pager'];
		    	$pages->setPageSize($apage);
		    	$data = Investment::getLimitInvestment($page, $apage);    
		 	$this->render('index',array('sus'=>2,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));

		 }
		
	}
	/**
	Thêm mới đơn vị đầu tư
	*/
	public function actionCreated(){
		if(Yii::app()->session['adid']) { 
			 $this->render('create');
		}else {
			header('Content-type: application/json');
                     echo CJSON::encode("You don't permission");
                    Yii::app()->end(); 
		}
	}
	/**
	Lưu lại đơn vị đầu tư
	*/
	public function actionSaveAD(){

		 if(Yii::app()->session['adid']) {  
		 	 if(isset($_POST)) { 	// lấy dữ liệu thông qua phương thức POST
               $date=$_POST['iv_date'];
                $date=str_replace('.', '', $date);// replace tất cả các ký tự trong dữ liệu
               $iv_totaltk=$_POST['iv_totaltk'];
                $iv_totaltk=str_replace('.', '', $iv_totaltk);
               $iv_totaldvdt=$_POST['iv_totaldvdt'];
                $iv_totaldvdt=str_replace('.', '', $iv_totaldvdt);
               $iv_onedvdt=$_POST['iv_onedvdt'];
                $iv_onedvdt=str_replace('.', '', $iv_onedvdt);
                 date_default_timezone_set('Asia/Ho_Chi_Minh');
               	$iv= Investment::model()->findAllByAttributes(array("date"=>Investment::SaveDate($date)));//kiểm tra xem ngày đã tồn tại trong csdl chưa
               	if($iv==null){ // Nếu ngày chưa tồn tại mới tiếp tục lưu trong csdl
 						 $model=new Investment; // Tạo mới đối tượng Investment
 						 $model->date=Investment::SaveDate($date); //Lưu lại date với định danh y-m-d
 						 $model->tongtkkinhdoanh=$iv_totaltk;
 						 $model->tongdvdt= $iv_totaldvdt;
 						 $model->motdvdt=$iv_onedvdt;
 						  if($model->save()) { 
 						  	 $param = Yii::app()->request->getParam('page');
							$page = (isset($param) ? $param - 1 : 0);
							$count = Investment::getTotalNumberRow();
							$pages = new CPagination($count);
							$apage = Yii::app()->params['pager'];
							$pages->setPageSize($apage);
							$data = Investment::getLimitInvestment($page, $apage);
							$this->render('index',array('sus'=>1,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
 						  }
               	}else {
							$param = Yii::app()->request->getParam('page');
							$page = (isset($param) ? $param - 1 : 0);
							$count = Investment::getTotalNumberRow();
							$pages = new CPagination($count);
							$apage = Yii::app()->params['pager'];
							$pages->setPageSize($apage);
							$data = Investment::getLimitInvestment($page, $apage);
							$this->render('index',array('sus'=>3,'data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));
               	}
		 	 }
		 }else {
		 	header('Content-type: application/json');
                     echo CJSON::encode("You don't permission");
                    Yii::app()->end(); 
		 }
	}
	/**
	Sửa đơn vị đầu tư->nhảy đến trang update.php
	*/
	public function actionEdits($id){ 
		if(Yii::app()->session['adid']) { 
			 $model=$this->loadModel($id);
			 $this->render('update',array(
			       'model'=>$model,"sus"=>0
		      ));
			}else {
				Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
			}
	}
	/**
	Sửa dữ liệu :Lấy dữ liệu Post để sửa
	*/
	public function actionEditss($id)
	{
		if(Yii::app()->session['adid']) { 
			 $model=$this->loadModel($id);
			 if(isset($_POST['Investment'])) {
			 	$model->attributes=$_POST['Investment'];
			 	$date=$_POST['Investment']['date'];
                    $date=str_replace('.', '', $date);
                $iv_totaltk=$_POST['Investment']['tongtkkinhdoanh'];
                   $iv_totaltk=str_replace('.', '', $iv_totaltk);
               $iv_totaldvdt=$_POST['Investment']['tongdvdt'];
                   $iv_totaldvdt=str_replace('.', '', $iv_totaldvdt);
               $iv_onedvdt=$_POST['Investment']['motdvdt'];
                $iv_onedvdt=str_replace('.', '', $iv_onedvdt);

                         $model->date=Investment::SaveDate($date);
 						 $model->tongtkkinhdoanh=$iv_totaltk;
 						 $model->tongdvdt= $iv_totaldvdt;
 						 $model->motdvdt=$iv_onedvdt;
                 if($model->save()) {
                 	 $this->render('update',array(
			          'model'=>$model,"sus"=>1
		             ));
                 }
			 }
		}else {
				Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));
		}
	}
	/**
	Xóa đơn vị đầu tư
	*/
	public function actionDeleteKH() {
    	 if(Yii::app()->session['adid']) { 
		 	$id=Yii::app()->request->getPost('id');
		   if($id) {
              if($this->loadModel($id)->delete()) {
                     echo 1;
              }else {
              	echo 0;
              }
		   }
               
		 
		 	
		 }else {
		 	
				Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));		
		 }
    }
	 public function loadModel($id)
	  {
		$model=Investment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	  }

	
}