<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách hợp đồng <button class="btn btn-success btn-xs" onclick="javascript:  window.location.href='<?php echo Yii::app()->request->baseUrl.'/Contract/RegContractPending'; ?>';" >Tạo mới hợp đồng</button></h1>
                </div>
                <!-- /.col-lg-12 -->
 </div>
 <div class="row">
     <div class="col-lg-12">
          <div class="panel ">
            <form method="POST" name="filter" action="<?php echo Yii::app()->request->baseUrl; ?>/Contract/Filter">
               <div class="row">
                   <div class="col-lg-3">
                        <div class="form-group">
                          <select name="typecontract" class="form-control" id="filter"  >
                            <option  value="0" <?php if(Yii::app()->session['type']==0 ){ echo 'selected' ;} ?>>---Xem tất cả loại hợp đồng---</option>
                            <?php
                              foreach($form as $item) { 
                             ?>
                            <option value="<?php echo $item['id'] ?>" <?php if(Yii::app()->session['type']==$item['id'] ){ echo 'selected' ;} ?>><?php echo $item['name'] ?></option>
      
                            <?php } ?>
                          </select>
                       </div>
                   </div>
                   <div class="col-lg-3">
                        <div class="form-group">
                          <select name="status" class="form-control" >
                            <option  value="0" <?php if(Yii::app()->session['status']==0){ echo 'selected' ;} ?>>---Xem tất cả trạng thái---</option>
                            <option value="1" <?php if(Yii::app()->session['status']==1){ echo 'selected' ;} ?>>Chờ chốt số</option>
                            <option value="2" <?php if(Yii::app()->session['status']==2){ echo 'selected' ;} ?> >Đã hiệu lực</option>
                            <option value="3" <?php if(Yii::app()->session['status']==3){ echo 'selected' ;} ?>>Đã tất toán</option>
                          </select>
                       </div>
                   </div>
                    <div class="col-lg-3">
                     
                        <div class="form-group">
                          <select class="form-control" name="filters" >
                            <option value="0" <?php if(Yii::app()->session['filters']==0){ echo 'selected' ;} ?> >--Sắp xếp--</option>
                            <option value="1" <?php if(Yii::app()->session['filters']==1){ echo 'selected' ;} ?>>Theo thời gian: mới nhất</option>
                            <option value="2" <?php if(Yii::app()->session['filters']==2){ echo 'selected' ;} ?>>Theo thời gian: lâu nhất</option>
                            <option value="3" <?php if(Yii::app()->session['filters']==3){ echo 'selected' ;} ?>>Theo số hợp đồng: cao đến thấp</option>
                            <option value="4" <?php if(Yii::app()->session['filters']==4){ echo 'selected' ;} ?>>Theo số hợp đồng: thấp đến cao</option>
                          </select>
                        </div>
                      
                   </div>
                   <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                   </div>
                  
                     
                    
                   
               </div>
             </form> 
             <p class="count_hd">Có <b><?php echo count($contract)  ?></b>  hợp đồng.</p>
            
               <?php if($contract){ ?>
                <div class="table-responsive">
                    <table class="table table-hover" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã hợp đồng</th>
                                <th>Email khách hàng</th>
                                <th>Loại hợp đồng</th>
                                <th>Số vốn đầu tư</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                          </thead>
                           <tbody>
                               <?php $i=1; ?>
                               <?php foreach ($contract as $item){ ?>
                                  <tr class="<?php echo $item['status']==1 ? 'danger':''?>
                                             <?php echo $item['status']==2 ? 'success':''?>
                                             <?php echo $item['status']==3 ? 'info':''?>
                                              ">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $item['number_form'] ?></td>
                                    <td><?php
                                        $cus=Customer::model()->findbyPK($item['id_customer']);
                                        echo $cus['email'] ?>
                                     </td>
                                    <td>
                                       <?php 
                                         $form=Formcontract::model()->findbyPK($item['id_form']);
                                         echo $form['name'];
                                        ?>
                                     </td>
                                    <td class="td_investment"><?php echo $item['investment']?></td>
                                    <td>
                                        <?php 
                                         if($item['status']==0) {
                                               echo "Bản nháp";
                                                }else if($item['status']==1) {
                                                  echo "Chờ chốt số liệu";
                                                }else if ($item['status']==2) {
                                                  echo "Đã hiệu lực";
                                                }else if($item['status']==3) {
                                                  echo "Đã tất toán";
                                                }

                                         ?>
                                     </td>
                                    <td><?php 
                                       $date=Contract::ViewDate($item['date_created']);
                                       echo  $date;
                                       ?>

                                    </td>
                                    <td class="icon_action">
                                    <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/Contract/Review/id/'.$item['id']; ?>" ><i class="fa fa-search" aria-hidden="true"></i></a>  
                                    <?php if($item['status']==1){ ?>
                                     <a style="cursor: pointer;text-decoration: underline;" href="<?php echo Yii::app()->request->baseUrl.'/Contract/Edits/id/'.$item['id']; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                                    <a style="cursor: pointer;text-decoration: underline;" onclick="DelHD(<?php echo $item['id'] ?>)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    <?php } ?>
                                    <a onclick="printDoc(<?php echo $item['id'] ?>)"><i class="fa fa-file-word-o" aria-hidden="true"></i></a>
                                    </td>
                                  </tr>

                               <?php $i++;  } ?>
                           </tbody>
                    </table>
                </div>
                <?php } else { ?>
        <div class="row">
          <div class="col-lg-12 alert alert-warning">
             <p>Quý khách chưa có hợp đồng nào với PI!</p>
          </div>
        </div>
                
                <?php } ?>
           


          </div>
     </div>
 </div>
 <!--Modal Kết quả -->
<div class="modal fade" id="contact_info" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
        <div id="status_sus">
            
          </div>
      </div>
      <div class="modal-footer">
      <input type="hidden" id="id_hd" value="" />
      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
     
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 <!--Modal Xóa -->
<div class="modal fade" id="contact_del" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
           Bạn có chắc muốn xóa hợp đồng này ?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delhd" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal in hợp đồng -->
 <div class="modal fade" id="content_hd" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
          
         <div id="content_print_hd">
           
         </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="id_delhd" value="" />
        <button onclick="DeleteHD()" class="btn btn-primary">Đồng ý</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.formatCurrency-1.4.0.min.js"></script>
<script>
 $( window ).load(function() {
    $('.td_investment').formatCurrency();
  });
   function DelHD(id){
        $('#contact_del').modal('show'); 
        $('#id_delhd').val(id);

   }
   function DeleteHD(){
     $('#contact_del').modal('hide');
     var id= $('#id_delhd').val(); 

     if(id!=null) { 
           $.ajax({ 
              type:"POST", 
              url:'<?php echo Yii::app()->request->baseUrl.'/Contract/DeleteHD' ?>', 
               data:{
                            id:id,
                          
                        },
               success:function(data){   
                     
                    if(data==1){
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Đã xóa hợp đồng thành công.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/Contract/AllContract';
                                 }, 2000);
                         
                    }
                    if(data==0) {
                         $('#contact_info').modal('show'); 
                         $('#status_sus').html('Không xóa được!.Hệ thống sẽ tải lại sau 5s');
                          setTimeout(function() {
                                    window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/Contract/AllContract';
                                 }, 2000);
                    }
               },                
           });
     }
   }

</script>
<script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/FileSaver.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/templates/js/jquery.wordexport.js"></script>
<script>
  function printDoc(id) {
       $.ajax({
             type:"POST", 
             url:'<?php echo Yii::app()->request->baseUrl.'/Contract/printHD';?>',
            data:
            {
              id:id,
            },
           success:function(data){   
             $("#divLoading").addClass('show');
                               setTimeout(function() {
                                     $("#divLoading").removeClass('show')   
                                      var obj=jQuery.parseJSON(data);
                                      $("#content_print_hd").html(obj.content);
                                       $("#content_print_hd").wordExport(obj.name);
                             }, 2000);
           
           
          },
           error: function (request, error) {
             alert("Lỗi không xuất được file word.");
           }
      });
      
    }
</script>
 <script >

//////////F12 disable code////////////////////////
    document.onkeypress = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
          
            return false;
        }
    }
    document.onmousedown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            
            return false;
        }
    }
document.onkeydown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
           
            return false;
        }
    }
    
/////////////////////end///////////////////////


//Disable right click script 
var message="Sorry! :3"; 
/////////////////////////////////// 
function clickIE() {if (document.all) {(message);return false;}} 
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) { 
if (e.which==2||e.which==3) {(message);return false;}}} 
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;} 
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;} 
document.oncontextmenu=new Function("return false") 
// 
function disableCtrlKeyCombination(e)
{
//list all CTRL + key combinations you want to disable
var forbiddenKeys = new Array('a', 'n', 'c', 'x', 'v', 'j' , 'w');
var key;
var isCtrl;
if(window.event)
{
key = window.event.keyCode;     //IE
if(window.event.ctrlKey)
isCtrl = true;
else
isCtrl = false;
}
else
{
key = e.which;     //firefox
if(e.ctrlKey)
isCtrl = true;
else
isCtrl = false;
}
//if ctrl is pressed check if other key is in forbidenKeys array
if(isCtrl)
{
for(i=0; i<forbiddenKeys.length; i++)
{
//case-insensitive comparation
if(forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase())
{
alert('Key combination CTRL + '+String.fromCharCode(key) +' has been disabled.');
return false;
}
}
}
return true;
}
 </script>


