<?php

class DefaultController extends Controller {

    public function actionIndex() {
       
        $this->redirect(Yii::app()->createUrl('admin/dashboard'));
//          if(Yii::app()->user->getId()===null)
//        {
//              $this->redirect(Yii::app()->createUrl('admin/default/signin'));
//        }
//        else{
//            echo Yii::app()->user->getId();
//             $this->redirect(Yii::app()->createUrl('admin/dashboard'));
//        }
    }

    public function actionSignin() {
	
        $this->layout = '//layouts/admin/empty';
        $model = new AdminLogin;
	
        

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['AdminLogin'])) {
            

           	$model->attributes = $_POST['AdminLogin'];
		
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                
                 $this->redirect(Yii::app()->createUrl('admin/dashboard'));
                
            }
        }

        $this->render('signin', array('model' => $model));
    }
    
    public function actionLogout(){
        
                Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('admin/default/signin'));
                
        }

}
