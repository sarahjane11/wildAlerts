<?php

class NotificationsettingsController extends UsersController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/frontendinner/frontend';


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','changestatus','changedistance','changedays','savenotification'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionIndex()
	{   
            
//		$dataProvider= array();
//		$dataProvider=new CActiveDataProvider('UserLocations', array(
//                     'criteria'=>array(
//                            'condition'=>'user_id=27',
//                            
//                        ),
//                ));
                
               
//		//$this->render('index',array('dataProvider'=>$dataProvider,));
//        
        $user_id          = Yii::app()->user->getId(); 
        $model = User::model()->findByPk($user_id);
        $threats = ThreatLevels::model()->findAll();
        
        $all_user_location = UserLocations::model()->findAll('user_id=' . $user_id);
        
        $this->render('index',array('all_user_location'=>$all_user_location,'user_id'=>$user_id , 'model'=>$model,'threats'=>$threats));
         	
	}
        
	public function actionchangestatus()
	{
		// echo "<pre>"; print_r($_POST); die;
        $alert_notification = $_POST['status'];
        $id                 = (isset($_POST['id'])) ? $_POST['id'] : '';$_POST['id'];
       $userid = (isset($_POST['userid'])) ? $_POST['userid'] : '';
                if($id != ''){
		$Userlocations      = UserLocations::model()->findByAttributes(array('id' => $id));
		$Userlocations->alert_notification = $alert_notification;
		$Userlocations->update();
                echo json_encode(array('id'=>$id,'status'=>$alert_notification));
                
                }else{
                    $user = User::model()->findByPk($userid);
                    $user->email_alert = $alert_notification;
                    $user->update();
                     echo json_encode(array('userid'=>$userid,'status'=>$alert_notification));
                }

	}
        
        //set alert distance
        public function actionChangeDistance()
	{
		// echo "<pre>"; print_r($_POST); die;
                    $userid = (isset($_POST['userid'])) ? $_POST['userid'] : '';
                    $distance = (isset($_POST['distance'])) ? $_POST['distance'] : 10;
                    $user = User::model()->findByPk($userid);
                    $user->alert_distance = $distance;
                    $user->update();
                     echo json_encode(array('userid'=>$userid,'status'=>$distance));
               

	}
        //set days
         
        public function actionChangeDays()
	{
		 //echo "<pre>"; print_r($_POST); die;
                    $userid = (isset($_POST['userid'])) ? $_POST['userid'] : '';
                    $distance = (isset($_POST['days'])) ? $_POST['days'] : 7;
                    $user = User::model()->findByPk($userid);
                    $user->alert_days = $distance;
                    $user->update();
                     echo json_encode(array('userid'=>$userid,'status'=>$distance));
               

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserLocations;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserLocations']))
		{
			$model->attributes=$_POST['UserLocations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserLocations']))
		{
			$model->attributes=$_POST['UserLocations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	

	public function print_data($data)
	{
		echo "<pre>"; print_r($data); echo "</pre>";
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserLocations('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserLocations']))
			$model->attributes=$_GET['UserLocations'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserLocations the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserLocations::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserLocations $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-locations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionSaveNotification(){
             //echo "<pre>"; print_r($_POST); die;
             $user_id = Yii::app()->user->getId();
             if(isset($_POST['email_alert']) && $_POST['email_alert']){
                 $model=  User::model()->findByPk($user_id);
                 $model->email_alert = 1;
                 $model->modified_at = date('Y-m-d H:i:s');
                 $model->update();
             }
             else{
                $model=  User::model()->findByPk($user_id);
                 $model->email_alert = 0;
                 $model->update(); 
             }
             if(isset($_POST['User']['alert_days'])){
                 $model=  User::model()->findByPk($user_id);
                 $model->alert_days = (isset($_POST['User']['alert_days'])) ? $_POST['User']['alert_days']:'7';
                 $model->modified_at = date('Y-m-d H:i:s');
                 $model->update();
             }
             
             if(isset($_POST['Threatnotification'])){
                 
                 
                 foreach($_POST['Threatnotification'] as $key =>$value){
//                     echo $key.' '.$value.'<br>';
                     if($value >50 ){
                         Yii::app()->user->setFlash('error', "Max distance can not be more than 50 miles");
                         
                     }else{
                         
                     
                        $model = ThreatNotificationSettings::model()->findByAttributes(array('user_id'=> $user_id, 'threat_id'=>$key));
                        if(!empty($model)){

                             $model->setScenario('update');
                             $model->distance = $value;
                             $model->status = 1;
                             $model->modified_at = date('Y-m-d H:i:s');
                             $model->update();

                        }else{
				
                            $model = new ThreatNotificationSettings;
                            $model->user_id = $user_id;
                            $model->threat_id = $key;
                            $model->distance = $value;
                            $model->status = 1;
                            $model->created_at = date('Y-m-d H:i:s');
                            $model->modified_at = date('Y-m-d H:i:s');
                            //$model->validate() ;
                            $model->save();


                        }
                    }
                 }
                
             }
              
             if(isset($_POST['UserLocation'])){  
                foreach($_POST['UserLocation'] as $key => $value){
                    //echo $key.' '.$value.'<br>';
                     $model =  UserLocations::model()->findByAttributes(array('id'=>$key));
                       //echo "<pre>"; print_r($model); die;
                       if(!empty($model)){
                          
                           $model->setScenario('setloc');
                           $model->alert_notification = $value;
                           $model->status=1;
                           $model->modified_at = date('Y-m-d H:i:s');

                           $model->update();
                       }


                }
             }
             
             
             
             $this->redirect(array('notificationsettings/'));
             
             
             
            
        }
}
