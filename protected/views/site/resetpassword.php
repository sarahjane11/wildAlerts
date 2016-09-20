<style>
    body {
  background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/main-bg.jpg") no-repeat scroll center top transparent;
  font-family: 'Open Sans',sans-serif;
  margin: 0;
  padding: 0;
}
.flash-successRegister {
    color: #FFFFFF;
    font-size: 16px;
    font-weight: bold;
}
.flash-success_verification {
    color: #FFFFFF;
    font-size: 16px;
    font-weight: bold;
}
.flash-emailFound {
    color: #FFFFFF;
    font-size: 16px;
    font-weight: bold;
}
.flash-emailError {
    color: #FFFFFF;
    font-size: 16px;
    font-weight: bold;
}
.logo {
  margin-top: 1%;
}
</style>

<section>
    <div class="container">
        <div class="col-lg-5 col-md-5 col-sm-5 left-sectn inner-logo">
<div class="logo"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo.png" alt="" title="" /></a></div>
        </div>
    <?php
        //$page = ControlPanelSettings::model()->findByAttributes(array('slug' => 'forgotLogin'));
    ?>
         <div class="container outerpage">
    <h4><?php Yii::t('app', 'Reset Password?'); ?></h4>
    
   
    <?php
    $flashMessage = Yii::app()->user->getFlash('resetPasswordError');
    if (isset($flashMessage)) {
        ?>
        <div style="
             text-align: center;
             width: 100%;
             margin: auto;
             height: 50px;
             line-height:15px;
             color: red;
             ">
                 <?php echo $flashMessage; ?>
        </div>
        <?php
    }
    $flashMessage = Yii::app()->user->getFlash('reset');
    if (isset($flashMessage)) {
        ?>
        <div style="
             text-align: center;
             width: 100%;
             margin: auto;
             height: 50px;
             line-height:15px;
             color: #04B431;
             ">
                 <?php echo $flashMessage; ?>
        </div>
        <?php
    }
    ?>

    <div class="my_resetpassword">
        
        <?php
        
         $model->setScenario('resetpassword');
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'action' => Yii::app()->baseUrl . '/site/resetpassword?token='.$token,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <h5><?php echo Yii::t('app', 'Reset Password'); ?></h5>
        <div class="control_label_input">
            <input type="hidden" id='User_token' name="User[token]" value='<?php if(isset($token)) echo $token ;?>'>
            <?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->passwordField($model,'password',array('value'=>'')); ?>
                
		<?php echo $form->error($model,'password'); ?>
               
            <?php echo CHtml::submitButton(Yii::t('app', 'Reset password')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
 </div>
</section>
<!--complete content end-->
