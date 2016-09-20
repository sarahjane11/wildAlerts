<?php
/* @var $this ThreatLevelsController */
/* @var $model ThreatLevels */

$this->breadcrumbs=array(
	'Threat Levels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ThreatLevels', 'url'=>array('index')),
	array('label'=>'Manage ThreatLevels', 'url'=>array('admin')),
);
?>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Threat Levels</h1>
                </div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

                        
                
 </div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->