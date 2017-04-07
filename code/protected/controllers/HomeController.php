<?php

class HomeController extends Controller
{
     public function init() {
            parent::init();
             $this->layout=('//layouts/main');
    }
    public function actionIndex()
    {
        if(Yii::app()->session['id']!==null) { 
         $id= Yii::app()->session['id'];
         $contract=Contract::getAllContract($id);
         $i=0;
         $count=0;
         foreach ($contract as $item) {
            $i++;
            $count=$count+$item['investment'];
         }
         //Update:16/09/2016
        $dateMax=Investment::getMaxDate();
        $maxDate=Investment::model()->findByAttributes(array('date'=>$dateMax));   
        $this->render('index',array("count_contract"=>$i,"count"=>$count,"maxDate"=>$maxDate));
        }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }      
    }
    public function actionErr(){
        if(Yii::app()->session['id']!==null) { 
         
        $this->render('err');
        }else {
          header('Content-type: application/json');
                     echo CJSON::encode("You can not access this page");
                    Yii::app()->end(); 
      }      

    }
    
}