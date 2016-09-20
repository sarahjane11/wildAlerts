<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<div class="col-lg-1"></div>
<div class="add-user add wild form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            
		<?php echo $form->labelEx($model,'name', array('class'=>'col-md-4 col-sm-4 col-xs-12')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200, 'class'=>'col-md-8 col-sm-8 col-xs-12')); ?>
		<?php echo $form->error($model,'name'); ?>
            
	</div>


	<div class="row">
            
             
                 
                 	<?php echo $form->labelEx($model,'status'); ?>
                    <?php echo $form->dropDownList($model,'status', array('1' => 'Activated', '0' => 'Deactivated')); ?>
                    <?php echo $form->error($model,'status'); ?>

                 
       
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->