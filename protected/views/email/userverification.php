<html>
    <head>
        <title>Wildalerts | Email Verification </title>
    </head>
    <body>
        <div style="width: 600px; margin: 10px; padding: 12px; border-radius: 10px; background: none repeat scroll 0px 0px rgb(207, 255, 191); box-shadow: 0px 0px 9px -2px gray !important;">
            <div style="height: 45px !important;"><img style="height: 45px !important;" src="<?php echo Yii::app()->request->hostInfo . Yii::app()->theme->baseUrl; ?>/img/logo.png"/></div>
            <div style="margin-top: 15px; padding: 17px; border: 1px dashed rgb(211, 211, 211);">
                <p>Hello <?php echo ucwords($name); ?></p>
                <p>Your verification code is :<?php echo $code ?> </p>

                <div style=" float:left;  padding: 8px; " >
                    <b>Regards</b><br/>
                    <span> <?php echo Yii::app()->name; ?><span><br/>

                            </div>
                            <div style="clear:both;"></div>
                            </div>
                            <div style="clear:both;"></div>
                            <div style="text-align: center;">

                                <div style="clear:both;"></div>
                            </div>
                            </body>
                            </html>

