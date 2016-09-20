<?php

class CategoriesController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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
        
         public function actionCategorieslist($id=null){
           // echo Yii::app()->request->getUrl(); die;
           
                if($_GET == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_GET;
                }
               
                if(isset($body['id'])){
                   $id= $body['id'];
                  
                   $bycategoryid = Categories::model()->findAllByAttributes(array('id'=>$id));
                    echo CJSON::encode(array('status'=>'1','bycategoryid'=>$bycategoryid));
                     Yii::app()->end();

                }else{
                    $allbycategory = Categories::model()->findAll();
                    echo CJSON::encode(array('status'=>'1','all'=>$allbycategory));
                     Yii::app()->end();

                    
                }
        }
        
        
}