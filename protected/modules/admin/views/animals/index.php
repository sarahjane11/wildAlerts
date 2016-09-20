<?php
/* @var $this AnimalsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Animals',
);

$this->menu=array(
	array('label'=>'Create Animals', 'url'=>array('create')),
	array('label'=>'Manage Animals', 'url'=>array('admin')),
);
?>

<h1>Animals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
