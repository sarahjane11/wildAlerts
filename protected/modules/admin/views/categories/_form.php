<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<div class="update-category add  wild form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            
		<?php echo $form->labelEx($model,'category',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>200)); ?>
		<?php //echo $form->error($model,'category'); ?>
	</div>
        
	<div class="row">
           
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model,'status', array('1' => 'Activated', '0' => 'Deactivated')); ?>
		<?php echo $form->error($model,'status'); ?>
	
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->