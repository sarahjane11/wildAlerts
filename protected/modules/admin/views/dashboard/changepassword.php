<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Change password</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                 <div class="col-lg-12">
                     <?php if(Yii::app()->user->hasFlash('success')){ ?>
                                <div class="bg-success controlupdatess">  

                                    <?php echo Yii::app()->user->getFlash('success'); ?>
                                </div>
                            <?php } ?>
                  <div class="col-md-8 changepass">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                            
                            <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'change-password-form',
                                    'enableAjaxValidation' => false,
                                ));
                                ?>
                            <h3 class="panel-title">Fields with <span class="required">*</span> are required.</h3>
                            <div class="panel-body">
                                <fieldset>
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-3 col-sm-3">	<?php echo $form->labelEx($model, 'Old password*'); ?></div>
                                    <div class="col-xs-12 col-md-9 col-sm-9"><?php echo $form->passwordField($model, 'oldpassword', array('value'=>'','size' => 60, 'maxlength' => 100, 'class'=>'form-control')); ?>
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
                                <div class="form-group">
                                    <div class="col-xs-12 col-md-3 col-sm-3"><?php echo $form->labelEx($model, 'New password*'); ?></div>
                                    <div class="col-xs-12 col-md-9 col-sm-9"><?php echo $form->passwordField($model, 'newpassword', array('size' => 60, 'maxlength' => 100 , 'class'=>'form-control')); ?>

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
                                    </div></div>
                                    
                                </div>
                                    <?php echo CHtml::submitButton('Change password', array('class' => 'changepassword_btn btn btn-lg btn-success btn-block')); ?>
                           
                             </fieldset>
                            </div>
                            
                            
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                  </div>

            </div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
</div>
   
