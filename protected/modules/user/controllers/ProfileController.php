<?php

class ProfileController extends UsersController
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
				'actions'=>array('index','view'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
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
	public function actionIndex($id = null ,$triggarid = null)
	{ 
            
             if(isset($id) && isset($triggarid) &&  $id !='' && $triggarid !=''){
                 
                //echo $id;die;
                $modal = NotificationStatus::model()->findByAttributes(array('alert_post_id'=>$id));
                if(count($modal)==0){
                    $user_id = Yii::app()->user->getId();
                    $modal = new NotificationStatus;
                    $modal->user_id = $user_id;
                    $modal->alert_post_id = $id;
                    $modal->status = 1;
                    $modal->created_at  = date('Y-m-d H:i:s');
                    $modal->modified_at = date('Y-m-d H:i:s');
                    $modal->save();
                
                }
             }
            
             $triggarid = (isset($_GET['triggarid'])) ? $_GET['triggarid'] : '';
             
                    $user_id = Yii::app()->user->getId();
                        $sqlloc = "SELECT * From user_locations WHERE status=1 AND user_id='$user_id'";
                        $userlocation = Yii::app()->db->createCommand($sqlloc)->queryAll();
                        
                    $sql = "" ;
                   $notification_seeting = ThreatNotificationSettings::model()->findAllByAttributes(array('user_id'=>$user_id));
                     
                   $user_locations = UserLocations::model()->findAllByAttributes(array('user_id'=>$user_id,'status'=>'1'));
                    
                   if(!empty($notification_seeting) &&  !empty($user_locations)){
                     
                        $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username,u.alert_days
                                from wild_alert_posts wap,user_locations ul , threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and tn.user_id = ul.user_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$user_id'
                                and wap.user_id = u.id
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                and ul.alert_notification =1
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else if(!empty($notification_seeting)){
                    
                        $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and u.id = '$user_id'
                                and wap.user_id = u.id
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                 group by wap.id
                                order by wap.id DESC";
                  }else if(!empty($user_locations)){
                      
                       $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,user_locations ul, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$user_id'
                                and wap.user_id = u.id
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and  (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <=20
                                and ul.alert_notification =1
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else{
                      
                         $sql="select wap.id,  wap.user_id, wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from  wild_alert_posts wap, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id and u.id = wap.user_id
                                and a.threat_level_id=tl.id
                                and wap.user_id = u.id
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <= 20
                                group by wap.id
                                order by wap.id DESC";
                          
                  }
                   
                   
                   
                   $allnotification = Yii::app()->db->createCommand($sql)->queryAll();
                   $notification=[];
                   foreach ($allnotification as  $key => $value) {
                       //$fileContent=  file_get_contents($value['image_path']."/".$value['image_name']);
                        $notification[]=array(
                            'id'        =>  $value['id'],
                            'user_id'   =>  $value['user_id'] ,
                            'animal_id' =>  $value['animal_id'] ,
                            'title'     =>  $value['title'],
                            'notes'     =>  $value['notes'],
                            'latitude'  =>  $value['latitude'],
                            'longitude' =>  $value['longitude'],
                            'created_at'=>  $value['created_at'],
                            'modified_at'=> $value['modified_at'],
                            'status'     => $value['status'],
                            'animalname' => $value['animalname'],
                            'animalimage' =>  '',//base64_encode($fileContent),
                            'threat_level_id' =>$value['threat_level_id'],
                            'level'         => $value['level'],
                            'color'         => $value['color'],
                            'username'      => $value['username'],
                        );
                       
                       
                   }
                        
                    $allNotification = Yii::app()->db->createCommand($sql)->queryAll();
                     //echo "<pre>"; print_r($userlocation); die;
                    $this->render('index',array(
			'allNotification'=>$allNotification,'userlocation'=>$userlocation , 'id'=>$id,'triggarid'=>$triggarid 
		));
            
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
