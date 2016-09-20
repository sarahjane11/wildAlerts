<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		 $this->render('index');
	}
        
        public function actionSignup(){
            $model=new User;
           
           
//            echo CJSON::decode(array('rawData'=>'0','msg'=>$request->isPost));
//            Yii::app()->end();
            $body=[];
           
            if($_POST == null){
                    $rawData  = file_get_contents('php://input');
                    $body = json_decode($rawData,true);
                   
            }
            else{
               $body = $_POST;
            }
             
            if(isset($body['email']) || isset($body['password']) || isset($body['name']) || isset($body['facebook_id']) || isset($body['device_id']))
            {   
 		if(isset($body['facebook_id']) && isset($body['email'])){
                                 $model->email=(isset($body['email'])) ? $body['email']: '';
                                $model->name=(isset($body['name'])) ? $body['name']: '';
                                $model->facebook_id=(isset($body['facebook_id'])) ? $body['facebook_id']: '';
                                $model->setScenario('fblogin');
                                $valid=$model->validate(); 
                                 //&& $model->socailLogin()
                        if($valid && $model->socailLogin()){

                             echo CJSON::encode(array('status'=>'1','msg'=>'fb login success !'));
                             Yii::app()->end();
                        }else{
                           $user= User::model()->findByAttributes(array('email'=>$body['email']));
                       
			if(!empty($user) && $user->email != '' && isset($body['facebook_id'])){
				$user->facebook_id=$body['facebook_id'];
                                $user->update();
                                $model->email=(isset($body['email'])) ? $body['email']: '';
                                $model->name=(isset($body['name'])) ? $body['name']: '';
                                $model->facebook_id=(isset($body['facebook_id'])) ? $body['facebook_id']: '';
                                $model->setScenario('fblogin');
                                $valid=$model->validate(); 
                                 //&& $model->socailLogin()
                                 if($valid && $model->socailLogin()){

                                      echo CJSON::encode(array('status'=>'1','msg'=>'fb login success !'));
                                      Yii::app()->end();
                                 }
//				echo CJSON::encode(array('status'=>'1'));
//		            	Yii::app()->end();
			}else{
                               $model->setScenario('fblogin');
                               $model->email=(isset($body['email'])) ? $body['email']: '';
                               $model->name=(isset($body['name'])) ? $body['name']: '';
                               $model->facebook_id=(isset($body['facebook_id'])) ? $body['facebook_id']: '';
                               $model->status = 1;
                               $model->is_authenticated = 1;
                               $model->email_alert= 1;
                               $model->alert_distance=10;
                               $model->alert_days = 7;
                               $model->created_at=date('Y-m-d H:i:s');
                               $model->modified_at=date('Y-m-d H:i:s');
                                
                               $validate=CActiveForm::validate($model);
                               
                                if($validate && $model->save()){
                                       if(isset($body['device_id']) && $body['device_id']!=''){
                                            $device = new UserDevices;
                                            $device->device_id = $body['device_id'];
                                            $device->user_id =  $model->id;
                                            $device->status = 1;
                                            $device->save();
                                       }
                                       $model->setScenario('fblogin');
                                       $valid=$model->validate(); 
                                        //&& $model->socailLogin()
                                        if($valid && $model->socailLogin()){

                                             echo CJSON::encode(array('status'=>'1','msg'=>'fb login success !'));
                                             Yii::app()->end();
                                        }
//                                       echo CJSON::encode(array('status'=>'1','msg'=>"Your registration has been done successfully."));
//                                       Yii::app()->end();
//                                        
                                        
                                }
                                else{
                                    $error = CActiveForm::validate($model);
                                    if($error!='[]')
                                       echo CJSON::encode(array('status'=>'0','msg'=>$error));
                                    
                                        Yii::app()->end();
                                }
                                
			} 
                        }
			
		}
                $model->setScenario('register');
                $model->name=(isset($body['name'])) ? $body['name']: '';
                $model->email=(isset($body['email'])) ? $body['email']: '';
                $model->password=(!empty($body['password'])) ? md5($body['password']): '';
                $model->status = 1;
                $model->email_alert= 1;
                $model->alert_distance=10;
                $model->alert_days = 7;
                $model->authentication_string=md5($body['email']);
                $model->created_at=date('Y-m-d H:i:s');
                $model->modified_at=date('Y-m-d H:i:s');
                 
                 $validate=CActiveForm::validate($model); 
                 
                 //$model->validate();
		 if($validate && $model->save()){
                        if(isset($body['device_id']) && $body['device_id']!=''){
                            $device = new UserDevices;
                             $device->device_id = $body['device_id'];
                             $device->user_id =  $model->id;
                             $device->status = 1;
                             $device->save();
                        
                           
                         /** Sending Confirmation Email */
                            $email = Yii::app()->email;
                            $applicationname = Yii::app()->name;
                            $email->to = $model->email;
                            $email->from = Yii::app()->params['adminEmail'];
                            $email->fromName = 'WildAlerts- Wildalerts App';
                            $email->subject = $applicationname . ' - Email Verification';
                            $email->view = '_verification';
                            $email->viewVars = array('keystring' =>$model->authentication_string, 'name' => $model->name);
                            $email->send();
	 		    echo CJSON::encode(array('status'=>'1','msg'=>"Your registration has been done successful.We have sent you an email for email verification. Please check your mail. "));
		            Yii::app()->end();
                        }
                        else{
                            
                            
                           echo CJSON::encode(array('status'=>'0','msg'=>"Device id con not be blank"));
                            Yii::app()->end();  
                        }
                        
                        
                    }else{ 
                           
                           $er =json_decode($validate);
                           
                          if($er->User_email[0]=='Email already exists!'){
                              echo CJSON::encode(array('status'=>'0','msg'=>'Email already exists!'));
                              Yii::app()->end(); 
                          }
                          else{
                              echo CJSON::encode(array('status'=>'0','msg'=>$validate));
                              Yii::app()->end(); 
                          }
                            
                          
			
		}

            }else{
               echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                        Yii::app()->end(); 
            }
           
        }
        
        public function actionLogin()
	{
            
		$model=new User;
                $model->setScenario('login');
                
                $body=[];
           
                if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
		
		// collect user input data
		if(isset($body['email']) || isset($body['password']) || isset($body['facebook_id']) )
		{ 
                    $currentLatitude = $body['latitude'];
                    $currentLongitude = $body['longitude'];
                    //$this->performAjaxValidation($model);
                        if(isset($body['facebook_id'])){
                           
                            $model->setScenario('fblogin');
                            $model->facebook_id=(isset($body['facebook_id'])) ? $body['facebook_id']: '';
                            $model->name=(isset($body['name'])) ? $body['name']: '';
                            $model->email=(isset($body['email'])) ? $body['email']: '';
                            //$model->device_id=(isset($body['device_id'])) ? $body['device_id']: '';
                            $valid=$model->validate(); 
                            //&& $model->socailLogin()
                            if($valid && $model->socailLogin()){
                             $device = new UserDevices;
                             $device->device_id = $body['device_id'];
                             $device->user_id =  Yii::app()->user->getId();
                             $device->status = 1;
                             $device->save();
                             $this->currentLocation($user_id , $currentLatitude,$currentLongitude);
                               $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->getId()));
                             //echo "<pre>"; print_r($user); die;
                                echo CJSON::encode(array('status'=>'1','msg'=>'login success !','user'=>$user));
                                // echo CJSON::encode(array('status'=>'1','msg'=>'fb login success !'));
                                 Yii::app()->end();
                            } else{
                                $model->setScenario('fblogin');
                                $error = CActiveForm::validate($model);
                                if($error!='[]'){
                                echo CJSON::encode(array('status'=>'0','msg'=>array($error)));
                                 }else{
                                   echo CJSON::encode(array('status'=>'0','msg'=>"Invalid facebook id")); 
                                }
                                Yii::app()->end();
                                
                            }
                            
                            
                        }
                        else{
                          
			$model->email=(isset($body['email'])) ? $body['email']: '';
                        $model->password=(isset($body['password'])) ? $body['password']: '';
                        $valid=$model->validate(); 
			// validate user input and redirect to the previous page if valid
			if($valid && $model->login()){ 
                           //do anything here
                            
                            $user_id = Yii::app()->user->getId(); 
                            $this->currentLocation($user_id , $currentLatitude,$currentLongitude);
                            
                            $user=User::model()->findByAttributes(array('id'=>Yii::app()->user->getId()));
                             //echo "<pre>"; print_r($user); die;
                            echo CJSON::encode(array('status'=>'1','msg'=>'login success !','user'=>$user));
                            Yii::app()->end();
                        }
                        else{

                            $error = CActiveForm::validate($model);
                            if($error!='[]'){
                            echo CJSON::encode(array('status'=>'0','msg'=>array($error)));

                            }else{
                               echo CJSON::encode(array('status'=>'0','msg'=>"Invalid email")); 
                            }
                            Yii::app()->end();
                        }
                    }
                    
        	}else{
                    echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
                        Yii::app()->end(); 
                }
	          
	}
        
        /**
     * forgot password
     */
        public function actionCheckEmail() {
            $body=[];
           
                if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
            
	  if(isset($body['email']) && $body['email']!=''){
            $email = $body['email'];
            
	    $model = User::model()->find("email = '" . $email . "'");

            if (isset($model) || !empty($model)) {
                
                $getToken=rand(0, 99999);
                $model->token=$getToken;
                $model->save();
                $applicationname = Yii::app()->name;

                    $email = Yii::app()->email;
                    $email->to = $model->email;
                    $email->from = Yii::app()->params['adminEmail'];
                    $email->subject = 'Reset Password';
                    $email->view = '_forgetpassword';
                    $email->viewVars = array('getToken' => $model->token, 'email' => $email);
                    $email->send();
		    echo CJSON::encode(array('status'=>'1','msg'=>'We sent you an email to reset your password. Please check your email.'));
                    Yii::app()->end();
		 } else {
                    
                 echo CJSON::encode(array('status'=>'0','msg'=>'Enter valid email address'));
                        Yii::app()->end();
            }
	  }else{
		echo CJSON::encode(array('status'=>'0','msg'=>'Enter the email address'));
                        Yii::app()->end();
	 }

            
        }
      
    
    public function actionresetPassword(){
        
        $body=[];
           
                if($_POST == null){
                        $rawData  = file_get_contents('php://input');
                        $body = json_decode($rawData,true);

                }
                else{
                   $body = $_POST;
                }
                 //echo "<pre>"; print_r($body); die;
                
         if(isset($body['token']) && $body['token']!='' && isset($body['password']) && $body['password']!=''){
            $model=User::model()->findByAttributes(array('token'=>$body['token']));
            if($model===null){
                
                echo CJSON::encode(array('status'=>'0','msg'=>'you  have been expired token'));
                Yii::app()->end();
            }
            else{
                 if($model->token==$body['token']){
                    
                    $model->password=md5($body['password']);
                    $model->token="";
                    $model->save();
                     echo CJSON::encode(array('status'=>'1','msg'=>'Password has been successfully changed! please login'));
                     Yii::app()->end();
                 }
            }
             
         }else{
             echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
             Yii::app()->end(); 
         }
    
    }
    
    public function actionChangePassword(){
        
        // echo "<pre>"; print_r($_POST); die;
         $body=[];

        if($_POST == null){
                $rawData  = file_get_contents('php://input');
                $body = json_decode($rawData,true);

        }
        else{
           $body = $_POST;
        }
         if(isset($body['newpassword']) && isset($body['user_id'])){
             $user = User::model()->findByPk($body['user_id']);
                    if(!empty($user)){
                        $user->password = md5($body['newpassword']);
                        $user->update();
                        echo CJSON::encode(array('status'=>'1','msg'=>'password update successfully.'));

                        Yii::app()->end();
                    }
                    else{
                        echo CJSON::encode(array('status'=>'0','msg'=>'invalid user.'));

                        Yii::app()->end();
                    }
               
           
         
         }else{
             
             echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
             Yii::app()->end(); 
         }
         
    }
    
    //check old password
    public function actionOldPassword(){
        
        $body=[];

        if($_POST == null){
                $rawData  = file_get_contents('php://input');
                $body = json_decode($rawData,true);

        }
        else{
           $body = $_POST;
        }
        if(isset($body['oldpassword']) && isset($body['user_id'])){
             $user = User::model()->findByPk($body['user_id']);
                if(!empty($user)){
                    if($user->password != md5($body['oldpassword'])){
                     echo CJSON::encode(array('status'=>'0','msg'=>'Old password is incorrect.'));

                     Yii::app()->end(); 
                    }
                    else{
                        echo CJSON::encode(array('status'=>'1','msg'=>'Old password match successfully.'));

                        Yii::app()->end();  
                    }
                }
                else{
                    echo CJSON::encode(array('status'=>'0','msg'=>'invalid user.'));
                 
                    Yii::app()->end();  
                }
        }
        
    }
        
     public function actionAppVerification($code='') {
        if ($code!='') {
            
            $data = User::model()->findByAttributes(array('authentication_string' => $code));
            if(!empty($data)) {
                $data->is_authenticated = 1;
                
                if ($data->update()) {
                   echo CJSON::encode(array('status'=>'1','msg'=>'Account authenticated successfully!'));
                   Yii::app()->end(); 
                }
      
            } else {
                echo CJSON::encode(array('status'=>'0','msg'=>'Invalid HTTP Request'));
                Yii::app()->end(); 
               // throw new CHttpException('404', 'Invalid HTTP Request');
            }
        } else {
            echo CJSON::encode(array('status'=>'0','msg'=>'Invalid Resource Request'));
                Yii::app()->end(); 
            //throw new CHttpException('403', 'Invalid Resource Request');
        }
    }
    
    
    //save current location after login
    public function currentLocation($user_id , $currentLatitude,$currentLongitude){
        //echo $user_id.'latitude '. $currentLatitude.'logitude '.$currentLongitude;
        
        $model= User::model()->findByAttributes(array('id'=>$user_id));
        $model->latitude = $currentLatitude;
        $model->longitude = $currentLongitude;
        $model->update();
        
    }
        
}
