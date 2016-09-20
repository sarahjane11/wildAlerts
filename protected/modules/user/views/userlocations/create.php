<?php
/* @var $this UserlocationsController */
/* @var $model UserLocations */

$this->breadcrumbs=array(
	'User Locations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserLocations', 'url'=>array('index')),
	array('label'=>'Manage UserLocations', 'url'=>array('admin')),
);
?>
<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
          <?php $this->widget('userleftmenu'); ?>
         </div>
       
        <div class="col-xs-12 col-sm-9  inner_page_right"><p class="pull-right visible-xs">
            <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
          </p>
          <div>
<h1>Create UserLocations</h1>

 <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>

<?php echo $this->renderPartial('_formaddlocation', array('model'=>$model,'allLocation'=>$allLocation)); ?>
          </div>