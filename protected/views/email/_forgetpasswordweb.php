<html>
    <head>
        <title>Wildalerts | Change Password</title>
    </head>
    <body>
        <?php
         $appLink=base64_encode("forgotPassword://com.talentelgia.WildAlerts?token=".$getToken);  
         
        ?>
     <div style="width: 100%; max-width:600px; margin:0 auto;">
<div style="background: #f1f1f1 none repeat scroll 0 0; border: 5px solid #04c23a; border-radius: 10px; box-shadow: 0 0 5px #ccc; float: left; font-family: sans-serif; margin: 10px 0; padding: 2px; width: 100%;">

<div style="height: auto; background:#164c9a; padding:10px 15px; border-radius: 5px 5px 0 0;"><img style="height: 60px !important;" src="<?php  echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;  ?>/img/logo.png"/></div>
<div style="padding: 17px;float:left;width: 100%;">
           
                <p>Hi! <?php //echo ucwords($email); ?></p>
                
                <p>You have requested a	password change </p>
                
                <?php //echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl."/site/openapp?link=".$appLink;?>
                 
<!--                <p>For mobile app. </p>
                
                <a href="<?php //echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/openapp?link=<?php //echo $appLink;  ?>">Click Here to Reset Password</a> 
                
                <p>For web app.</p>
                
                <a href="<?php //echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/ResetPassword?token=<?php //echo $appLink;  ?>"> Click Here to Reset Password</a> 
                -->
                
                <p> To reset  your password from IOS APP <a  class="btn" style="color:#fff; background:#164C9A; padding:4px 6px;  text-decoration:none; font-size:15px; border-radius:3px;"  href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/openapp?link=<?php echo $appLink;  ?>" > click</a></p>

                <p> To reset  your password from web <a href="<?php echo Yii::app()->request->hostInfo.Yii::app()->request->baseUrl; ?>/site/ResetPassword?token=<?php echo $getToken;  ?>">link </a> </p> 
  
                
                
                
                
                
                 <div style=" float:left; width:100%;" >
                    <b style="color:#164c9a;">Regards</b><br/>
                    <span style="color:#164c9a;"> Wildalerts Team  <span><br/>

                    </div>

                    </div>

                   </div>
                </div>
  
                            </body>
                            </html>


