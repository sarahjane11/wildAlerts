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
</style>

<section>
<div class="container">
<?php
$flashMessages = Yii::app()->user->getFlashes();
if ($flashMessages) {
    echo '<ul class="flashes">';
    foreach($flashMessages as $key => $message) {
        echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
    }
    echo '</ul>';
}
?>
    
<div class="col-lg-5 col-md-5 col-sm-5 left-sectn">
<div class="logo"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/logo.png" alt="" title="" /></a></div>
<img class="lft-bear-img" src="<?php echo Yii::app()->theme->baseUrl;?>/img/bear-pic-lft.png" alt="" />

<div class="lft-data">
<p>wildAlerts shares the latest information about animals who venture into town or spend time near hiking trails and campgrounds. </p>
<ul>
<li><span></span> Get alerts from wildAlerts.</li>
<li><span></span> Add animal sightings so your neighbors will be aware.</li>
<li><span></span> Add several locations (home, work, schools, hiking trail)</li>
<li><span></span> See recent activity in the area</li>
</ul>

<img class="appstore-icn-big" src="<?php echo Yii::app()->theme->baseUrl;?>/img/appstore-icn-big.png" alt="" title="" />
</div>

</div>
    <!-- login modal -->
    
    <!-- end login modal -->

<div class="col-lg-7 col-md-7 col-sm-7 right-sectn">
<img class="right-device-big-img" src="<?php echo Yii::app()->theme->baseUrl;?>/img/mobile-device-pic-right.png" alt="" title="" />
</div>

</div>
</section>
<!--complete content end-->

<!-- Button trigger modal -->

   <!------Login/ popup--------------->
    <div class="modal fade bs-example-modal-lg loginnow login_register" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div class="modal-body">


                    <ul role="tablist" class="nav nav-tabs" id="myTabs">
                        <li class="active" role="presentation"><a  aria-controls="login" data-toggle="tab" role="tab" id="login-tab" href="#login">Login</a></li>
                        <li role="presentation" class=""><a aria-expanded="true" data-toggle="tab" id="register-tab" role="tab" href="#register" aria-expanded="false">Register</a></li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div aria-labelledby="login-tab" id="login" class="tab-pane fade active in" role="tabpanel">
                            
                            <?php
                            //$model = new User;
                            $model->setScenario('login');
                            $formreg = $this->beginWidget('CActiveForm', array(
                                'id' => 'user-login-form',
                                'enableClientValidation' => true,
                                'action' => Yii::app()->baseUrl . '/site/login',
                                'enableAjaxValidation'=>false,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                    'validateOnChange' => false,
                                    'validateOnType' => false,
                                ),
                            ));
                            ?> 


                            <?php echo $formreg->textField($model, 'email', array('class' => 'class="col-lg-12"', 'placeholder' => 'Email')); ?>
                            <?php echo $formreg->error($model, 'email'); ?>



                            <?php echo $formreg->passwordField($model, 'password', array('class' => 'col-lg-12', 'placeholder' => 'Password')); ?>
                            <?php echo $formreg->error($model, 'password'); ?>


                            <?php //echo $formreg->checkBox($login_model, 'rememberMe'); ?>
                            <?php //echo $formreg->label($login_model, 'rememberMe'); ?>
                            <?php //echo $formreg->error($login_model, 'rememberMe'); ?>


                            <div class="row">
                                <div class="forgott_password">

                                    <!--<a class ="pull-right" href="<?php //echo Yii::app()->baseUrl ?>/site/forgetpassword">Forget Password</a>-->
                                    <a class ="pull-right fogpassword" data-toggle="modal" data-target=".forgotpassword" onclick="closemodal()"> Forgot Password ? </a>
                                </div>
                                <div class="modal-footer fb_login">

                                    <?php echo CHtml::submitButton('LOGIN', array('class' => 'btn btn-primary btn-lg')); ?>
                                    <a href="javascript:void(0);" onClick="fb_login()"><img src="<?php echo Yii::app()->baseUrl ?>/themes/wildalerts/img/sfb.jpg"></a>
                                </div>

                                <!--div class="col-xs-6 col-md-6"><a class="btn btn-success btn-block btn-lg" href="#">Sign In</a></div-->
                            </div>
                            <?php $this->endWidget(); ?>
                        </div>

                        <div aria-labelledby="register-tab" id="register" class="tab-pane fade" role="tabpanel">  



                            <?php
                            $model = new User;
                            //$model->setScenario('login');
                            $model->setScenario('register');
                            $formreg = $this->beginWidget('CActiveForm', array(
                                'id' => 'register-popup-form',
                                'action' => Yii::app()->baseUrl . '/site/signup',
                                'enableAjaxValidation' => true,
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                    'validateonblur' => true,
                                ),
                            ));
                            ?>
                            
                            <?php echo $formreg->textField($model, 'name', array('class' => 'class="col-lg-12"', 'placeholder' => 'Name')); ?>
                            <?php echo $formreg->error($model, 'name'); ?>
                            
                            <?php echo $formreg->textField($model, 'email', array('class' => 'class="col-lg-12"', 'placeholder' => 'Email')); ?>
                            <?php echo $formreg->error($model, 'email'); ?>



                            <?php echo $formreg->passwordField($model, 'password', array('class' => 'col-lg-12', 'placeholder' => 'Password')); ?>
                            <?php echo $formreg->error($model, 'password'); ?>

                           


                            <?php echo CHtml::submitButton('JOIN NOW', array('class' => 'btn btn-primary col-lg-12')); ?>
                            <?php $this->endWidget(); ?>

                            <div class="col-xs-12 col-md-4 col-sm-4 signupfb">

                                <div><?php //$this->widget('ext.eauth.EAuthWidget', array('action' => '/registration/student/index', 'reqtype' => 'signup')); ?></div>

                                <a href="javascript:void(0);" onClick="fb_signup()"><img src="<?php echo Yii::app()->baseUrl ?>/themes/wildalerts/img/facebook_signup_button.jpg"></a>

                            </div> 

                        </div>

                    </div>



                </div>




            </div>
        </div>
    </div>
   
   <!-- forgot password modal -->
   <!------Login/ popup--------------->
    <div class="modal fade bs-example-modal-lg loginnow forgotpassword" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <div class="modal-body">
                    <div aria-labelledby="login-tab" id="resetpassword">
                         <h5><b><?php echo Yii::t('app', 'Forgot password'); ?></b></h5>
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
                                     " class="errorMessage">
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
                        
                            <?php
                            $model = new User;
                            $model->setScenario('checkmail');
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'check-email-form',
                                'enableClientValidation' => true,
                                'action' => Yii::app()->baseUrl . '/site/checkemail',
                                'enableAjaxValidation' => false,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                    'validateOnChange' => false,
                                    'validateOnType' => false,
                                ),
                            ));
                            ?>
                       
                            <div class="control_label_input">
                                 <?php echo $form->textField($model, 'email', array('class' => 'class="col-lg-12"', 'placeholder' => 'Email')); ?>
                            <?php echo $form->error($model, 'email'); ?>
                                
                            </div>
                            


                </div>
                 <div class="modal-footer fb_login">
                     <?php //echo CHtml::submitButton(Yii::t('app', 'Send Mail')); ?>
                       <?php echo CHtml::submitButton('Send Mail', array('class' => 'btn btn-primary col-lg-12')); ?>              
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
            
    </div>
    </div>
   <!-- end forgot password model -->


 <!-- Script For FaceBOOK LOGIN -->
<script>
    
    
    
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?php echo  FB_APPID; ?>',
            channelUrl: 'http://hayageek.com/examples/oauth/facebook/oauth-javascript/channel.html',
            status: true,
            cookie: true,
            xfbml: true,
            version: 'v2.4'
        });
    };
    function fb_login()
    {

        FB.login(function (response) {
            if (response.authResponse)
            {
                getUserInfo();
            } else
            {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'email,user_photos,user_videos'});

    }

    function getUserInfo() {
        FB.api('/me?fields=email', function (response) {

            var facebookId = response.id;
            var email = response.email;

            var login_html = '<form id="fb_form" name="fb_form" method="POST" action="<?php echo Yii::app()->createUrl('/site/login'); ?>"><input type="hidden" name="User[email]" value="' + email + '" />';
            login_html += '<input type="hidden" name="User[facebook_id]" value="' + facebookId + '" /></form>';
            $('body').append(login_html);
            $('body').find('#fb_form').submit();
        });
    }
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<!--- for registration -->


<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?php echo FB_APPID; ?>',
            channelUrl: 'http://hayageek.com/examples/oauth/facebook/oauth-javascript/channel.html',
            status: true,
            cookie: true,
            xfbml: true,
            version: 'v2.4'
        });
    };
    function fb_signup()
    {

        FB.login(function (response) {
            if (response.authResponse)
            {
                getUserInfo();
            } else
            {
                console.log('User cancelled login or did not fully authorize.');
            }
        }, {scope: 'email,public_profile,user_videos'});

    }

    function getUserInfo() {
        FB.api('/me?fields=first_name,last_name,email,gender', function (response) {
            console.log(response);
            var facebookId = response.id;
            var email = response.email;
            var first_name = response.first_name;
            var last_name = response.last_name;
            var name = first_name + ' ' + last_name;
            var gender = response.gender;
            
            var signup_html = '<form id="fb_formssignup" name="fb_form" method="POST" action="<?php echo Yii::app()->createUrl('/site/signup'); ?>"><input type="hidden" name="User[email]" value="' + email + '" />';
            signup_html += '<input type="hidden" name="User[facebook_id]" value="' + facebookId + '" />';
            signup_html +='<input type="hidden" name="User[name]" value="' + name + '" /></form>';
            $('body').append(signup_html);
            $('body').find('#fb_formssignup').submit();
            
          });
    }
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script>
    function registertabactive(){
        $('#login-tab').parent().removeClass('active');
      
        $('#register-tab').parent().addClass('active');
      
       
       $('#login').removeClass('active in');
       $('#register').addClass('active in');
         
    }
    function logintabactive(){
        $('#login-tab').parent().addClass('active');
       
        $('#register-tab').parent().removeClass('active');
       
       
       $('#login').addClass('active in');
       $('#register').removeClass('active in');
       $('.errorMessage').hide();
        
    } 
    
    $(document).ready(function() {
        if(jQuery('#User_password_em_').text() != ''){
            
            $('.login_register').modal('show');
            $('.login_register').on('shown', function() {
                $("#User_password").focus();
                $('.errorMessage').hide();
            })
            
        }
        
        
        
        
    });
    
    function closemodal(){
       
        $('.login_register').modal('hide');
    }
    
    $('#login-tab').click(function(){
       
       $('.errorMessage').hide();
   });
   $('#register-tab').click(function(){
       
       $('.errorMessage').hide();
   });
   $('.login_register').on('hidden.bs.modal', function () {
        $('.errorMessage').hide();
      });
    </script>