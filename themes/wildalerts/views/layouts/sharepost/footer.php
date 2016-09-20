
<footer>
<div class="container">
<div class="login-signup">
    <?php 
if(BASE_PATH.'/site/ResetPassword?token='.Yii::app()->getRequest()->getQuery('token') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ){
 ?>

<?php } else{ ?>
    <a href="javascript::void(0)" class="login-btn" data-toggle="modal" data-target=".login_register" onclick="logintabactive()" >Login</a>
<a href="javascript::void(0)" class="signup-btn" data-toggle="modal" data-target=".login_register" onclick="registertabactive()" >Sign up</a>
    
 <?php } ?>

</div>


<div class="footer-copyright">© 2015 WildAlerts.com</div>
<div class="footer-nav">
<ul>
<li><a href="#">About us</a></li>
<li><a href="#">Support</a></li>
<li><a href="#">Blog</a></li>
<li><a href="#">Press</a></li>
<li><a href="#">Jobs</a></li>
<li><a href="#">Privacy</a></li>
<li><a href="#">Terms</a></li>
</ul>
</div>
</div>
</footer>



<!--<script src="<?php //echo Yii::app()->theme->baseUrl;?>/js/jquery.js"></script>-->
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.js"></script>


</body>
</html>
