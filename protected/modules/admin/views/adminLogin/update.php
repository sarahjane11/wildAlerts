<?php
/* @var $this AdminLoginController */
/* @var $model AdminLogin */

$this->breadcrumbs=array(
	'Admin Logins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdminLogin', 'url'=>array('index')),
	array('label'=>'Create AdminLogin', 'url'=>array('create')),
	array('label'=>'View AdminLogin', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdminLogin', 'url'=>array('admin')),
);
?>

<h1>Update AdminLogin <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>