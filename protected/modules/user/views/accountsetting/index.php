<?php
/* @var $this AccountsettingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>



<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */?>


<div role="navigation" id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
          <div class="list-group">
            <a class="list-group-item active" href="#">Link</a>
            <a class="list-group-item" href="<?php echo Yii::app()->createUrl("/user/accountsetting/profile"); ?>">Profile</a>
            <a class="list-group-item" href="<?php echo Yii::app()->createUrl('/user/accountsetting/changepassword');?>">Change password</a>
            <a class="list-group-item" href="<?php echo Yii::app()->createUrl('/user/notificationsettings');?>">Notification settings</a>
           
          </div>
        </div>
       
        <div class="col-xs-12 col-sm-9"><p class="pull-right visible-xs">
            <button data-toggle="offcanvas" class="btn btn-primary btn-xs" type="button">Toggle nav</button>
          </p></div>
