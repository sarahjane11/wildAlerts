<?php
/* @var $this AnimalsController */
/* @var $model Animals */

//$this->breadcrumbs=array(
//	'Animals'=>array('index'),
//	'Manage',
//);
//
//$this->menu=array(
//	array('label'=>'List Animals', 'url'=>array('index')),
//	array('label'=>'Create Animals', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#animals-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Animals</h1>
        </div>

        <?php //echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div><!-- search-form -->
       
        <div class="row">
            
            <div class="form pull-right">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'csv-form',
                    'action'=> Yii::app()->createUrl('admin/animals/import') ,
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
                ?>


                <?php echo $form->errorSummary($model); ?>



                <div class="row">

                    <?php echo $form->labelEx($model, 'csvfile'); ?>
                    <?php //echo $form->fileField($model,'csvfile'); ?>
                    <?php
                            $this->widget('CMultiFileUpload', array(
                                  'model' => $model,
                                  'name' => 'csvfile',
                                   'max' => 1,
                                   'accept' => 'csv',
                                   'duplicate' => 'Duplicate file!',
                                   'denied' => 'Invalid file type',
                                    
                    ));
                    ?>
                    
                    <?php echo $form->error($model, 'csvfile'); ?>

                </div>

                <div class="row buttons">

                    <?php echo CHtml::submitButton('Upload CSV', array("id" => "Import", 'name' => 'Import','class'=>'btn btn-success pull-right')); ?>

                </div>

                <?php $this->endWidget(); ?>

            </div><!-- form -->
            <div>
                <p>Only upload .csv file. </p>
                <p>Example of file formate is given below.</p>
                <p>name,threat_level_id,category_id</p>
                <p>animalname,threat_level,category_name</p>
            </div>

        </div>
        
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
<?php
 
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'animals-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'columns' => array(
        //'id',
        'name',
        //'threat_level_id',
        //'category_id',
        array(
            'name' => 'threat_level_id',
            'value' => '$data->threatLevel->level',
        ),
        array(
            'name' => 'category_id',
            'value' => '$data->category->category',
        ),
        //'created_at',
        //'modified_at',
        /*
          'status',
         */
        array
            (
            'class' => 'CButtonColumn',
            'template' => '{view}{delete}{update}{Activate}{Deactivate}',
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
                    'url' => 'Yii::app()->createUrl("admin/animals/activate",array("id"=>$data->id))',
                    'visible' => '$data->status==0',
                //'options' => array( 'class'=> ' btn btn-success btn-sm'),
                ),
                'Deactivate' => array(
                    'label' => 'Deactivate',
                    'imageUrl' => Yii::app()->request->baseUrl . '/themes/wildalerts/img/inactive.png',
                    'url' => 'Yii::app()->createUrl("admin/animals/deactivate",array("id"=>$data->id))',
                    'visible' => '$data->status==1',
                //'options' => array( 'class'=> 'btn btn-danger btn-sm'), 
                ),
            ),
        )
    ),
));
?>
    </div>


</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->