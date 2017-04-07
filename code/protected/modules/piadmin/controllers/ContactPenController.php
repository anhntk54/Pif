<?php

class ContactPenController extends Controller
{
	 public function init() {
            parent::init();
             $this->layout='//layouts/admin';
    }
	public function actionIndex()
	{
		 if(Yii::app()->session['adid']) {
                $param = Yii::app()->request->getParam('page');
                $page = (isset($param) ? $param - 1 : 0);
                $count = Contactpen::getTotalNumberRow();
                $pages = new CPagination($count);
                $apage = Yii::app()->params['pager'];
                $pages->setPageSize($apage);
                $data = Contactpen::getLimitContactPen($page, $apage);    
            $this->render('index',array('data'=>$data,'page_size'=>$apage,'pages'=>$pages,'item_count'=>$count));

         }
	}

	public function actionUpdateStatus(){
		if(Yii::app()->session['adid']) { 
			$id=Yii::app()->request->getPost('id');
			$model=$this->loadModel($id);
			$model->status=2;
			if($model->save()){
				echo 1;
			}else {
				echo 0;
			}
		}
	}

   public function loadModel($id)
	{
		$model=Contactpen::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
}