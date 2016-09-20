<?php

class UserlocationsController extends Controller
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
        
        
        public function actionUpdate($id=null){
            if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
                
                if(isset($body['id'])){
                   $id=$body['id'];
                   $updateLocation = UserLocations::model()->findByPk($id);
                   
                   
                   
                   if(!empty($updateLocation)){
                       
                    $updateLocation->user_id          =   (isset($body['user_id'])) ? $body['user_id']: '';
                    $updateLocation->location_type    =   (isset($body['location_type'])) ? $body['location_type']: '';
                    $updateLocation->description      =   (isset($body['description'])) ? $body['description'] : ''; 
                    $updateLocation->latitude         =   (isset($body['latitude'])) ? $body['latitude']:'';
                    $updateLocation->longitude        =   (isset($body['longitude'])) ? $body['longitude'] : '';
                    $updateLocation->created_at       =   date('Y-m-d H:i:s');
                    $updateLocation->modified_at      =   date('Y-m-d H:i:s');
                    $updateLocation->status           =   1;
                       $valid=$updateLocation->validate();
                       if($valid && $updateLocation->update()){
                           $id = $updateLocation->id;
                           $allLocation = UserLocations::model()->findByAttributes(array('id'=>$id));
                           
                         echo CJSON::encode(array('status'=>'1','msg'=>"Your add successfully!",'allLocation'=>$allLocation));
                         Yii::app()->end();
                       }
                       else{
                          
                        $error = CActiveForm::validate($updateLocation);
                        if($error!='[]')
                        echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                        Yii::app()->end();  
                       }
                   }
                   else{
                       
                      $error = CActiveForm::validate($updateLocation);
                        if($error!='[]')
                        echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                        Yii::app()->end();  
                   }
                   
                }else{
                    $saveLocation = new UserLocations;
                    
                    $saveLocation->user_id          =   (isset($body['user_id'])) ? $body['user_id']: '';
                    $saveLocation->location_type    =   (isset($body['location_type'])) ? $body['location_type']: '';
                    $saveLocation->description      =   (isset($body['description'])) ? $body['description'] : '';
                    $saveLocation->latitude         =   (isset($body['latitude'])) ? $body['latitude']:'';
                    $saveLocation->longitude        =   (isset($body['longitude'])) ? $body['longitude'] : '';
                    $saveLocation->created_at       =   date('Y-m-d H:i:s');
                    $saveLocation->modified_at      =   date('Y-m-d H:i:s');
                    $saveLocation->status           =   1;
                    
                    $valid=$saveLocation->validate();
                    if($valid && $saveLocation->save()){
                        
                         $id = $saveLocation->id;
                         $allLocation = UserLocations::model()->findByAttributes(array('id'=>$id));
                           
                         echo CJSON::encode(array('status'=>'1','msg'=>"Your add successfully!",'allLocation'=>$allLocation));
                         Yii::app()->end();
                    }
                    else{
                       $error = CActiveForm::validate($saveLocation);
                        if($error!='[]')
                        echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                        Yii::app()->end(); 
                    }
                }
                
            
                
        }
        
        //fatch data all or by id 
        public function actionLocation(){
            if($_GET == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_GET;
                }
            
            if(isset($body['id']) && isset($body['user_id'])){
                   $id= $body['id'];
                   $user_id = $body['user_id'];
                  
                   $allLocationById = UserLocations::model()->findByAttributes(array('id'=>$id,'user_id'=> $user_id, 'status'=>1));
                   echo CJSON::encode(array('status'=>'1','allLocationById'=>$allLocationById));
                   Yii::app()->end();

            }else{
                // echo "<pre>"; print_r($body); die;
                $user_id = $body['user_id'];
                $allLocation = UserLocations::model()->findAllByAttributes(array('user_id'=> $user_id, 'status'=>1));
                echo CJSON::encode(array('status'=>'1','allLocation'=>$allLocation));
                 Yii::app()->end();


            }
        } 
        
    public function actionCurrentLocation(){
        if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
                
                if(isset($body['user_id']) && isset($body['latitude']) && isset($body['longitude'])){
                        $user_id=$body['user_id'];
                       
                        $model= User::model()->findByAttributes(array('id'=>$user_id));
                        
                        if(!empty($model)){
                            $model->latitude =(isset($body['latitude'])) ? $body['latitude'] : '' ;
                            $model->longitude =(isset($body['longitude'])) ? $body['longitude'] : '' ;
                            $model->setScenario('currentlcation');
                             
                             $valid=$model->validate();
                             if($valid && $model->update()){
                                 
                                 $user = User::model()->findByAttributes(array('id'=>$user_id));
                                  echo CJSON::encode(array('status'=>'1','msg'=>'login success !','user'=>$user));
                                    Yii::app()->end();
                             }
                             else{
                                  
                                $error = CActiveForm::validate($model);
                                if($error!='[]')
                                echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                                
                                 Yii::app()->end();
                                 
                             }

                        }
                        else{
                            echo CJSON::encode(array('status'=>'0','msg'=>'Data not found !'));
                                    Yii::app()->end();
                        }
                     
                }
                else{
                    echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                        Yii::app()->end(); 
                }
    }  
    
    
    public function actionlocationdelete(){
        if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

        }
        else{
           $body = $_POST;
        }
         if(isset($body['id'])){
             $id = $body['id'];
              $deleteLocation = UserLocations::model()->findByAttributes(array('id'=>$id));
              if(!empty($deleteLocation)){
                  $deleteLocation->delete();
                  echo CJSON::encode(array('status'=>'1','msg'=>'Delete successfuly !'));
                    Yii::app()->end(); 
              }else{
                  echo CJSON::encode(array('status'=>'0','msg'=>'Delete Fail !'));
                    Yii::app()->end(); 
              }
             
         }else{
             echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
             Yii::app()->end(); 
         }
        
        
        
    }
    
    
    
}