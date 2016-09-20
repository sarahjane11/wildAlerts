<?php
/* @var $this AccountsettingController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-8 changepass">
        <div class="panel panel-default">
            <div class="panel-heading">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'change-password-form',
                    'enableAjaxValidation' => false,
                ));
                ?>



<?php //echo $form->errorSummary($model); ?>



                <h3 class="panel-title">Fields with <span class="required">*</span> are required.</h3>
            
            <div class="panel-body">
                <form role="form" accept-charset="UTF-8">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3 col-sm-3">	<?php echo $form->labelEx($model, 'Old password*'); ?></div>
                            <div class="col-xs-12 col-md-9 col-sm-9"><?php echo $form->passwordField($model, 'oldpassword', array('value' => '', 'size' => 60, 'maxlength' => 100,  'class'=>'form-control')); ?>
<?php //echo $form->error($model, 'oldpassword'); ?>
                                <div class="error-changepassword"> 
                             <?php
                                $flashMessages = Yii::app()->user->getFlashes();
                                 //echo "<pre>"; print_r($flashMessages); die;
                                if ($flashMessages){
                                    echo '<ul class="flashes">';
                                    foreach($flashMessages as $key => $message) {
                                        if($key == 'error1' || $key == 'error3'){
                                            echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                                    
                                        }
                                    }
                                    echo '</ul>';
                                }
                                ?>
                                </div></div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-md-3 col-sm-3"><?php echo $form->labelEx($model, 'New password*'); ?></div>
                            <div class="col-xs-12 col-md-9 col-sm-9"><?php echo $form->passwordField($model, 'newpassword', array('size' => 60, 'maxlength' => 100 , 'class'=>'form-control')); ?>
                        <?php //echo $form->error($model, 'newpassword'); ?>
                            <div class="error-changepassword">      
                                <?php
//                                  
                                    if ($flashMessages){
                                        
                                        echo '<ul class="flashes">';
                                        foreach($flashMessages as $key => $message) {
                                             if($key=='error2'){
                                                echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
                                        
                                             }   
                                        }
                                        echo '</ul>';
                                    }
                               ?>
                            </div>
                           </div>     
                        </div>
                     
<?php echo CHtml::submitButton('Change password', array('class' => 'changepassword_btn btn btn-lg btn-success btn-block')); ?>
                           
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>



<?php $this->endWidget(); ?>


</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>