<?php
/* @var $this ThreatLevelsController */
/* @var $model ThreatLevels */
/* @var $form CActiveForm */
?>

<div class="search-threat wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>



	<div class="row">
		<?php echo $form->label($model,'level'); ?>
		<?php echo $form->textField($model,'level',array('size'=>50,'maxlength'=>50)); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'color'); ?>
		<?php echo $form->textField($model,'color'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->