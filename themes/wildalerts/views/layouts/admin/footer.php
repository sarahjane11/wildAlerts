 <!-- jQuery -->
 
   <?php  if(BASE_PATH.'/admin/dashboard' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/dashboard/changepassword' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/animals/create' == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url  || BASE_PATH.'/admin/categories/view/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/categories/update/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/user/view/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ||  BASE_PATH.'/admin/threatLevels/view/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/categories/update/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/animals/update/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url || BASE_PATH.'/admin/animals/view/id/'.Yii::app()->getRequest()->getQuery('id') == "http://".$_SERVER['SERVER_NAME'].Yii::app()->request->url ){ ?>

	
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/jquery/dist/jquery.min.js"></script>
	
   <?php }  ?>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/bower_components/raphael/raphael-min.js"></script>
    <!--<script src="<?php //echo Yii::app()->theme->baseUrl;?>/bower_components/morrisjs/morris.min.js"></script>-->
    <!--<script src="<?php //echo Yii::app()->theme->baseUrl;?>/js/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/dist/js/sb-admin-2.js"></script>

</body>

</html>

