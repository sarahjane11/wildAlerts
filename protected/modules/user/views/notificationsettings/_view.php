<?php
/* @var $this NotificationsettingsController */
/* @var $data UserLocations */
?>

<div class="view">
 

	<b><?php //echo CHtml::encode($data->getAttributeLabel('id'),array('type'=>'hidden')); ?>
	<?php //echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('location_type')); ?>
	<?php echo CHtml::encode($data->location_type); ?> 
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('latitude')); ?>
	<?php //echo CHtml::encode($data->latitude); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('longitude')); ?>
	<?php //echo CHtml::encode($data->longitude); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('alert_notification')); ?>
	<?php echo CHtml::encode($data->alert_notification ==1 ? "Active" : 'Dactive' ); ?>
        <?php  echo CHtml::dropDownList('alert_notification','',array('1' => 'Activated', '0' => 'Deactivated'));?>
            
	<b><?php /*echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<?php 
	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_at')); ?>:</b>
	<?php echo CHtml::encode($data->modified_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>
            
</div>
