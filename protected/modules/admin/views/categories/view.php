<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Categories', 'url'=>array('index')),
	array('label'=>'Create Categories', 'url'=>array('create')),
	array('label'=>'Update Categories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Categories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Categories</h1>
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
		//'category',
		//'created_at',
		//'modified_at',
		//'status',
                 array(
                        'label'=>'category',
                        'type'=>'raw',
                        'value'=>$model->category,
                        
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