<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update Category</h1>
                </div>
             <div>
                    
                    <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>
                </div>

<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categories', 'url'=>array('index')),
	array('label'=>'Create Categories', 'url'=>array('create')),
	array('label'=>'View Categories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>


</div>
           
            
     </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->