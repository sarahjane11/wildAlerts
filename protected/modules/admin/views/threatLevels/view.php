<?php
/* @var $this ThreatLevelsController */
/* @var $model ThreatLevels */

$this->breadcrumbs=array(
	'Threat Levels'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ThreatLevels', 'url'=>array('index')),
	array('label'=>'Create ThreatLevels', 'url'=>array('create')),
	array('label'=>'Update ThreatLevels', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ThreatLevels', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ThreatLevels', 'url'=>array('admin')),
);
?>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Threat Levels</h1>
                </div>
                <div class="back_btn">
                    
                    <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>
                </div>
<div class="table_overflow_ctn">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions'=>array('class'=>'table table-striped table-bordered table-hover'),
	'attributes'=>array(
		//'id',
		//'level',
		//'color',
		//'created_at',
		//'modified_at',
		//'status',
            array(
                        'label'=>'level',
                        'type'=>'raw',
                        'value'=>$model->level,
                        
                ),
            array(
                        'label'=>'color',
                        'type'=>'raw',
                        'value'=>$model->color,
                        
                ),
                array(
                        'label'=>'Status',
                        'type'=>'raw',
                        'value'=> ($model->status == 0) ? "Deactive" : "Active",
                        
                ),
	),
)); ?>

                </div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->