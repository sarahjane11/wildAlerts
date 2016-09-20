<?php
/* @var $this AnimalsController */
/* @var $model Animals */

//$this->breadcrumbs=array(
//	'Animals'=>array('index'),
//	'Create',
//);
//
//$this->menu=array(
//	array('label'=>'List Animals', 'url'=>array('index')),
//	array('label'=>'Manage Animals', 'url'=>array('admin')),
//);
?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Animals</h1>
                </div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->