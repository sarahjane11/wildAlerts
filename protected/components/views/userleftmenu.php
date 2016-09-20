 <div class="list-group">
<!--      <a class="list-group-item active" href="#">Account settings</a>-->
      <a class="list-group-item <?php if(BASE_PATH.'/user/accountsetting/profile' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url) echo 'active'; ?>" href="<?php echo Yii::app()->createUrl("/user/accountsetting/profile"); ?>">Profile</a>
      <a class="list-group-item <?php if(BASE_PATH.'/user/accountsetting/changepassword' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url) echo 'active'; ?>" href="<?php echo Yii::app()->createUrl('/user/accountsetting/changepassword');?>">Change password</a>
      <a class="list-group-item <?php if(BASE_PATH.'/user/userlocations' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/user/Userlocations/create' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/user/Userlocations/update/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url) echo 'active'; ?>" href="<?php echo Yii::app()->createUrl('/user/userlocations');?>">Location settings</a>
      <a class="list-group-item <?php if(BASE_PATH.'/user/notificationsettings' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url) echo 'active'; ?>" href="<?php echo Yii::app()->createUrl('/user/notificationsettings');?>">Notification settings</a>
      

    </div>
