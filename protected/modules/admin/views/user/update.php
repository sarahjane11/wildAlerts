<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Update User</h1>
                </div>
               <div>
                    
                    <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>
                </div>


<?php
/* @var $this UserController */
/* @var $model User */

//$this->breadcrumbs=array(
//	'Users'=>array('index'),
//	$model->name=>array('view','id'=>$model->id),
//	'Update',
//);
//
//$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>




<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>



    </div>
           
            
     </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->