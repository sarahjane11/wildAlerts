<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        
      <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/jquery/dist/jquery.min.js"></script>
<title>Wild Alerts</title>

</head>

<body >


<!--header start-->
<header>
<div class="container">
<?php 
if(BASE_PATH.'/site/ResetPassword?token='.Yii::app()->getRequest()->getQuery('token') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ){
 ?>
<!--<a href="#"><img src="<?php //echo Yii::app()->theme->baseUrl;?>/img/top-menu-img.png" alt="" title="" /></a>-->

<!--<button data-toggle="modal" data-target="login_register">Login</button>-->


<?php } else{ ?>
<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/appstore-icn-small.png" alt="" title="" /></a>
    <button class="logbtn" type="button" data-toggle="modal" data-target=".login_register" onclick="logintabactive()">
  Login
</button>

<?php } ?>

</div>
</header>
<!--header end-->
