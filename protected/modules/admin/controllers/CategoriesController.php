<?php

class CategoriesController extends AdminController
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
				'actions'=>array('index','view','create','update','admin','delete','Activate','Deactivate'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete'),
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
		$model=new Categories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Categories']))
		{   
                    
                            foreach ($_POST['Categories'] as $key => $value) {
                                $model=new Categories;
                                if($value == ''){
                                    Yii::app()->user->setFlash('error', "Categories can not be blank.");
                                    $this->render('create',array(
                                            'model'=>$model,
                                    ));
                                    Yii::app()->end();
                                }
                                $model->category= isset($value) ? $value:'' ;
                                $model->created_at = date('Y-m-d H:i:s');
                                $model->modified_at = date('Y-m-d H:i:s');
                                $model->status= 1;
                                $valid=$model->validate(); 
                                if($valid && $model->save()){
                                   // Yii::app()->user->setFlash('success', "Data saved!");
                                   // $this->redirect(array('admin'));
                                }

                             }
                             Yii::app()->user->setFlash('success', "Data saved successfully!");
                             $this->redirect(array('admin'));
                               //$model->attributes=$_POST['Categories'];
                                //if($model->save())
                    	
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

		if(isset($_POST['Categories']))
		{
			$model->attributes=$_POST['Categories'];
			if($model->save()){
                            Yii::app()->user->setFlash('success', "Data updated successfully!");
                            $this->redirect(array('admin'));
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
                $getOther  = Categories::model()->findByPk($id);
                if(isset($getOther) && $getOther['category'] != 'other'){
		if($this->loadModel($id)->delete())
                    Yii::app()->user->setFlash('success', "Data delete successfully!");
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
            $dataProvider=new CActiveDataProvider('Categories');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Categories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Categories']))
			$model->attributes=$_GET['Categories'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Categories the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Categories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Categories $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='categories-form')
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
