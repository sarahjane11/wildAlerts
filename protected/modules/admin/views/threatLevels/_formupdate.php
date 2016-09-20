<?php
/* @var $this ThreatLevelsController */
/* @var $model ThreatLevels */
/* @var $form CActiveForm */
?>

<div class="add-threat add wild form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'threat-levels-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->textField($model,'level',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'color'); ?>
		
		<?php //echo $form->error($model,'color'); ?>
              <?php 
                        $this->widget('ext.SMiniColors.SActiveColorPicker', array(
                        'id' => 'myInputId',
                        //'defaultValue'=>'#000000',
                        'model' => $model,
                        'attribute' => 'color',
                        'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
                        'options' => array(), // jQuery plugin options
                        'htmlOptions' => array('value'=>(isset($model->color)) ? $model->color : "#ebd917"), // html attributes
                    ));
              
               ?>
                
               <?php echo $form->error($model,'color'); ?>
	</div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->