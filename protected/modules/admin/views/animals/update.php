<?php
/* @var $this AnimalsController */
/* @var $model Animals */

//$this->breadcrumbs=array(
//	'Animals'=>array('index'),
//	$model->name=>array('view','id'=>$model->id),
//	'Update',
//);
//
//$this->menu=array(
//	array('label'=>'List Animals', 'url'=>array('index')),
//	array('label'=>'Create Animals', 'url'=>array('create')),
//	array('label'=>'View Animals', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Animals', 'url'=>array('admin')),
//);
?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Animals</h1>
                </div>
                <div>
                    
                    <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>
                </div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


</div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->