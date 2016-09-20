<?php
/* @var $this AdminLoginController */
/* @var $model AdminLogin */

$this->breadcrumbs=array(
	'Admin Logins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AdminLogin', 'url'=>array('index')),
	array('label'=>'Create AdminLogin', 'url'=>array('create')),
	array('label'=>'Update AdminLogin', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdminLogin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdminLogin', 'url'=>array('admin')),
);
?>

<h1>View AdminLogin #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'is_authenticated',
		'status',
	),
)); ?>
