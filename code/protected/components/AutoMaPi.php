<?php
class AutoMaPi {
    static function AutoMaPi($id) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
         $sMonth= date('m');
        if($sMonth < 10) {
           $sMonth="0"+$sMonth;
        }
        $sYear=date("y");
        $maID=$id+1;
        return $sAutoMaPi="MPI".$sMonth.$sYear.$maID;
    }
}
