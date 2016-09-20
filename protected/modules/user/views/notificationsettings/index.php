<style>
    #toggle-two {
    display: none;
    visibility: hidden;
}
    
    
</style>

<?php
/* @var $this NotificationsettingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Notification',
);

$this->menu=array(
	array('label'=>'Create UserLocations', 'url'=>array('create')),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>

<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
          <div class="list-group">
             <?php $this->widget('userleftmenu'); ?>
          </div>
        </div>
       
        <div class="col-xs-12 col-sm-9  inner_page_right"><p class="pull-right visible-xs">
            <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
          </p>
          <div>
              <h1> Notification Setting</h1>
              
              <?php 
                        //$this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider,	'itemView'=>'_view',)); 


                       ?>
              <?php if(Yii::app()->user->hasFlash('error')){ ?>
                    <div class="bg-danger controlupdatess">  

                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                <?php } ?>
         </div>
        <div>
            
            <?php 
            $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'notification-form',
                    'action'=>Yii::app()->createUrl('/user/notificationsettings/savenotification'),
                    'enableAjaxValidation'=>false,
            )); 
            ?>
            
            
            
              <table class="table table-striped table-bordered table-hover">
                  <tr>
                      <th>Notification alert </th>
                      <th>Action</th>
                  </tr>
                  <tr>
                      <td>Email alerts</td>
                      <td> <div class="onoffswitch">
                              <input type="checkbox" name="email_alert" class="onoffswitch-checkbox" id="myonoffswitch" data-id="" data-user-id="<?php echo $model->id;?>" <?php if($model->email_alert == 1) echo 'checked'; else echo ''; ?> >
                                <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                                </label>
                                </div> 
                      </td>
                  </tr>
<!--                  <tr>
                      <td>Alert distance</td>
                      <td><input type="text" name="User[alert_distance]" id="User_alert_distance" value="<?php //echo $model->alert_distance ; ?>" data-user-id ="<?php //echo $model->id;?>" data-id="" >
                      
                      </td>
                  </tr>-->
                  <tr>
                      <td>Alert days</td>
                      <td><!--<input type="text" name="User[alert_days]" id="User_alert_days" value="<?php //echo $model->alert_days ; ?>">-->
                      
                          <select name="User[alert_days]" class="user-alert-days" data-user-id="<?php echo $model->id;?>">
                                <option value="" disabled="disabled" selected="selected"><?php echo $model->alert_days ; ?></option>
                                <option value="14">14</option>
                                <option value="13">13</option>
                                <option value="12">12</option>
                                <option value="11">11</option>
                                <option value="10">10</option>
                                <option value="9">09</option>
                                <option value="8">08</option> 
                                <option value="7">07</option>
                                <option value="6">06</option>
                                <option value="5">05</option>
                                <option value="5">04</option>
                                <option value="3">03</option>
                                <option value="2">02</option>
                                <option value="1">01</option>
                          </select>
                      
                      </td>
                  </tr>
                   <tr>
                      <th>Threats </th>
                      
                  </tr>
                  <?php if(isset($threats)){  
                      foreach ($threats as $threats) {  ?>
                       <tr id="tr_<?php echo $threats->id;?>">
                                   <td><?php echo $threats->level; 
                                                    $user_id=  Yii::app()->user->getId();
                                                $getDistance = ThreatNotificationSettings::model()->findByAttributes(array('threat_id'=>$threats->id,'user_id'=>$user_id));
                                                 
                                   
                                   ?></td>
                                   <td>
                                       <input type="text" name="Threatnotification[<?php echo $threats->id ; ?>]" id="Threatnotification_distance"  class="User_alert_distance" value="<?php if(isset($getDistance['distance'])) echo $getDistance['distance']; else echo '20' ; ?>" data-user-id ="" data-id="" > Miles
                                       <!--<input type="button" class="btn btn-primary notification-setting" name="save" value="Save"></input>-->
                                   </td>
                       </tr>
                      <?php  }
                       
                  }                  
                  ?>
                   
                  	<?php 
                        if(isset($all_user_location)){ ?>
                             <tr>
                                <th> Location  </th>
                                <th></th>
                      
                        </tr>
                   <?php    foreach ($all_user_location as $all_user_location1) {  ?>
                       <tr id="tr_<?php echo $all_user_location1->id;?>">
                                   <td><?php echo $all_user_location1->location_type; ?></td>
                                   <td>
                                       <div class="onoffswitch">
                                           <input type="checkbox" name="mycheckbox[]" value=""  class="onoffswitch-checkbox" id="myonoffswitch<?php echo $all_user_location1->id; ?>" data-user-id="" data-id="<?php echo $all_user_location1->id; ?>" <?php if($all_user_location1->alert_notification == 1) echo 'checked'; else echo ''; ?>>
                                            <label class="onoffswitch-label" for="myonoffswitch<?php echo $all_user_location1->id;?>">
                                               <span class="onoffswitch-inner" rel="<?php echo $all_user_location1->alert_notification; ?>" onclick="changevalue(this,'<?php echo $all_user_location1->id ?>')"></span>
                                               <span class="onoffswitch-switch" rel="0" onclick="changevalue(this,'<?php echo $all_user_location1->id ?>')"></span>
                                             </label>
                                            <input type="hidden" name="UserLocation[<?php echo $all_user_location1->id; ?>]" value="<?php echo $all_user_location1->alert_notification; ?>"  class="onoffswitch-checkbox" id="myinputOffswitch<?php echo $all_user_location1->id; ?>" />
                                           
                                       </div> 
                                    </td>
                       </tr>
                       
                      <?php  }
                      
                       } ?>
                       <tr>
                           <div class="row buttons">
                               <input type="submit" name="submit" value="Apply Changes" class="btn btn-primary pull-right"></input>
                           </div>
                       </tr>

              </table>    
              <?php $this->endWidget(); ?>
          </div>
          
       <?php    
//         $url =Yii::app()->baseUrl."/user/notificationsettings/changestatus/?require=partialview";
//          Yii::app()->clientScript->registerScript('onoffswitch-checkbox', "
//                $('.onoffswitch-checkbox').click(function(){
//                        var id = $(this).attr('data-id');
//                        var userid = $(this).attr('data-user-id');
//                        alert(userid);
//                        var status = '';
//                        if($(this).is(':checked')){
//                           status = 1;
//                                 
//                        }else{
//                           status= 0;
//                          
//                        }
//                        
//                        jQuery.ajax({
//                            'type' : 'POST',
//                            'url' : '".$url."',
//                            'data' : {
//                              'id' : id,'status':status,'userid':userid,
//                            },
//                            'success' : function(response){
//                                var response_data = JSON.parse(response); 
//                                 if(response_data.status==1){
//                                  // $('#onoffswitch5').prop( 'checked', true );
//                                    
//                                    //$('#onoffswitch5').load();
//                                 }else{
//                                  //$('#onoffswitch5').prop( 'checked', false );
//                                  
//                                   // $('#onoffswitch5').load();
//                                 }
//                             }
//                        });
//                         
//                        return false;
//                });
//
//     
//                ");
//          
//          $url1 = Yii::app()->baseUrl."/user/notificationsettings/changedistance/?require=partialview";
//          
//          Yii::app()->clientScript->registerScript('User_alert_distance', "
//                $('#User_alert_distance').mouseout(function(){
//                        var distance = $(this).val();
//                        if(distance > 50){
//                            alert('Max distance coannot be more than 50 miles');
//                            return false;
//                        }
//                        var userid = $(this).attr('data-user-id');
//                        //alert(userid);
//                        jQuery.ajax({
//                            'type' : 'POST',
//                            'url' : '".$url1."',
//                            'data' : {
//                              'userid':userid,'distance':distance,
//                            },
//                            'success' : function(response){
//                                var response_data = JSON.parse(response); 
//                                 if(response_data.status==1){
//                                  
//                                 }else{
//                                  
//                                 }
//                             }
//                        });
//                         
//                        return false;
//                });
//
//     
//                ");
//          
//          $url2 = Yii::app()->baseUrl."/user/notificationsettings/changedays/?require=partialview";
//                 Yii::app()->clientScript->registerScript('user-alert-days', "
//                $('.user-alert-days').change(function(){
//                    
//                        var days = $(this).val();
//                        
//                        var userid = $(this).attr('data-user-id');
//                        
//                        jQuery.ajax({
//                            'type' : 'POST',
//                            'url' : '".$url2."',
//                            'data' : {
//                              'userid':userid,'days':days,
//                            },
//                            'success' : function(response){
//                                var response_data = JSON.parse(response); 
//                                 if(response_data.status==1){
//                                  
//                                 }else{
//                                  
//                                 }
//                             }
//                        });
//                         
//                        return false;
//                });
//
//     
//                ");

          
          
          ?>
          
        </div>



<script>
   //$('.onoffswitch-checkbox').check
   
   
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script>
    
    function changevalue(element,id){
          var rel=$(element).attr('rel');
          if(rel=='1'){
              $(element).attr('rel','0');
              $("#myonoffswitch"+id).val('0');
             $("#myinputOffswitch"+id).val('0');
          }else{
               $(element).attr('rel','1');
               $("#myonoffswitch"+id).val('1');
              $("#myinputOffswitch"+id).val('1');
          }
//        alert(id);
//         
//        alert($("#myinputOffswitch"+id).val());
    }
    


</script>
<style>
           .onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
    }
    .onoffswitch-checkbox {
    display: none;
    }
    .onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
    }
    .onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
    }
    .onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
    }
    .onoffswitch-inner:before {
    content: "ON";
    padding-left: 10px;
    background-color: #405EBD; color: #FFFFFF;
    }
    .onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
    }
    .onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 56px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
    }
    .onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
    }
</style>