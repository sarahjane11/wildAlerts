<?php

class ThreatlevelsController extends Controller
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
        
        public function actionThreatlist($id=null){
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
                   $user_id=$body['user_id'];
                   $byIdThreatLavel = ThreatLevels::model()->findAllByAttributes(array('id'=>$id));
                   echo CJSON::encode(array('status'=>'1','byIdThreatLavel'=>$byIdThreatLavel));
                   Yii::app()->end();

                }else{
                    $user_id=$body['user_id'];
                    $sql = "SELECT threat_levels.*, IFNULL(threat_notification_settings.distance,20) as distance FROM threat_levels LEFT JOIN threat_notification_settings ON threat_levels.id=threat_notification_settings.threat_id and threat_notification_settings.user_id = '$user_id' ORDER BY threat_levels.id DESC";
                    $allThreatLavel = Yii::app()->db->createCommand($sql)->queryAll();
                    
                    //$allThreatLavel = ThreatLevels::model()->findAll();
                    echo CJSON::encode(array('status'=>'1','allThreatLavel'=>$allThreatLavel));
                     Yii::app()->end();

                    
                }
        }




        /*public function actionAddThreatlist($id=null){
            $body=[];

                if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
                if(isset($body['id']) || isset($body['level'])){
                    if($body['color']==''){
                        $body['color']= "#fcfc00";
                    }
                    
                    if(isset($body['id'])){
                        
                        $byIdThreatLavel = ThreatLevels::model()->findAllByAttributes(array('id'=>$id));
                        if(!empty($model)){
                        $model->level = (isset($body['level'])) ? $body['level']: '';
                        $model->color = (isset($body['color'])) ? $body['color']: '#fcfc00';
                        $valid=$model->validate(); 
                            if($valid && $model->update()){
                                $allThreatLavel = ThreatLevels::model()->findAll();
                                echo CJSON::encode(array('status'=>'0','msg'=>"update successfully!",'afterupdate'=>$allThreatLavel));

                            }else{
                                $error = CActiveForm::validate($model);
                                if($error!='[]')
                                echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                                Yii::app()->end();


                            }
                        }
                    }else{
                        
                        
                      
                    $model = new ThreatLevels();
                    $model->level = (isset($body['level'])) ? $body['level']: '';
                    $model->color = (isset($body['color'])) ? $body['color']: '#fcfc00';
                    $valid=$model->validate(); 
                     echo "<pre>"; print_r($valid); die;
                    if($valid && $model->save()){
                     
                        $allThreatLavel = ThreatLevels::model()->findAll();
                        echo CJSON::encode(array('status'=>'1','msg'=>"Your add successfully!",'allThreatLavel'=>$allThreatLavel));
                         Yii::app()->end();
                        
                    }else{
                      
                        $error = CActiveForm::validate($model);
                        if($error!='[]')
                        echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                        Yii::app()->end();
                                
                            
                    }
                   }
                    
                }else{
                   echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                   Yii::app()->end();  
                }
        }*/
        
       
        
        
}