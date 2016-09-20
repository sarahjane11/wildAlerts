<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

//$this->breadcrumbs=array(
//	'Users',
//);
//
//$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
//);
?>


<?php //$this->widget('zii.widgets.CListView', array(
	//'dataProvider'=>$dataProvider,
	///'itemView'=>'_view',
//));
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
		<?php 
			$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'users-grid',
			'dataProvider' => $dataProvider,
			'pager' => array('class' => 'CLinkPager', 'cssFile' => false, 'header' => false),
			'columns' =>  array(
				array(
				'header' => Yii::t('app','Name'),
				'name' => 'name',
				'type' => 'raw',
				),
				array(
				'header' => Yii::t('app','Email'),
				'name' => 'email',
				'type' => 'raw',
				),
				array
                                (
                                    'class'=>'CButtonColumn',
                                    'template'=>'{update}  {delete}',
                                )
			),
			
			));
		?>
		
            </div>
           
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->