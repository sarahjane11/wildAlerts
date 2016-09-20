<head>
 <title>Welcome to Wildalerts | Email Verification </title>
</head>
<body>
<div style="width: 100%; max-width:600px; margin:0 auto;">
<div style="background: #f1f1f1 none repeat scroll 0 0; border: 5px solid #04c23a; border-radius: 10px; box-shadow: 0 0 5px #ccc; float: left; font-family: sans-serif; margin: 10px 0; padding: 2px; width: 100%;">

<div style="height: auto; background:#164c9a; padding:10px 15px; border-radius: 5px 5px 0 0;"><img style="height: 60px !important;" src="<?php  echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;  ?>/img/logo.png"/></div>
<div style="padding: 17px;float:left;width: 100%;">

<p>Dear <?php echo ucwords($name); ?></p>

    <?php
        //$appLink=base64_encode("uersVarification://com.talentelgia.WildAlerts?token=".$keystring);  
         
        ?>
  <!--<p>Please verify your account, by clicking on the following <a style="color:#164c9a;" href="<?php //echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/verification?code=<?php //echo $keystring;  ?>"> link </>to verify your account ! </p>-->
 
  <p>To verify your account form IOS APP  <a  class="btn" style="color:#fff; background:#164C9A; padding:4px 6px;  text-decoration:none; font-size:15px;line-height: 20px; border-radius:3px;"  href="<?php echo $appLink=base64_encode('uersVarification://com.talentelgia.WildAlerts?token='.$keystring); ?>" > Confirm</a> </p>

<p> To verify your account from the web,  <a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.'/site/verification?code='.$keystring ;  ?>">click here </a> </p> 
   
 
  <div style=" float:left; width:100%;" >
  <b style="color:#164c9a;">Regards</b><br/>
  <span style="color:#164c9a;"> Wildalerts Team  <span><br/>

  </div>

  </div>

 </div></div>
  
  
</body>
</html>
