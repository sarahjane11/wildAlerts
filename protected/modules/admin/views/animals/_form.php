<?php
/* @var $this AnimalsController */
/* @var $model Animals */
/* @var $form CActiveForm */
?>

<div class="add-animal add wild form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'animals-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php //echo $form->error($model,'name'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model, 'image');?>
		<?php echo $form->error($model,'image'); ?>
	</div>
        
        <div class="row">
                <?php //echo '<pre>'; print_r(Categories::model()->findAllByAttributes(array('status'=>'1')));?>
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Categories::model()->findAllByAttributes(array('status'=> 1)), 'id', 'category'));?>
                <?php echo $form->error($model,'category_id'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'threat_level_id'); ?>
		<?php echo $form->dropDownList($model, 'threat_level_id', CHtml::listData(ThreatLevels::model()->findAllByAttributes(array('status'=> 1)), 'id', 'level')); ?>
		<?php echo $form->error($model,'threat_level_id'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array('1' => 'Activated', '0' => 'Deactivated')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
