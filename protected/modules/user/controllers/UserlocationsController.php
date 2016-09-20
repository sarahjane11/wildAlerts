<?php

class UserlocationsController extends UsersController
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
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
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
		$model=new UserLocations;
                $allLocation=[];
                $user_id = Yii::app()->user->getId();
                
                $getuserLocation = UserLocations::model()->findAllByAttributes(array('user_id'=>$user_id,'status'=>1));
		
                 if(!empty($getuserLocation)){
                    foreach($getuserLocation as $key => $value){
                        $allLocation[] =array(

                               'id' => $value->id,
                               'location_type' => $value->location_type,
                               'description' => $value->description,
                               'latitude' => $value->latitude,
                               'longitude' => $value->longitude,
                               'modified_at' => $value->modified_at,

                        );

                     }
                 }
                  
                   //echo "<pre>"; print_r($allLocation); die;
                 
		if(isset($_POST['UserLocations']))
		{
                     
                    $user_id = Yii::app()->user->getId();
                    $loctype = $_POST['UserLocations']['location_type'];
                     
                    if($loctype !='' && $_POST['UserLocations']['latitude'] != '' && $_POST['UserLocations']['longitude'] != '' ){
                        $getuserloc = UserLocations::model()->findByAttributes(array('user_id'=>$user_id,'location_type'=>$loctype));
                    
                   
                    if(!empty($getuserloc)){
                        
                        $getuserloc->setScenario('setloc');
                        $getuserloc->latitude    = (isset($_POST['UserLocations']['latitude'])) ? $_POST['UserLocations']['latitude'] : '';
                        $getuserloc->longitude    = (isset($_POST['UserLocations']['longitude'])) ? $_POST['UserLocations']['longitude'] : '';
                        $getuserloc->description    = (isset($_POST['UserLocations']['description'])) ? $_POST['UserLocations']['description'] : $getuserloc->description;
                        $getuserloc->alert_notification    = (isset($_POST['UserLocations']['alert_notification'])) ? $_POST['UserLocations']['alert_notification'] : '';
                        $getuserloc->modified_at = date('Y-m-d H:i:s');
                        $getuserloc->status    = 1;
                        $validate=CActiveForm::validate($getuserloc); 
                        if($validate && $getuserloc->update()){
                            return $this->redirect(array('Userlocations/index'));
                            
                        }
                    }
                    
                    else{
                       
                     $model->setScenario('setloc');
                     $model->user_id        = Yii::app()->user->getId();
                     $model->location_type  = (isset($_POST['UserLocations']['location_type'])) ? $_POST['UserLocations']['location_type'] : '';
                     $model->description    = (isset($_POST['UserLocations']['description'])) ? $_POST['UserLocations']['description'] : '';
                     $model->latitude    = (isset($_POST['UserLocations']['latitude'])) ? $_POST['UserLocations']['latitude'] : '';
                     $model->longitude    = (isset($_POST['UserLocations']['longitude'])) ? $_POST['UserLocations']['longitude'] : '';
                     $model->alert_notification    = (isset($_POST['UserLocations']['alert_notification'])) ? $_POST['UserLocations']['alert_notification'] : '';
                     $model->created_at = date('Y-m-d H:i:s');
                     $model->modified_at = date('Y-m-d H:i:s');
                     $model->status    = 1;
                        
			if($model->validate() && $model->save()){
                            return $this->redirect(array('Userlocations/index'));
                           
                        }
                        
                }
				
                }else{ Yii::app()->user->setFlash('error', "Please enter address");


                }     
            }

		$this->render('create',array('model'=>$model,'allLocation'=>$allLocation));
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
			if($model->validate() && $model->save())
                            $this->redirect(array('index'));
				//$this->redirect(array('view','id'=>$model->id));
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
	public function actionDelete()
	{
                 //echo "<pre>"; print_r($_POST); die;
                 
                 $id = $_POST['id'];
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//		$dataProvider=new CActiveDataProvider('UserLocations');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
            
                $id = Yii::app()->user->getId();
                $sqlloc = "SELECT * From user_locations WHERE user_id='$id'";
                $getalluserlocation = Yii::app()->db->createCommand($sqlloc)->queryAll();
                
                $this->render('index',array(
			'getalluserlocation'=>$getalluserlocation,
		));
            
            
            
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
}
