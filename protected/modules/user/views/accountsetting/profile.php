<?php
/* @var $this AccountsettingController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
            <?php $this->widget('userleftmenu'); ?>
          
        </div>
       
        <div class="col-xs-12 col-sm-9  inner_page_right"><p class="pull-right visible-xs">
            <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
          </p>
          <h1>User Profile<?php  //echo $model->id; ?></h1>


<table class="table table-striped table-bordered table-hover">
        	<?php 
                        if(isset($model)){ ?>
                             <tr class="tr_<?php echo $model->id;?>">
                             <td>Name</td>
                             <td><?php echo $model['name'];?></td>
                             </tr>
                             <tr class="tr_<?php echo $model->id;?>">
                             <td>Email</td>
                             <td><?php echo $model['email'];?></td>
                             </tr>
                             
                     <?php   }
                
                
                
                        if(isset($getlocation)){   
                       foreach ($getlocation as $getlocation) {  ?>
                       <tr id="tr_<?php echo $getlocation->id;?>">
                                   <td><?php echo $getlocation->location_type; ?></td>
                                   <td>
                                       <div class="onoffswitch">
                                           <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch<?php echo $getlocation->id; ?>" data-user-id="" data-id="<?php echo $getlocation->id; ?>" <?php if($getlocation->alert_notification == 1) echo 'checked'; else echo ''; ?>>
                                             <label class="onoffswitch-label" for="myonoffswitch1<?php echo $getlocation->id;?>">
                                               <span class="onoffswitch-inner"></span>
                                               <span class="onoffswitch-switch"></span>
                                             </label>
                                       </div> 
                                    </td>
                       </tr>
                      <?php  }
                      
                       } ?>
    
</table>

</div>

<script>
   $('.onoffswitch-checkbox').check
   
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
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>