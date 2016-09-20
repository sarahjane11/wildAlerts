<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<title>Wild Alerts</title>

    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" rel="stylesheet">
    
       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgf4FzsTWah_eYb0Eix9OKQ0lFFZXfTLI&signed_in=true&libraries=places&callback=initMap"
        async defer></script>

</head>

<body class="innerbody">


<!--header start-->
<header>
<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">

<div role="navigation" class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo Yii::app()->createUrl("/user/profile"); ?>" class="navbar-brand"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo.png"/></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if(BASE_PATH.'/user/profile' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ||BASE_PATH.'/user/profile?id='.Yii::app()->getRequest()->getQuery('id').'&triggarid='.Yii::app()->getRequest()->getQuery('triggarid') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ) echo 'active';?>"><a href="<?php echo Yii::app()->createUrl("/user/profile"); ?>">Home</a></li>
            
            
             <li class="dropdown notificationns">
                    
                        <?php $this->widget('AllNotificationWidget'); ?>
                       
                    <!-- /.dropdown-alerts -->
                </li>
            
            <li class="<?php if(BASE_PATH.'/user/accountsetting/profile' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/user/accountsetting/changepassword' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/user/userlocations' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ||BASE_PATH.'/user/notificationsettings' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/user/Userlocations/create' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/user/Userlocations/update/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url) echo 'active';?>" dropdown">
                
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo Yii::app()->user->getName();?> <i class="fa fa-caret-down"></i><b class="caret"></b></a>
              <ul class="dropdown-menu pull-right">
              
                <li><a href="<?php echo Yii::app()->createUrl('/user/accountsetting/profile');?>">Account settings</a></li>
                
                
                <!--<li><a href="<?php //echo Yii::app()->createUrl('/user/notificationsettings');?>">Notification setting</a></li>-->
                <li><a href="<?php echo Yii::app()->createUrl('/site/logout');?>">logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
</header>
<div class="row row-offcanvas row-offcanvas-left">
<!--header end-->



