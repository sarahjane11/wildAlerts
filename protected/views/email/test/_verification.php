                            	                            	                            	<html>
<head>
 <title>Welcome to Wildalerts | Email Verification </title>
</head>
<body>
<div style="width: 600px; margin: 10px; padding: 12px; border-radius: 10px; background: none repeat scroll 0px 0px rgb(207, 255, 191); box-shadow: 0px 0px 9px -2px gray !important;">
<div style="height: 45px !important;"><img style="height: 45px !important;" src="<?php  echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;  ?>/img/logo.png"/></div>
<div style="margin-top: 15px; padding: 17px; border: 1px dashed rgb(211, 211, 211);">
<p>Dear <?php echo ucwords($name); ?></p>
 <pre>
 	<?php
 		$this->beginContent('//email/template/verificationessage');
 		$this->endContent();
 	?>
</pre>
    <?php
        $appLink=base64_encode("uersVarification://com.talentelgia.WildAlerts?token=".$keystring);  
         
        ?>
  <p> <strong>For mobile app.</strong></p>
  <p>Please verify your account, by clicking on the following <a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/openapp?link=<?php echo $appLink;  ?>">link </>to verify your account ! </p>
  <p> <strong>For web app.</strong></p>
  <p>Please verify your account, by clicking on the following <a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/verification?code=<?php echo $keystring;  ?>"> link </>to verify your account ! </p>
 
  <div style=" float:left;  padding: 8px; " >
		<b>Regards</b><br/>
		<span> Wildalerts Team  <span><br/>
	<div style="clear:both;"></div>
  </div>
  <div style="clear:both;"></div>
  </div>
  <div style="clear:both;"></div>
  <div style="text-align: center;">

    <div style="clear:both;"></div>
  </div>
</body>
</html>







                            