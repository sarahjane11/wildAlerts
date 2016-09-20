<?php
/* @var $this AccountsettingController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
    <?php $this->widget('userleftmenu'); ?>
</div>

<div class="col-xs-12 col-sm-9  inner_page_right"><p class="pull-right visible-xs">
  <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
</p>




<h1>Change password</h1>
 

<?php if(Yii::app()->user->hasFlash('success')){ ?>
    <div class="bg-success controlupdatess">  
         
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php } ?>


<?php echo $this->renderPartial('_formchangepassword', array('model'=>$model)); ?>

