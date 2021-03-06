
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wildalerts - Admin </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">WildAlerts Administration</h3>
                    </div>
                    <div class="panel-body">
			<?php $form=$this->beginWidget('CActiveForm', array(
			    	'id'=>'login-form',
			    	'enableClientValidation'=>true,
                                'enableAjaxValidation'=>false,
			    	'clientOptions'=>array(
			    		'validateOnSubmit'=>true,
			    	),
			    )); ?>
                     
				<div class="body bg-gray">
                    <div class="form-group">
                   
               			 <?php echo $form->textField($model, 'username',array('class'=>'form-control')); ?>
				<?php echo $form->error($model, 'username'); ?>
				</div>
				    <div class="form-group">
				 
				<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'password'); ?>   </div>          
				</div>
				<div class="footer">                                                               
				    <button type="submit" class="btn btn-lg btn-success btn-block">Sign in</button>  
				    
			       </div>

			 <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
.errorMessage {
    color: red;
    font-size: 12px;
}
</style>
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/assets/cd5859b/jquery.yiiactiveform.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/dist/js/sb-admin-2.js"></script>

</body>

</html>

