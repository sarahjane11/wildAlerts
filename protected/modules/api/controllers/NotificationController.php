<?php

class NotificationController extends Controller
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
        
        public function actionNotificationSetting(){
            
            $body=[];

                if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
                 
            if(isset($body['user_id']) || isset($body['email_alert']) || isset($body['alert_distance']) || isset($body['location_type']) || isset($body['alert_notification']) || isset($body['alert_days']) || isset($body['threatnotification'])){
                $user_id = $body['user_id'];
                
                
                //set threat notification
                //if(($body['user_id']) && isset($body['alert_distance']) && isset($body['Threatnotification'])){
                if(isset($body['user_id']) && isset($body['threatnotification'])){
                   
                    $string1=$body['threatnotification'];
                    
                     foreach($string1 as $key =>$value){
                          $threat_id = $value['id'];
                         $alert_distance = $value['distance'];
                         $model = ThreatNotificationSettings::model()->findByAttributes(array('user_id'=> $user_id, 'threat_id'=>$threat_id));
                         if(!empty($model)){

                             $model->setScenario('update');
                             $model->distance = (isset($alert_distance)) ? $alert_distance : 20;
                             $model->status = 1;
                             $model->modified_at = date('Y-m-d H:i:s');
                             if($model->validate() && $model->update()){
                                // echo CJSON::encode(array('status'=>'1','msg'=>'setting update successfuly'));
                                 //Yii::app()->end(); 
                             }else{
                                 echo CJSON::encode(array('status'=>'0','msg'=>'setting update fail'));
                                Yii::app()->end(); 
                             }
                             
                        }else{
                               
                            $model = new ThreatNotificationSettings;
                            $model->user_id = $user_id;
                            $model->threat_id = $threat_id;
                            $model->distance = (isset($alert_distance)) ? $alert_distance : 20;
                            $model->status = 1;
                            $model->created_at = date('Y-m-d H:i:s');
                            $model->modified_at = date('Y-m-d H:i:s');
                            if($model->validate() && $model->save()){
                                //echo CJSON::encode(array('status'=>'1','msg'=>'setting Save successfuly'));
                              // Yii::app()->end(); 
                            }else{
                                echo CJSON::encode(array('status'=>'0','msg'=>'setting Save fail'));
                               Yii::app()->end();
                            }


                        }
                     }
                    
                    echo CJSON::encode(array('status'=>'1','msg'=>'setting change successfuly'));
                     Yii::app()->end();
                   
                }
                //set email alert and alert days
               else if(isset($body['user_id']) && isset($body['email_alert']) || isset($body['alert_distance']) || isset($body['alert_days'])){
                   
                    $settingNotification = User::model()->findByAttributes(array('id'=>$user_id , 'status'=>1));
                    
                    if(!empty($settingNotification)){
                        $settingNotification -> email_alert = (isset($body['email_alert'])) ? $body['email_alert'] : 1;

                        $settingNotification -> alert_distance = (isset($body['alert_distance'])) ? $body['alert_distance'] : 10;
                        
                        $settingNotification -> alert_days = (isset($body['alert_days'])) ? $body['alert_days'] : 1;
                        
                        if($settingNotification->update()){
                                //$getSetting= User::model()->findByAttributes(arrary('id'=>$user_id));
                           echo CJSON::encode(array('status'=>'1','msg'=>'setting update successfuly'));
                           Yii::app()->end(); 
                        }


                    }
                    else{
                           echo CJSON::encode(array('status'=>'0','msg'=>'User not found !'));
                           Yii::app()->end();    
                    }
                    
                }
               else if(isset($body['location_type']) || isset($body['user_id']) || isset($body['alert_notification'])){
                     $type = $body['location_type'];
                     $user_id = $body['user_id'];
                    $settingNotification =UserLocations::model()->findByAttributes(array('user_id'=>$user_id ,'location_type'=>$type,'status'=>1));
                    
                    if(!empty($settingNotification)){
                        
                        if(isset($body['location_type']) && isset($body['user_id']) && isset($body['alert_notification'])){
                           $settingNotification -> alert_notification    = $body['alert_notification'];
                           $settingNotification->update();
                           echo CJSON::encode(array('status'=>'1','msg'=>'setting update successfuly'));
                           Yii::app()->end(); 
                        }
                    }
                    else{
                           echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                           Yii::app()->end();    
                    }
                }
                
            
            }
            else{
                
                         echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                           Yii::app()->end();    
                }
            
        }
        
        //get all notifiication
        
        public function actionNotification(){
            $body=[];

                if($_GET == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_GET;
                }
                if(isset($body['user_id'])){
                    
                   $id = $body['user_id'];
                   
                   $sql = "" ;
                   $notification_seeting = ThreatNotificationSettings::model()->findAllByAttributes(array('user_id'=>$id));
                   
                   $user_locations = UserLocations::model()->findAllByAttributes(array('user_id'=>$id,'status'=>'1'));
                    //echo count($notification_seeting);
                   if($notification_seeting==1 &&  $user_locations==1){
                        $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username,u.alert_days
                                from wild_alert_posts wap,user_locations ul , threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and tn.user_id = ul.user_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else if($notification_seeting==1){
                      
                        $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and u.id = '$id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                group by wap.id
                                order by wap.id DESC";
                  }else if($user_locations==1){
                       $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,user_locations ul, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and  (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <=20
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else{
                      
                         $sql="select wap.id,  wap.user_id, wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from  wild_alert_posts wap, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id and u.id = wap.user_id
                                and a.threat_level_id=tl.id
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$id' and status=0)
                                and (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <= 20
                                group by wap.id 
                                 order by wap.id DESC";
                                
                  }
                   
                   
                   
                   $allnotification = Yii::app()->db->createCommand($sql)->queryAll();
                   $notification=[];
                   foreach ($allnotification as  $key => $value) {
                       $fileContent=  file_get_contents($value['image_path']."/".$value['image_name']);
                        $notification[]=array(
                            'id'         =>  $value['id'],
                            'user_id'    =>  $value['user_id'] ,
                            'animal_id'  =>  $value['animal_id'] ,
                            'title'      =>  $value['title'],
                            'notes'      =>  $value['notes'],
                            'latitude'   =>  $value['latitude'],
                            'longitude'  =>  $value['longitude'],
                            'created_at' =>  $value['created_at'],
                            'modified_at'=>  $value['modified_at'], //date('Y-m-d H:i:s +z', strtotime($value['modified_at'])),
                            'status'     =>  $value['status'],
                            'animalname' =>  $value['animalname'],
                            //'animalimage' =>  base64_encode($fileContent),
                            'animalimagename'=> $value['image_name'],
                            'threat_level_id' =>$value['threat_level_id'],
                            'level'         => $value['level'],
                            'color'         => $value['color'],
                            'username'      => $value['username'],
                        );
                       
                       
                   }
                    
                    echo CJSON::encode(array('status'=>'1','allnotification'=>$notification));
                           Yii::app()->end(); 
                     
                     
                }
                else{
                    
                   echo CJSON::encode(array('status'=>'0','msg'=>'invalid request'));
                           Yii::app()->end();  
                }
                
        }
        
  
      
     //get animal image
      public function actionGetAnimalImage(){
          $body=[];

            if($_GET == null){
                    $rawData  = file_get_contents('php://input');
                    $body = json_decode($rawData,true);

            }
            else{
               $body = $_GET;
            }
             if(isset($body['id'])){
                 
                 $id=$body['id'];
                 
                 $animalImage = WildAlertPosts::model()->findByPk($id);
                 if(!empty($animalImage)){
                     $img_path=$animalImage->image_path;
                     $animalimage = $animalImage->image_name;
                     if($animalImage->image_path !='' && $animalImage->image_name != ''){
                        $fileContent=  file_get_contents($animalImage->image_path."/".$animalImage->image_name);

                        echo CJSON::encode(array('status'=>'1','image'=>base64_encode($fileContent)));
                         Yii::app()->end();  
                     }else{
                         echo CJSON::encode(array('status'=>'0','image'=>''));
                            Yii::app()->end();
                     }
               
                 }
                 else{
                     echo CJSON::encode(array('status'=>'0','image'=>''));
                        Yii::app()->end();
                 }
             }
             else{
                echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                Yii::app()->end();  
             }
      } 
      
      
      public function actionGetSetting(){
           if($_GET == null){
                $rawData  = file_get_contents('php://input');
                $body = json_decode($rawData,true);

            }
            else{
               $body = $_GET;
            }
            if(isset($body['user_id'])){
                $user_id = $body['user_id'];
               // $sql="SELECT u.email_alert,u.alert_days,ul.location_type,ul.alert_notification from user u LEFT join user_locations as ul on ul.user_id= u.id WHERE u.id= '$user_id'";
                $sql = "SELECT email_alert,alert_days FROM user WHERE id ='$user_id'";
                $getSetting = Yii::app()->db->createCommand($sql)->queryAll();
                $sql1 = "SELECT location_type,description,alert_notification FROM user_locations where user_id='$user_id'";
                $getSetting1 = Yii::app()->db->createCommand($sql1)->queryAll();
                
                echo CJSON::encode(array('status'=>'1','getSetting'=>$getSetting,'getSetting1' => $getSetting1));
                Yii::app()->end(); 

            }else{
                echo CJSON::encode(array('status'=>'0','msg'=>'invalid request'));
                  Yii::app()->end();  
            }
       } 
     
}