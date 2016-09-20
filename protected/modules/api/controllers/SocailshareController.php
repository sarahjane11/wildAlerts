<?php

class SocailshareController extends Controller
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
        
        //socail share template
    public function actionWildalertpost($id){
        
        $sql ="SELECT user.name as username, user.id as userid,animals.name,threat_levels.level,threat_levels.color,wild_alert_posts.* 
                FROM wild_alert_posts
                LEFT JOIN user ON user.id = wild_alert_posts.user_id
                LEFT JOIN animals ON animals.id = wild_alert_posts.animal_id
                LEFT JOIN threat_levels ON threat_levels.id = animals.threat_level_id
                   WHERE wild_alert_posts.id = $id
                ";
        
        $postNotification = Yii::app()->db->createCommand($sql)->queryAll();
        $applicationname = Yii::app()->name;
         
         echo CJSON::encode(array('status'=>'1','title'=>'WildAlerts- Wildalerts App' , 'subject'=>$applicationname . ' - post share - Your friend has shared a post with you.  Click on below link to see the post on web.' ,'msg'=>$postNotification));
         Yii::app()->end();
         
    }
    
    public function actionShareAlertsWithFriends(){
         
       // echo "<pre>"; print_r($_POST); die;
        
         /** Sending Confirmation Email */
        $body=[];

        if($_POST == null){
                $rawData  = file_get_contents('php://input');
                $body = json_decode($rawData,true);

        }
        else{
           $body = $_POST;
        }
        
        if(isset($body['emails']) && isset($body['id'])){
        $emails = explode(',', $body['emails']);
        $postid = $body['id'];
        foreach($emails as $key => $value){
            
            $email = Yii::app()->email;
            $applicationname = Yii::app()->name;
            $email->to = $value;
            $email->from = Yii::app()->params['adminEmail'];
            $email->fromName = 'WildAlerts- Wildalerts App';
            $email->subject = $applicationname . ' - post share';
            $email->view = '_sharepost';
            $email->viewVars = array('postid' => $postid);
            $email->send();
        }
        echo CJSON::encode(array('status'=>'1','msg'=>"Send successfully"));
         Yii::app()->end();
        }else{
            echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
            Yii::app()->end();  
        }


    } 
    
//    public function actionSharePost(){
//        
//         $body=[];
//
//        if($_GET == null){
//                $rawData  = file_get_contents('php://input');
//                $body = json_decode($rawData,true);
//
//        }
//        else{
//           $body = $_GET;
//        }
//        
//         if (isset($body['code']) && !empty($body['code'])) {
//             
//             $id = $body['code'];
//            $sql ="SELECT user.name as username, user.id as userid,animals.name,threat_levels.level,threat_levels.color,wild_alert_posts.* 
//                FROM wild_alert_posts
//                LEFT JOIN user ON user.id = wild_alert_posts.user_id
//                LEFT JOIN animals ON animals.id = wild_alert_posts.animal_id
//                LEFT JOIN threat_levels ON threat_levels.id = animals.threat_level_id
//                   WHERE wild_alert_posts.id = $id
//                ";
//        
//        $postNotification = Yii::app()->db->createCommand($sql)->queryAll();
//        
//         
//         echo CJSON::encode(array('status'=>'1','msg'=>$postNotification));
//         Yii::app()->end();
//
//        }  
//
//   }
   
   public function actionShareLink(){
      
       $body=[];

        if($_POST == null){
                $rawData  = file_get_contents('php://input');
                $body = json_decode($rawData,true);

        }
        else{
           $body = $_POST;
        }
        
        if(isset($body['user_id']) && isset($body['id'])){
            
            $postid = base64_decode($body['id']);
            $applicationname = Yii::app()->name;
            $sharelink = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl.'/site/wildalertpost?id='.$postid ; 
         
            echo CJSON::encode(array('status'=>'1','title'=>'wildAlerts App' , 'subject'=> 'wildAlerts animal post share ' ,'msg'=>'Click on the link to view post : ','sharelink'=>$sharelink));
            Yii::app()->end();
            
            
        }else{
            echo CJSON::encode(array('status'=>'0','msg'=>'post can not be blank'));
            Yii::app()->end();
        }
       
   }
        
        
}