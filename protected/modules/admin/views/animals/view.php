<?php
/* @var $this AnimalsController */
/* @var $model Animals */

//$this->breadcrumbs=array(
//	'Animals'=>array('index'),
//	$model->name,
//);
//
//$this->menu=array(
//	array('label'=>'List Animals', 'url'=>array('index')),
//	array('label'=>'Create Animals', 'url'=>array('create')),
//	array('label'=>'Update Animals', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Animals', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Animals', 'url'=>array('admin')),
//);
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Animals</h1>
                   
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
		//'name',
		//'threat_level_id',
		//'category_id',
		//'created_at',
		//'modified_at',
		//'status',
            array(
                        'label'=>'name',
                        'type'=>'raw',
                        'value'=>$model->name,
                        
                ),
            array(
                        'label'=>'threat_level_id',
                        'type'=>'raw',
                        'value'=>$model->threatLevel->level,
                        
                ),
            array(
                        'label'=>'category_id',
                        'type'=>'raw',
                        'value'=>$model->category->category,
                        
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