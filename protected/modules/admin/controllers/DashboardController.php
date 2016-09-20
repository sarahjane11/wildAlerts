<?php

class DashboardController extends AdminController
{
	public $layout = '//layouts/admin/admin';
	public function actionIndex()
	{ 
                //count today notification
                $sql = "SELECT count(*) FROM wild_alert_posts where created_at  >= DATE_SUB(CURDATE(), INTERVAL 1 DAY)  AND status = 1";
                $todayNotification = WildAlertPosts::model()->countBySql($sql);
                //count current month registration
                $sql = "SELECT count(*) FROM user WHERE MONTH(CAST(created_at as date)) = MONTH(NOW()) AND YEAR(CAST(created_at as date)) = YEAR(NOW()) AND status = 1 AND is_authenticated = 1";
                $thismontregis = User::model()->countBySql($sql);
                //count animals
                $totanimal = Animals::model()->countByAttributes(array('status'=>1));
                //users info
                $sql = "SELECT name,email FROM user WHERE MONTH(CAST(created_at as date)) = MONTH(NOW()) AND YEAR(CAST(created_at as date)) = YEAR(NOW()) AND status = 1 AND is_authenticated = 1";
                $userdetails = Yii::app()->db->createCommand($sql)->queryAll();
                
                 
               
		$this->render('index',array('todayNotification'=>$todayNotification,'thismontregis'=>$thismontregis,'totanimal'=>$totanimal,'userdetails'=>$userdetails));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
        
        public function actionChangePassword(){
            
            $model = new AdminLogin;
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='change-password-form'){
                
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            
            $this->render('changepassword',array(
			'model'=>$model,
		));
          
            if(isset($_POST['AdminLogin']))
            {
                $id = Yii::app()->user->id;
                
                if($_POST['AdminLogin']['oldpassword']==''){
                    Yii::app()->user->setFlash('error1', "Old password cannot be blank.");
      
                }else if(trim($_POST['AdminLogin']['newpassword'])==''){
                    Yii::app()->user->setFlash('error2', "New password cannot be blank or whitespace.");
     
                
                }else{
                    //echo '3';die;
                    //echo 'whitespace'.$_POST['AdminLogin']['newpassword']; die;
                    $user = AdminLogin::model()->findByPk($id);
                    
                        if($user->password != md5($_POST['AdminLogin']['oldpassword'])){
                            Yii::app()->user->setFlash('error3', "Old password is incorrect.");

                       }
                       else{
                           $user->password = md5(trim($_POST['AdminLogin']['newpassword']));
                           $user->update();
                           Yii::app()->user->setFlash('success', "Password updated successfully.");
                            
                       }
                  
                    }
                   
            }
            
            
            
        }
}
