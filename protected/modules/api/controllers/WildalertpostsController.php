<?php

class WildalertpostsController extends Controller
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
        
        public function actionWildalertPostslist($id=null){
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
                  
                   $byId = WildAlertPosts::model()->findAllByAttributes(array('id'=>$id));
                   echo CJSON::encode(array('status'=>'1','byId'=>$byId));
                   Yii::app()->end();

                }else{
                    
                    $all = WildAlertPosts::model()->findAll();
                    echo CJSON::encode(array('status'=>'1','all'=>$all));
                     Yii::app()->end();

                    
                }
        }
        
        //add update wildalertposts
        public function actionWildalertPosts($id=null){
            $body=[];
             
                if($_POST == null || empty($_POST)){ 
                        $rawData  = file_get_contents('php://input');
                        // echo "<pre>"; print_r($rawData); die;
                        $body = json_decode($rawData,true);
                       
                       
                }
                else{
                   $body = $_POST;
                }
                
                 
                //echo "<pre>"; print_r($body); die;
               // if(isset($body['id'])){
                    $animal_id='';
                    if(isset($body['id'])){
                       $id= $body['id'];
                        $updateById = WildAlertPosts::model()->findByPk($id);
                        if(!empty($updateById)){
                            
                            $updateById->user_id    =    (isset($body['user_id'])) ? $body['user_id']: '';
                         
                            $updateById->animal_id  =    (isset($body['animal_id'])) ? $body['animal_id']: '';
                            $updateById->title      =    (isset($body['title'])) ? $body['title']: ''; 
                            $updateById->notes      =    (isset($body['notes'])) ?  trim(preg_replace('/\s\s+/', ' ', $body['notes'])): ''; 
                            $updateById->latitude   =    (isset($body['latitude'])) ? $body['latitude']: '';
                            $updateById->longitude  =    (isset($body['longitude'])) ? $body['longitude']: ''; 
                            $updateById->modified_at=   date('Y-m-d H:i:s +z');
                            //$output_file = $_SERVER['DOCUMENT_ROOT'].'/wildalerts/upload';
                            $output_file = $_SERVER['DOCUMENT_ROOT'].'/upload';
                             $base64_string = $body['image_name']; 
                             $imagename = $body['imagename'];

                            $imageInfo = $this->base64_to_jpeg($base64_string, $output_file,$imagename);
                             //echo "<pre>"; print_r($imageInfo); die;
                            $updateById->image_name =   $imageInfo['image_name']; //(isset($imageInfo['image_name'])) ? $imageInfo['image_name']: '';
                            $updateById->image_path =   $imageInfo['image_path'];// (isset($imageInfo['image_path'])) ? $imageInfo['image_path']: '';
                          
                            $updateById->status = 1;
                         
                            $valid=$updateById->validate(); 
                            
                            if($valid && $updateById->update()){
                                //$this->pushnotification($id);
                                 //$getAllPost = WildAlertPosts::model()->findByAttributes(array('status'=>1));
                                     $sql ="SELECT user.name as username, user.id as userid,animals.name as animalname,threat_levels.id as threat_level_id,threat_levels.level,threat_levels.color,wild_alert_posts.id,wild_alert_posts.animal_id,wild_alert_posts.image_name,wild_alert_posts.title,wild_alert_posts.notes,wild_alert_posts.latitude,wild_alert_posts.longitude,wild_alert_posts.created_at,wild_alert_posts.modified_at,wild_alert_posts.status FROM wild_alert_posts LEFT JOIN user ON user.id = wild_alert_posts.user_id LEFT JOIN animals ON animals.id = wild_alert_posts.animal_id LEFT JOIN threat_levels ON threat_levels.id = animals.threat_level_id WHERE wild_alert_posts.id = $updateById->id";

                        $getAllPost = Yii::app()->db->createCommand($sql)->queryAll();
                                    echo CJSON::encode(array('status'=>'1','getAllPost'=>$getAllPost));
                                     Yii::app()->end();

                            }else{
                                $error = CActiveForm::validate($updateById);
                                if($error!='[]')
                                echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                                Yii::app()->end();


                            }
                        }
                    }else{
                       
                    $model = new WildAlertPosts();
                    $model->user_id    =    (isset($body['user_id'])) ? $body['user_id']: '';
                    if(isset($body['animal_name']) && $body['animal_name'] != ''){
                            $animal_name = $body['animal_name'];
                        $getbyname = Animals::model()->findAllByAttributes(array('name'=>$animal_name));
                        
                         if(!empty($getbyname)){
                            $animal_id = $getbyname[0]->id;
                        }else{
                        $getOtherId = Categories::model()->findAllByAttributes(array('category'=>'other'));
                        $getOtherIdthret = ThreatLevels::model()->findAllByAttributes(array('level'=>'other'));
                         if(!empty($getOtherId) && !empty($getOtherIdthret)){
                             $animalmodel = new Animals();
                            // echo "<pre>"; print_r($animalmodel); die;
                            $animalmodel->name = (isset($body['animal_name'])) ? $body['animal_name']: '';
                            $animalmodel->threat_level_id = (isset($body['threat_level_id'])) ? $body['threat_level_id']:$getOtherIdthret[0]->id;
                            $animalmodel->category_id = (isset($body['category_id'])) ? $body['category_id']:$getOtherId[0]->id ;
                            $animalmodel->created_at = date('Y-m-d H:i:s +z');
                            $animalmodel->modified_at = date('Y-m-d H:i:s +z');
                            $animalmodel->status = 1;

                                if($animalmodel->save(false)){
                                    
                                    $animal_id =$animalmodel->id;
                                }
                         }
                        }
                        
                        
                    }
                    //check whether animal has image, upload one if doesnot has
                    $animalID = (isset($body['animal_id'])) ? $body['animal_id']: $animal_id;
                    $animal = Animals::model()->findByPk($animalID);
                    
                    if(!$animal->image_path){
                    
                        $output_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->baseUrl.'/upload/animals_images';
                        $base64_string = $body['image_name'];
                        $imagename = $body['imagename'];
                        $imageInfo = $this->base64_to_jpeg($base64_string, $output_file, $imagename);
                        $animal->image_name = $body['imagename'];
                        $tmp = (isset($imageInfo['image_path'])) ? $imageInfo['image_path']: '';
                        $animal->image_path = $tmp.'/'.$animal->image_name;
                        $animal->update();
                    }

                    $model->animal_id  =    (isset($body['animal_id'])) ? $body['animal_id']: $animal_id;
                    
                    $model->title      =    (isset($body['title'])) ? $body['title']: ''; 
                    $model->notes      =    (isset($body['notes'])) ?  trim(preg_replace('/\s\s+/', ' ', $body['notes'])): '';    
                    $model->latitude   =    (isset($body['latitude'])) ? $body['latitude']: '';
                    $model->longitude  =    (isset($body['longitude'])) ? $body['longitude']: ''; 
                    $model->created_at =    date('Y-m-d H:i:s +z');
                    $model->modified_at=    date('Y-m-d H:i:s +z');
                    //$output_file = $_SERVER['DOCUMENT_ROOT'].'/wildalerts/upload';
                    //$output_file = $_SERVER['DOCUMENT_ROOT'].'/upload';
                    $output_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->baseUrl.'/upload';
                    $base64_string = $body['image_name'];
                    $imagename = $body['imagename'];
                    $imageInfo = $this->base64_to_jpeg($base64_string, $output_file, $imagename);
                    $model->image_name =    (isset($imageInfo['image_name'])) ? $imageInfo['image_name']: '';
                    $model->image_path =    (isset($imageInfo['image_path'])) ? $imageInfo['image_path']: '';
                    $model->status = 1;
                            
                     
                    $valid=$model->validate(); 
                    // echo "<pre>"; print_r($valid); die;
                    if($valid && $model->save()){
                        $postid=$model->id;
                        //$this->pushnotification($postid);
                        
                          $sql ="SELECT user.name as username, user.id as userid,animals.name as animalname,threat_levels.id as threat_level_id,threat_levels.level,threat_levels.color,wild_alert_posts.id,wild_alert_posts.animal_id,wild_alert_posts.image_name,wild_alert_posts.title,wild_alert_posts.notes,wild_alert_posts.latitude,wild_alert_posts.longitude,wild_alert_posts.created_at,wild_alert_posts.modified_at,wild_alert_posts.status FROM wild_alert_posts LEFT JOIN user ON user.id = wild_alert_posts.user_id LEFT JOIN animals ON animals.id = wild_alert_posts.animal_id LEFT JOIN threat_levels ON threat_levels.id = animals.threat_level_id WHERE wild_alert_posts.id = $model->id";

                        $getAllPost = Yii::app()->db->createCommand($sql)->queryAll();
                            //$getAllPost = WildAlertPosts::model()->findByAttributes(array('status'=>1));
                        echo CJSON::encode(array('status'=>'1','getAllPost'=>$getAllPost));
                         Yii::app()->end();
                        
                    }else{
                      
                        $error = CActiveForm::validate($model);
                        if($error!='[]')
                        echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                        Yii::app()->end();
                          
                            
                    }
                   }
                    
//                }else{
//                   echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
//                   Yii::app()->end();  
//                }
        }
        
       //base 64 image upload
       public function base64_to_jpeg($base64_string, $output_file_path,$imagename) {
           
            //$file_name=date('Y-m-dH:i:s').rand(1,999).".jpg";
            $file_name = $imagename.".jpg";
            if(!file_exists($output_file_path)){
             
                mkdir($output_file_path,0777);
            }
            $output_file=$output_file_path."/".$file_name;
            $file=fopen($output_file,'a+');
            fwrite($file, base64_decode($base64_string)); 
            fclose($file); 

            return array('image_path'=>$output_file_path,'image_name'=>$file_name); 
      }
      
      //push notification
      public function pushnotification($postid){
          
          $id = $postid;
          $user_id = Yii::app()->user->getId();
          $sql = "" ;
          
          
           $sql ="SELECT u.id AS userid, u.name, u.email, ud.device_id
                    FROM user u, user_devices ud, user_locations ul, threat_notification_settings tns, wild_alert_posts wap
                    WHERE u.id = ud.user_id
                    AND u.id = ul.user_id
                    AND tns.user_id = u.id
                    AND wap.created_at >= DATE_SUB( CURDATE( ) , INTERVAL u.alert_days DAY ) 
                    AND ul.alert_notification =1
                    AND wap.id =  '$id'
                    AND tns.distance >= ( ((ACOS( SIN( (ul.latitude * PI( ) /180 ) ) * SIN( (wap.latitude * PI( ) /180 ) ) + COS( (ul.latitude * PI( ) /180 )) * COS( (wap.latitude * PI( ) /180 )) * COS( ((ul.longitude - wap.longitude) * PI( ) /180 )))) *180 / PI( )) *60 * 1.1515)
                    GROUP BY u.id";
           
           $alluser = Yii::app()->db->createCommand($sql)->queryAll();
           
           foreach($alluser as $key => $value){
               
               $divToken =   $value['device_id']; 
               $this->sendpushnotification($divToken);
           }
          
      }
      
      public function sendpushnotification($divToken){
          // Put your device token here (without spaces):
                $deviceToken = $divToken;

                // Put your private key's passphrase here:
                $passphrase = '123456';

                // Put your alert message here:
                $message = 'My first push notification!';

                ////////////////////////////////////////////////////////////////////////////////

                $ctx = stream_context_create();
                stream_context_set_option($ctx, 'ssl', 'local_cert', pemPath);
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

                // Open a connection to the APNS server
                $fp = stream_socket_client(
                        'ssl://gateway.push.apple.com:2195', $err,
                        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

                if (!$fp)
                        exit("Failed to connect: $err $errstr" . PHP_EOL);

                echo 'Connected to APNS' . PHP_EOL;

                // Create the payload body
                $body['aps'] = array(
                        'alert' => $message,
                        'sound' => 'default'
                        );

                // Encode the payload as JSON
                $payload = json_encode($body);

                // Build the binary notification
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

                // Send it to the server
                $result = fwrite($fp, $msg, strlen($msg));

                if (!$result)
                        echo 'Message not delivered' . PHP_EOL;
                else
                        echo 'Message successfully delivered' . PHP_EOL;

                // Close the connection to the server
                fclose($fp);
       }
       
}
