<?php

class HomeController extends Controller
{
	public function init() {
    parent::init();
    $this->layout='//layouts/admin';
  }
  public function actionIndex()
  {
    if(Yii::app()->session['adid']) { 
      $cus=Customer::getAllCustomer();
      $contract=Contract::adGetAllContract();
      $countcus=0;$countC=0;$von=0;
      foreach($cus as $item) {
        if($item['status'] == 1) $countcus++;
      }
      foreach($contract as $item){
        $countC++;
        if($item['status'] == 2){
          $von=(double)$von+ (double)$item['investment'];
        }
      }
      $kh = new stdClass();
      // Đếm số khách hàng
      $kh->tongso    = Customer::getTotalNumber();
      $kh->hieuluc   = Customer::getTotalNumberBy(3);
      $kh->tiemnang  = Customer::getTotalNumberBy(-3);
      $kh->week_hieuluc   = Customer::getTotalNumberWeek(3);
      $kh->week_tiemnang  = Customer::getTotalNumberWeek(-3);
      $kh->month_hieuluc   = Customer::getTotalNumberMonth(3);
      $kh->month_tiemnang  = Customer::getTotalNumberMonth(-3);

      //Đếm số hợp đồng
      $hd = new stdClass();
      $hd->tongso    = Contract::getTotalNumber();
      $hd->hieuluc   = Contract::getTotalNumberBy(2);
      $hd->tattoan   = Contract::getTotalNumberBy(3);
      $hd->chochot   = Contract::getTotalNumberBy(1);
      $hd->camket    = Contract::getTotalNumberBy('',4);
      $hd->chiase    = Contract::getTotalNumberBy('',3);
      $hd->week_hieuluc    = Contract::getTotalNumberWeek(2);
      $hd->week_tattoan    = Contract::getTotalNumberWeek(3);
      $hd->week_chochot    = Contract::getTotalNumberWeek(1);
      $hd->week_camket     = Contract::getTotalNumberWeek('', 4);
      $hd->week_chiase     = Contract::getTotalNumberWeek('', 3);
      $hd->month_hieuluc    = Contract::getTotalNumberMonth(2);
      $hd->month_tattoan    = Contract::getTotalNumberMonth(3);
      $hd->month_chochot    = Contract::getTotalNumberMonth(1);
      $hd->month_camket     = Contract::getTotalNumberMonth('', 4);
      $hd->month_chiase     = Contract::getTotalNumberMonth('', 3);

       //update date 24/08/2016 by HoangTrung
      $dateMax=Investment::getMaxDate();
      $maxDate=Investment::model()->findByAttributes(array('date'=>$dateMax));
      $this->render('index',array("countcus"=>$countcus,"countC"=>$countC,"von"=>$von,"maxDate"=>$maxDate, "kh"=>$kh, "hd"=>$hd));


    }else {
      Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("/piadmin"));					
    }
  } 
}

?>