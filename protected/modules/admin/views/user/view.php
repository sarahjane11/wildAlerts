<?php
/* @var $this UserController */
/* @var $model User */

//$this->breadcrumbs=array(
//	'Users'=>array('index'),
//	$model->name,
//);
//
//$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View User</h1>
                </div>
                <div class="back_btn">
                    
                    <?php echo CHtml::button('Back',array('onclick'=>'js:history.go(-1);returnFalse;','style'=>'font-size: 14px;font-weight: bold;','class'=>"btn btn-primary")); ?>
                </div>
<div class="table_overflow_ctn">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'htmlOptions'=>array('class'=>'table table-striped table-bordered table-hover'),
	'attributes'=>array(
//		//'id',
//		'name',
//		'email',
//		//'password',
//		'facebook_id',
//		'is_authenticated',
//		//'created_at',
//		//'modified_at',
//		'status',
            array(
                        'label'=>'Name',
                        'type'=>'raw',
                        'value'=>$model->name,
                        
                ),
            array(
                        'label'=>'Email',
                        'type'=>'raw',
                        'value'=>$model->email,
                        
                ),
            array(
                        'label'=>'Facebook ID',
                        'type'=>'raw',
                        'value'=>$model->facebook_id,
                        
                ),
            array(
                        'label'=>'Is Authenticated',
                        'type'=>'raw',
                        'value'=>($model->is_authenticated == 0) ? "Deactive" : "Active",
                        
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