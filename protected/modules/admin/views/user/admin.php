<?php
/* @var $this UserController */
/* @var $model User */

//$this->breadcrumbs=array(
//	'Users'=>array('index'),
//	'Manage',
//);
//
//$this->menu=array(
//	array('label'=>'List User', 'url'=>array('index')),
//	array('label'=>'Create User', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Users</h1>
                </div>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="bg-success controlupdatess">   
<?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
    echo '<ul class="flashes">';
    foreach($flashMessages as $key => $message) {
        echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
    }
    echo '</ul>';
}
?>
</div>
<div class="table_overflow_ctn">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'itemsCssClass' => 'table table-striped table-bordered table-hover',
	'columns'=>array(         
//                'id',
		'name',
		'email',
		/*'password',
		'facebook_id',
		'is_authenticated',
		
		'created_at',
		'modified_at',
		'status',
		*/
		array
                    (
                        'class'=>'CButtonColumn',
                        'template'=>'{view}{delete}{update}{Activate}{Deactivate}',
                        'buttons' => array(
                                        
                                        'view'=>array(
                                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/view.png',  
                                          ),
                                          'delete'=>array(
                                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/delete.png',  
                                          ),
                                          'update'=>array(
                                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/update.png',  
                                          ),
                                        
                                        'Activate' => array
                                            (
                                            'label' => 'Activate',
                                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/active.png',
                                            'url' => 'Yii::app()->createUrl("admin/user/activate",array("id"=>$data->id))',
                                            'visible' => '$data->status==0',
                                           // 'options' => array( 'class'=> ' btn btn-success btn-sm'),
                                        ),
                                        'Deactivate' => array(
                                            'label' => 'Deactivate',
                                            'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/inactive.png',
                                            'url' => 'Yii::app()->createUrl("admin/user/deactivate",array("id"=>$data->id))',
                                            'visible' => '$data->status==1',
                                           //'options' => array( 'class'=> 'btn btn-danger btn-sm'), 
                                        ),
                                    ),
                   )
                        

           ),
	
)); ?>
</div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->