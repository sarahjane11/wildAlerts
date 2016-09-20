<?php
/* @var $this AnimalsController */
/* @var $model Animals */
/* @var $form CActiveForm */
?>

<div class="search-category wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'category_id'); ?>
		<?php echo $form->textField($model,'category_id',array('size'=>60,'maxlength'=>200)); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'threat_level_id'); ?>
		<?php echo $form->textField($model,'threat_level_id',array('size'=>60,'maxlength'=>200)); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->