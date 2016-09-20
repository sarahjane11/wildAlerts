<?php

class SiteController extends Controller
{
    
    
    public $layout='//layouts/frontend/frontend';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{   
            $model=new User;
            //$model->setScenario('login');
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new User;
                
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']))
		{
                    
                     if(isset($_POST['User']['facebook_id'])){
                         $fbidlogin = User::model()->findByAttributes(array('facebook_id'=>$_POST['User']['facebook_id']));
                            if(!empty($fbidlogin)){
                             if($model->socailLogin($fbidlogin->facebook_id)){

                                  $this->redirect(Yii::app()->createUrl('user/profile'));

                              }
                            }
                            
                         
                     }else{
                         
                        $model->setScenario('login'); 
			$model->attributes=$_POST['User'];
                        
                        // validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            $this->redirect(Yii::app()->createUrl('user/profile')); 
                                
                        }
                                                
                     }
		}
		// display the login form
		$this->render('index',array('model'=>$model));
                
	}
        
     

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionSignup(){
          $model=new User;
          $model->setScenario('register'); 
            if(isset($_POST['User']))
            {  
                if(isset($_POST['ajax']) && $_POST['ajax']==='register-popup-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                
                 if(isset($_POST['User']['facebook_id'])){
                     
                      $model->setScenario('fblogin');
                            if(isset($_POST['User']['email']) && $_POST['User']['facebook_id']){
                                
                                $user= User::model()->findByAttributes(array('email'=>$_POST['User']['email']));
                                if(!empty($user)){
                                $user->facebook_id= $_POST['User']['facebook_id'];
                                  if($user->update() && $model->socailLogin($user->facebook_id)){

                                      $this->redirect(Yii::app()->createUrl('user/profile'));

                                  }
                                }
                                $fbidlogin = User::model()->findByAttributes(array('facebook_id'=>$_POST['User']['facebook_id']));
                                
                                 
                                
                                if(!empty($fbidlogin)){
                                     
                                 if($model->socailLogin($fbidlogin->facebook_id)){
                                     
                                     
                                      $this->redirect(Yii::app()->createUrl('user/profile'));

                                  }
                                }else{
                                    $model->email=(isset($_POST['User']['email'])) ? $_POST['User']['email']: '';
                                    $model->name=(isset($_POST['User']['name'])) ? $_POST['User']['name']: '';
                                    $model->facebook_id=(isset($_POST['User']['facebook_id'])) ? $_POST['User']['facebook_id']: '';
                                    $model->status = 1;
                                    $model->is_authenticated = 1;
                                    $model->email_alert= 1;
                                    $model->alert_distance=10;
                                    $model->alert_days = 7;
                                    $model->created_at=date('Y-m-d H:i:s');
                                    $model->modified_at=date('Y-m-d H:i:s');

                                    $validate=CActiveForm::validate($model);

                                     if($validate && $model->save() && $model->socailLogin()){
                                         
                                         $this->redirect(Yii::app()->createUrl('user/profile'));
                                     }
                                    
                                     
                                }
                                
                            }else{
                                    $model->email=(isset($_POST['User']['email'])) ? $_POST['User']['email']: '';
                                    $model->name=(isset($_POST['User']['name'])) ? $_POST['User']['name']: '';
                                    $model->facebook_id=(isset($_POST['User']['facebook_id'])) ? $_POST['User']['facebook_id']: '';
                                    $model->status = 1;
                                    $model->is_authenticated = 1;
                                    $model->email_alert= 1;
                                    $model->alert_distance=10;
                                    $model->alert_days = 7;
                                    $model->created_at=date('Y-m-d H:i:s');
                                    $model->modified_at=date('Y-m-d H:i:s');

                                    $validate=CActiveForm::validate($model);

                                     if($validate && $model->save() && $model->socailLogin()){
                                         
                                         $this->redirect(Yii::app()->createUrl('user/profile'));
                                     }
                                }
                     
                 }else{
                     
                    $model->attributes=$_POST['User'];
                    $valid=$model->validate(); 
                    $model->password=md5(trim($_POST['User']['password']));
                    $model->authentication_string=md5($_POST['User']['email']);
                    $model->status = 1;
                    $model->email_alert= 1;
                    $model->alert_distance=10;
                    $model->alert_days = 7;
                    $model->created_at=date('Y-m-d H:i:s');
                    $model->modified_at=date('Y-m-d H:i:s');
                 
                    if($valid && $model->save()){
                        
                           // Yii::app()->user->setFlash('successRegister', $model->email);
                            
                            /** Sending Confirmation Email */
                            $email = Yii::app()->email;
                            $applicationname = Yii::app()->name;
                            $email->to = $model->email;
                            $email->from = Yii::app()->params['adminEmail'];
                            $email->fromName = 'WildAlerts- Wildalerts App';
                            $email->subject = $applicationname . ' - Email Verification';
                            $email->view = '_verificationweb';
                            $email->viewVars = array('keystring' => $model->authentication_string, 'name' => $model->name);
                            $email->send();

                            Yii::app()->user->setFlash('successRegister', Yii::t('app','Your registration has been done successfully.We  sent you an email for email verification. Please check your mail.  !'));
                            $this->redirect(array('index'));
                            Yii::app()->end();
                        
                        
                        //$this->redirect(array('index'));
                    }
                     
                 }
                 

            }
            $this->render('signup',array('model'=>$model));
        }
        
        
        /**
     * RegisterController::actionVerification()
     *
     * @return
     */
    public function actionVerification(){
        
        if (isset($_GET['code']) && !empty($_GET['code'])) {
              
            $data = User::model()->findByAttributes(array('authentication_string' => $_GET['code']));
            if(!empty($data)) {
                $data->is_authenticated = 1;
               
                if ($data->update()) {
                    
                    Yii::app()->user->setFlash('success_verification', Yii::t('app','Email Verified Successfully  !'));
                    
                    $this->redirect(Yii::app()->createUrl('site/index'));
                }
                
                
            } else {
                throw new CHttpException('404', 'Invalid HTTP Request');
            }
        } else {
            throw new CHttpException('403', 'Invalid Resource Request');
        }
    }
    
    //forgot password view
    public function actionForgotpassword(){
        $model=new User;
        $this->render('forgotpassword',array('model'=>$model));
    }
    
    /**
     * forgot password
     */
    public function actionCheckEmail() {
         
        $email = $_POST['User']['email'];
       
        $model = User::model()->find("email = '" . $email . "'");
        
//        if(isset($_POST['ajax']) && $_POST['ajax']==='check-email-form')
//        {   
//            
//                echo CActiveForm::validate($model);
//                Yii::app()->end();
//        }
        
        if (isset($model) || !empty($model)) {
           
            $getToken=rand(0, 99999);
            $model->token=$getToken;
            
            
            $model->save();
            $applicationname = Yii::app()->name;

                $email = Yii::app()->email;
                $email->to = $model->email;
                $email->from = Yii::app()->params['adminEmail'];
                $email->subject = 'Reset Password';
                $email->view = '_forgetpasswordweb';
                $email->viewVars = array('getToken' => $model->token, 'email' => $email);
                if ($email->send()) {
                    
                    Yii::app()->user->setFlash('emailFound', Yii::t('app', 'We sent you an email to reset your password. Please check your email.'));
                    
                    //$this->redirect(Yii::app()->createUrl('/'));
                    $this->redirect(array('index'));

                }
                $this->redirect(Yii::app()->createUrl('/'));
               
        } else {
            Yii::app()->user->setFlash('emailError', Yii::t('app', 'The email you have entered is not registered. Please enter your email again.'));
             //$this->redirect(Yii::app()->createUrl('/'));
            $this->redirect(array('index'));
            
        }
    }
    
    public function getToken($token)
    {
       
        $model=User::model()->findByAttributes(array('token'=>$token));
      
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    
    public function actionResetPassword($token=null){
        
       
        $model=User::model()->findByAttributes(array('token'=>$token));
      
        if(!empty($model)){
            if(isset($_POST['User']))
            {
                
                if($model->token==$_POST['User']['token']){
                    $model->password=md5(trim($_POST['User']['password']));
                    $model->token="null";
                    $model->update();
                    Yii::app()->user->setFlash('emailFound','Password has been successfully changed! please login');
                     $this->redirect(Yii::app()->createUrl('site/index'));
                    Yii::app()->end();
                }
            }
            
        }else{
            Yii::app()->user->setFlash('emailFound','your token has been expired');
            $this->redirect(Yii::app()->createUrl('site/index'));
                    Yii::app()->end();
        }
            
           
            $this->render('resetpassword',array(
               'model'=>$model,'token'=>$token
           ));
       
    }
    
    public function actionOpenapp($link=''){
        if($link!=''){
            @header("Location:" . base64_decode($link));
        }
        exit;
    }
    
    //socail share template
    public function actionWildalertpost($id){
        $this->layout='//layouts/sharepost/sharepost';
       // private $layout='//layouts/sharepost/sharepost';
        $id = base64_decode($id);
        $sql ="SELECT user.name as username, user.id as userid,animals.name,threat_levels.level,threat_levels.color,wild_alert_posts.* 
                FROM wild_alert_posts
                LEFT JOIN user ON user.id = wild_alert_posts.user_id
                LEFT JOIN animals ON animals.id = wild_alert_posts.animal_id
                LEFT JOIN threat_levels ON threat_levels.id = animals.threat_level_id
                   WHERE wild_alert_posts.id = '$id' 
                ";
        
        $postNotification = Yii::app()->db->createCommand($sql)->queryAll();
        
         //echo "<pre>"; print_r($postNotification); die;
        
        $this->render('wildalertpost',array(
               'postNotification'=>$postNotification,
        ));
        
        
    }
    
    
    public function actionShareAlertsWithFriends(){
         
        //echo "<pre>"; print_r($_POST); die;
        
         /** Sending Confirmation Email */
         echo "<pre>"; print_r(Yii::app()->user); die;// Yii::app()->user;die;
        $emails = explode(',', $_POST['emails']);
        
        $sharelink = $_POST['pageUrl'];
        foreach($emails as $key => $value){
            
            $email = Yii::app()->email;
            $applicationname = Yii::app()->name;
            $email->to = $value;
            $email->from = Yii::app()->user->email;//Yii::app()->params['adminEmail'];
            $email->fromName = 'WildAlerts- Wildalerts App';
            $email->subject = $applicationname . ' - post share';
            $email->view = '_sharepostweb';
            $email->viewVars = array('sharelink' => $sharelink);
            $email->send();
        }
        


    } 
    
    
    

}
