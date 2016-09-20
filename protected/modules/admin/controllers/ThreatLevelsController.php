<?php

class ThreatLevelsController extends AdminController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin/admin';

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
				'actions'=>array('index','view','create','update','delete','Activate','Deactivate'),
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
		$model = new ThreatLevels;
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ThreatLevels']))
		{       
			//$color = $_POST['ThreatLevels']['color'];
                        $model->setScenario('addthreat'); 
                        $model->level =  (isset($_POST['ThreatLevels']['level'])) ? $_POST['ThreatLevels']['level'] : '';
                        $model->color =  (isset($_POST['ThreatLevels']['color'])) ? $_POST['ThreatLevels']['color'] : '';
                        $model->created_at=date('Y-m-d H:i:s');
                        $model->modified_at=date('Y-m-d H:i:s');
                        $model->status = 1;
                        $valid = $model->validate();
			if($valid && $model->save()){
                            Yii::app()->user->setFlash('success', "Data saved successfully !");
                            $this->redirect(array('admin'));
                        }
//                        else{
//                            $error = CActiveForm::validate($model);
//                               
//                                if($error!='[]')
//                                     $this->render('create',array('model'=>$model));
//                                Yii::app()->end();
//                        }
				
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

		if(isset($_POST['ThreatLevels']))
		{
			$model->setScenario('addthreat'); 
                        $model->level =  (isset($_POST['ThreatLevels']['level'])) ? $_POST['ThreatLevels']['level'] : '';
                        $model->color =  (isset($_POST['ThreatLevels']['color'])) ? $_POST['ThreatLevels']['color'] : '';
                        //$model->created_at=date('Y-m-d H:i:s');
                        $model->modified_at=date('Y-m-d H:i:s');
                        $model->status = 1;
                        $valid = $model->validate();
			if($valid && $model->save()){
                            Yii::app()->user->setFlash('success', "Data updated successfully !");
                            $this->redirect(array('admin','id'=>$model->id));
                        }
				
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
                $getforDelete = ThreatLevels::model()->findByPk($id);
                 
               if(isset($getforDelete['level']) && $getforDelete['level'] != 'other'){
		IF($this->loadModel($id)->delete())
                     Yii::app()->user->setFlash('success', "Data delete successfully !");
               }else{
                   Yii::app()->user->setFlash('error', "other, you can not delete it.");
               }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ThreatLevels');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
           
		$model=new ThreatLevels('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ThreatLevels']))
			$model->attributes=$_GET['ThreatLevels'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ThreatLevels the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ThreatLevels::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ThreatLevels $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='threat-levels-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionActivate($id) {
             
            $model = $this->loadModel($id);
            $model->status = 1;
                if($model->update()){
                    $this->redirect(array('admin','id'=>$model->id));
                }else{
                    echo 'not update';
                }

        }

        public function actionDeactivate($id) {
            $model = $this->loadModel($id);
            $model->status = 0;
            $model->update();
            $this->redirect(array('admin','id'=>$model->id));

        }
        
}
