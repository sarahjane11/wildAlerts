<?php
/* @var $this UserlocationsController */
/* @var $model UserLocations */

$this->breadcrumbs=array(
	'User Locations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserLocations', 'url'=>array('index')),
	array('label'=>'Create UserLocations', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-locations-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
          <div class="list-group">
            <a class="list-group-item active" href="#">Link</a>
            <a class="list-group-item" href="<?php echo Yii::app()->createUrl("/user/accountsetting/profile"); ?>">Profile</a>
           <a class="list-group-item" href="<?php echo Yii::app()->createUrl('/user/accountsetting/changepassword');?>">Change password</a>
           <a class="list-group-item" href="<?php echo Yii::app()->createUrl('/user/userlocations');?>">Location settings</a>

           <a class="list-group-item" href="<?php echo Yii::app()->createUrl('/user/notificationsettings');?>">Notification settings</a>
           
          </div>
        </div>
       
        <div class="col-xs-12 col-sm-9  inner_page_right"><p class="pull-right visible-xs">
            <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
          </p>
          <div>
<h1>Manage User Locations</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php echo CHtml::link('Add Location',array('Userlocations/create')); ?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-locations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'user_id',
		'location_type',
		'description',
		//'latitude',
		//'longitude',
		'alert_notification',
		'status',
		
		 array
                    (
                    'class' => 'CButtonColumn',
                    'template' => '{view}{delete}{update}{Activate}{Deactivate}',
                    'buttons' => array(
                        'view'=>array(
                          'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/view.png',  
                        ),
                        'delete'=>array(
                          'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/delete.png',  
                        ),
                        'update'=>array(
                          'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/update.png',  
                        ),
                        
                        'Activate' => array
                            (
                            'label' => 'Activate',
                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/active.png',
                            'url' => 'Yii::app()->createUrl("admin/animals/activate",array("id"=>$data->id))',
                            'visible' => '$data->status==0',
                        //'options' => array( 'class'=> ' btn btn-success btn-sm'),
                        ),
                        'Deactivate' => array(
                            'label' => 'Deactivate',
                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/inactive.png',
                            'url' => 'Yii::app()->createUrl("admin/animals/deactivate",array("id"=>$data->id))',
                            'visible' => '$data->status==1',
                        //'options' => array( 'class'=> 'btn btn-danger btn-sm'), 
                        ),
                    ),
                )
	),
)); ?>
          </div>