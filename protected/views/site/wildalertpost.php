<style>
    body {
        background: url("<?php echo Yii::app()->theme->baseUrl; ?>/img/main-bg.jpg") no-repeat scroll center top transparent;
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


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgf4FzsTWah_eYb0Eix9OKQ0lFFZXfTLI&signed_in=true&libraries=places&callback=initMap"
async defer></script>

<div class="share-wild-alert-map_logo">
    <div class="container">
        <a href="#"><img  class="share-post-logo" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="" title="" /></a>
    </div>
</div>
<?php if(isset($postNotification) && !empty($postNotification)) { ?>
<div id="googleMap" style="width:100%;min-height:420px;" class="share-wild-alert-map pull-right"></div>
 
<?php } ?>          


<!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Share with friends</h4>
              </div>
              <div class="modal-body">
                 <textarea class="form-control friends-email" id="friends-list" rows="3"></textarea>
              </div>
              <div class="modal-footer">
                  <button type="button" class="share-friend btn btn-primary">Send</button>
              </div>
            </div>
          </div>
        </div>

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
                            $model = new User;
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
        
    } 
    
    $(document).ready(function() {
        if(jQuery('#User_password_em_').text() != ''){
            
            $('.login_register').modal('show');
            $('.login_register').on('shown', function() {
                $("#User_password").focus();
            })
            
        }
        
        
        
        
    });
    
    function closemodal(){
        
        $('.login_register').modal('hide');
    }
   
    </script>


            
            
            
<?php if(isset($postNotification) && !empty($postNotification)) { ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script>
    
    var post = JSON.parse('<?php echo json_encode($postNotification); ?>');
    
     var imgSrc = "<?php echo Yii::app()->request->hostInfo.Yii::app()->baseUrl;?>/upload/" + post[0]['image_name'];
	$('meta[property="og:image"]').attr('content', imgSrc);
    
    window.onload = function () {
        initMap();
    }

    var map;
    function initMap() {
        var lat = post[0].latitude;

        var lng =  post[0].longitude;
          
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)}
        
        map = new google.maps.Map(document.getElementById('googleMap'), {
            center: myLatLng,
            zoom: 20
        });

        var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '</div class="left-details"> '+
                '<img  class="th-color" style="background-color:'+post[0]['color']+'" Hight="24px" width="24px" SRC="<?php echo Yii::app()->theme->baseUrl;?>/img/animal.png"></img>'+
                '<h1 id="firstHeading" class="firstHeading">Wildalerts, Wild Notification</h1>' +
                '<div id="bodyContent">' +
                'Animal Name :' + post[0]['name'] +
                '<p>Posted Date And Time : ' + post[0]['modified_at'] + '</p>' +
                '<p>Notes : ' + post[0]['notes'] + '</p>' +
                '<p>Posted by : ' + post[0]['username'] + '</p>' +
                '<p><div>Share</div>'+
                    '<a class="fb" title="Share on facebook" href="javascript:sharewildalertOnfb('+ post[0]['id'] +');"><img width="24px" height="24px" style=" margin-right: 5px;" src="<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/facebook.png"></a>'+
                    '<a class="twit" title="Share on twitter" href="javascript:sharewildalertOnTwitter('+ post[0]['id'] +');"><img width="24px" height="24px" style=" margin-right: 5px;" src="<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/twitter.png"></a>'+
                    '<a class="email"  title="Share on email" href="javascript:sharewildalerttOnmail('+ post[0]['id'] +');" ><img width="24px" height="24px" style=" margin-right: 5px;" src="<?php echo Yii::app()->request->hostInfo.Yii::app()->theme->baseUrl;?>/img/email.png"></a></p>'+
                 '</div>' +
                '<div class="right-details">'+
                '<p><IMG BORDER="0" ALIGN="Right" Hight="100px" width="200px" SRC="<?php echo Yii::app()->baseUrl;?>/upload/' + post[0]['image_name'] + '"></p>' +
                '</div>'+
                '</div>'
                    ;

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        // google.maps.event.trigger(marker, 'click');
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title:  post[0]['name']
        });
        
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });

        google.maps.event.trigger(marker, 'click', {
            latLng: new google.maps.LatLng(parseInt(lat), parseInt(lng))
        });
    }



</script> 


<script>
 
 function sharewildalertOnfb(id){
    var id = btoa(id);
     url = '<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>'+'?id='+id;
     
     var myWindow=window.open('https://www.facebook.com/sharer.php?u='+encodeURI(url),"", "width=500, height=400");
 }
 
 function sharewildalertOnTwitter(id){
     var id = btoa(id);
    url = '<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>'+'?id='+id;
     
      var title = encodeURIComponent('Wildalerts - Click on the link to view post : ');
        //We trigger a new window with the Twitter dialog, in the middle of the page
      window.open('http://twitter.com/share?url=' + url + '&text=' + title + '&', 'twitterwindow', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

     
 }
 
  var postlinkurl = "<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>";
  function sharewildalerttOnmail(id){
    var id = btoa(id);
    postlinkurl = '<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/wildalertpost') ?>'+'?id='+id;
    
     $('#myModal').modal('show');
    }
 
    $(document).ready(function()
    {
        function validateEmail(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
       } 
        
        
        
       $('.share-friend').click(function(){
           var flag=true;
           var emailslist=$('#friends-list').val();
           var arrayEmails=emailslist.split(',');
           $.each(arrayEmails,function(i,v){
               if(!validateEmail(v))
               {
                   flag=false;
               }
                if(flag)
                {
                   
                   $.ajax({
                   url:'<?php  echo Yii::app()->request->hostInfo.Yii::app()->createUrl('site/sharealertswithfriends') ?>',
                   data:{  emails:emailslist,
                              pageUrl:postlinkurl,
                              
                          },
                   type:'post',
                   beforeSend:function(){
                        $('#load-img').show();
                   },
                   success:function(response){
                       $('#myModal').modal('toggle');
                       alert('email send successfully.');
                       
                     
                   },
                  error:function(){
                      alert('Unable to send email.');
                  },
               });
                    
                }else{
                    alert('Please fill valid emails.');
                }
                
           });
       });
       
    });
 
</script>
<?php }else { ?>
    
<div class="not-found"> 
    <h1> Oops invalid request!</h1> 
</div>
    
<?php }?>