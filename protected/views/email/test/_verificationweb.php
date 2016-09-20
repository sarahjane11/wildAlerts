                            	                            	                            	<html>
<head>
 <title>Welcome to Wildalerts | Email Verification </title>
</head>
<body>
<div style="width: 600px; margin: 10px; padding: 12px; border-radius: 10px; background: none repeat scroll 0px 0px rgb(207, 255, 191); box-shadow: 0px 0px 9px -2px gray !important;">
<div style="height: 45px !important;"><img style="height: 45px !important;" src="<?php  echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;  ?>/img/logo.png"/></div>
<div style="margin-top: 15px; padding: 17px; border: 1px dashed rgb(211, 211, 211);">
<p>Dear <?php echo ucwords($name); ?></p>
    <?php
        //$appLink=base64_encode("uersVarification://com.talentelgia.WildAlerts?token=".$keystring);  
         
        ?>
  <p>Please verify your account, by clicking on the following <a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/verification?code=<?php echo $keystring;  ?>"> link </>to verify your account ! </p>
 
 
  <div style=" float:left;  padding: 8px; " >
		<b>Regards</b><br/>
		<span> Wildalerts Team  <span><br/>
	
  </div>
  
  </div>
  
  
</body>
</html>

















                            	                            	                            	<html>
<head>
 <title>Welcome to Wildalerts | Email Verification </title>
</head>
<body>
<div style="width: 100%; max-width:600px; margin:0 auto;">
<div style="background: #f1f1f1 none repeat scroll 0 0; border: 5px solid #04c23a; border-radius: 10px; box-shadow: 0 0 5px #ccc; float: left; font-family: sans-serif; margin: 10px 0; padding: 2px; width: 100%;">

<div style="height: auto; background:#164c9a; padding:10px 15px; border-radius: 5px 5px 0 0;"><img style="height: 60px !important;" src="<?php  echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;  ?>/img/logo.png"/></div>
<div style="padding: 17px;">
<p>Dear <?php echo ucwords($name); ?></p>

    <?php
        //$appLink=base64_encode("uersVarification://com.talentelgia.WildAlerts?token=".$keystring);  
         
        ?>
  <p>Please verify your account, by clicking on the following <a style="color:#164c9a;" href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/verification?code=<?php echo $keystring;  ?>"> link </>to verify your account ! </p>
 
 
  <div style=" float:left; width:100%;" >
		<b style="color:#164c9a;">Regards</b><br/>
		<span style="color:#164c9a;"> Wildalerts Team  <span><br/>

  </div>

  </div>

 </div></div>
</body>
</html>

<?php die;?>





                            






                            