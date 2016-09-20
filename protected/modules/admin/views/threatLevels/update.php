<?php
/* @var $this ThreatLevelsController */
/* @var $model ThreatLevels */

$this->breadcrumbs=array(
	'Threat Levels'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ThreatLevels', 'url'=>array('index')),
	array('label'=>'Create ThreatLevels', 'url'=>array('create')),
	array('label'=>'View ThreatLevels', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ThreatLevels', 'url'=>array('admin')),
);
?>



<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Threat Levels</h1>
                </div>
                <div>
                    
                    <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>
                </div>

<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>

                
 </div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->