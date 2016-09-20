<?php
/* @var $this ThreatLevelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Threat Levels',
);

$this->menu=array(
	array('label'=>'Create ThreatLevels', 'url'=>array('create')),
	array('label'=>'Manage ThreatLevels', 'url'=>array('admin')),
);
?>

<h1>Threat Levels</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
