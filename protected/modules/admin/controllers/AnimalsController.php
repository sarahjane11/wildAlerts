<?php

class AnimalsController extends AdminController
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
		$model=new Animals;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Animals']))
		{
                    //if there is uploaded image move it to the server
                    if (CUploadedFile::getInstance($model,'image')){

                        $file_name = CUploadedFile::getInstance($model,'image');
                        $output_file_path = $_SERVER['DOCUMENT_ROOT'].Yii::app()->baseUrl.'/upload/animals_images';
                        $output_file=$output_file_path."/".time().$file_name;
                        //if no upload directory create one
                        if(!file_exists($output_file_path)){
                            mkdir($output_file_path,0777);
                        }
                        $model->image_name= CUploadedFile::getInstance($model,'image');
                        $model->image_name->saveAs($output_file);
                        $model->image_name= $file_name;
                        $model->image_path=$output_file;
                    }
                    $model->attributes=$_POST['Animals'];
                    $model->created_at=date('Y-m-d H:i:s');
                    $model->modified_at=date('Y-m-d H:i:s');
                    if($model->save()){
                        Yii::app()->user->setFlash('success', "Data saved successfully !");
                        $this->redirect(array('admin'));
                    }
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

		if(isset($_POST['Animals']))
		{
			$model->attributes=$_POST['Animals'];
			if($model->save()){
                                Yii::app()->user->setFlash('success', "Data updated successfully !");
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
		if($this->loadModel($id)->delete())
                    Yii::app()->user->setFlash('success', "Data delete successfully !");

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Animals');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Animals('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Animals']))
			$model->attributes=$_GET['Animals'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Animals the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Animals::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Animals $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='animals-form')
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
        
        
        public function actionImport(){
           
           
        $model=new Animals;
        
        if(isset($_POST['Import']) && isset($csv_file['tmp_name']) &&  !empty($csv_file['tmp_name']) && $csv_file['tmp_name'][0]!='')
        {
          
         $csv_file=$_FILES['csvfile'];
       
         $model->attributes=$_POST['Import'];
              
         $handle = fopen($csv_file['tmp_name'][0], "r");
    
            try{
                 $transaction = Yii::app()->db->beginTransaction();
                  $row = 1;
                  $getTId='';
                  $cid = '';
                   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                       
                       if($row>1){
                                    
                                  $model=new Animals;       
                                  $model->name=$data[0];
                                  $getThertId = ThreatLevels::model()->findByAttributes(array('level'=> $data[1]));
                                  //echo "<pre>"; print_r($getThertId); die;
                                  if(!empty($getThertId)){
                                       
                                      $getThertId->level= $data[1];
                                      $getThertId->color = '#fcfc00';
                                      $getThertId->status='1';
                                      $getThertId->modified_at=date('Y-m-d H:i:s');
                                      if($getThertId->update())
                                          $getTId=$getThertId->id;
                                      
                                  }
                                  else{
                                      $getThertId = new ThreatLevels();
                                      $getThertId->level= $data[1];
                                      $getThertId->color = '#fcfc00';
                                      $getThertId->status='1';
                                      $getThertId->created_at=date('Y-m-d H:i:s');
                                      $getThertId->modified_at=date('Y-m-d H:i:s');
                                      if($getThertId->save())
                                          $getTId=$getThertId->id;
                                      
                                  }
                                  
                                  $getCatid= Categories::model()->findByAttributes(array('category'=> $data[2]));
                                  if(!empty($getCatid)){
                                      $getCatid->category = $data[2];
                                      $getCatid->status = 1;
                                      $getCatid->modified_at=date('Y-m-d H:i:s');
                                       if($getCatid->update()){
                                             $cid=$getCatid->id;
                                        }
                                      
                                  }else{
                                        $getCatid = new Categories();
                                        $getCatid->category = $data[2];
                                        $getCatid->status = 1;
                                        $getCatid->created_at=date('Y-m-d H:i:s');
                                        $getCatid->modified_at=date('Y-m-d H:i:s');
                                       if($getCatid->save()){
                                             $cid=$getCatid->id;
                                        }
                                  }
                                  
                                  $model->threat_level_id=$getTId;
                                  $model->category_id=$cid;
                                  $model->created_at=date('Y-m-d H:i:s');
                                  $model->modified_at=date('Y-m-d H:i:s');
                                  $model->status = 1;
                                  $model->save();            
                            }
                         
                      $row++;               
                   }
            $transaction->commit();
           }catch(Exception $error){
               print_r($error);
               $transaction->rollback();
           } 
                                  
        }
        else{
            Yii::app()->user->setFlash('error', "CSV file cannot be blank.");

        }
        
        $this->redirect('admin',array(
         'model'=>$model,
        ));        
    }

}
