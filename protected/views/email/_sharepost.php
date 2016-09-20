<head>
 <title>Welcome to Wildalerts | Alert Notification </title>
</head>
<body>
<div style="width: 100%; max-width:600px; margin:0 auto;">
<div style="background: #f1f1f1 none repeat scroll 0 0; border: 5px solid #04c23a; border-radius: 10px; box-shadow: 0 0 5px #ccc; float: left; font-family: sans-serif; margin: 10px 0; padding: 2px; width: 100%;">

<div style="height: auto; background:#164c9a; padding:10px 15px; border-radius: 5px 5px 0 0;"><img style="height: 60px !important;" src="<?php  echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;  ?>/img/logo.png"/></div>
<div style="padding: 17px;float:left;width: 100%;">

<p>Dear <?php //echo ucwords($name); ?></p>

     <?php
        $appLink=base64_encode("uersVarification://com.talentelgia.WildAlerts?postid=".$postid);  
         
        ?>
 
<p> Your friend has shared a post with you.  Click on below link to see the post.</p>
<p><a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.'/site/wildalertpost?id='.$postid ;  ?>">click </a> </p> 
 
  <div style=" float:left; width:100%;" >
  <b style="color:#164c9a;">Regards</b><br/>
  <span style="color:#164c9a;"> Wildalerts Team  <span><br/>

  </div>

  </div>

 </div></div>
  
  
</body>
</html>
