<div class="col-xs-12 col-sm-12 col-md-12 registration_form forget_password">
    <?php
        //$page = ControlPanelSettings::model()->findByAttributes(array('slug' => 'forgotLogin'));
    ?>
    <h4><?php Yii::t('app', 'Forgot login info?'); ?></h4>
    <div class="welcome_to_wildalerts admin-text">
        <p>
            
        </p>
    </div>
    
    <?php
    $flashMessage = Yii::app()->user->getFlash('emailError');
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
    $flashMessage = Yii::app()->user->getFlash('emailFound');
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

    <div class="my_login">
        
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'action' => Yii::app()->baseUrl . '/site/checkemail',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>
        <h5><?php echo Yii::t('app', 'Forgot password'); ?></h5>
        <div class="control_label_input">
            <?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
            <?php echo CHtml::submitButton(Yii::t('app', 'Send Mail')); ?>
        </div>
        <?php $this->endWidget(); ?>

    </div><!--end of my login  -->
    <div class="welcome_to_wildalerts">
        
    </div>
</div>