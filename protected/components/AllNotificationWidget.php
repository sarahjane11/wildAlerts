<?php
class AllNotificationWidget extends CWidget
{
    //public $login_id;
     

    public function run() {
        
                $user_id = Yii::app()->user->getId();
        
                       $sql = "" ;
                   $notification_seeting = ThreatNotificationSettings::model()->findAllByAttributes(array('user_id'=>$user_id));
                    
                   $user_locations = UserLocations::model()->findAllByAttributes(array('user_id'=>$user_id,'status'=>'1'));
                   
                   if(!empty($notification_seeting) &&  !empty($user_locations)){
                    
                        $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username,u.alert_days
                                from wild_alert_posts wap,user_locations ul , threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and tn.user_id = ul.user_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$user_id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                and ul.alert_notification =1
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else if(!empty($notification_seeting)){
                      
                        $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and u.id = '$user_id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                group by wap.id
                                order by wap.id DESC";
                  }else if(!empty($user_locations)){
                     
                       $sql="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,user_locations ul, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$user_id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and  (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <=20
                                group by wap.id
                                and ul.alert_notification =1
                                order by wap.id DESC,ul.location_type";
                  }else{
                     
                         $sql="select wap.id,  wap.user_id, wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from  wild_alert_posts wap, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id and u.id = wap.user_id
                                and a.threat_level_id=tl.id
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=0)
                                and (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <= 20
                                group by wap.id
                                order by wap.id DESC";
                          
                  }
                   
                   
                   
                   $allnotification = Yii::app()->db->createCommand($sql)->queryAll();
                    
                   $getallNotification=[];
                   foreach ($allnotification as  $key => $value) {
                       //$fileContent=  file_get_contents($value['image_path']."/".$value['image_name']);
                        $getallNotification[]=array(
                            'id'        =>  $value['id'],
                            'user_id'   =>  $value['user_id'] ,
                            'animal_id' =>  $value['animal_id'] ,
                            'title'     =>  $value['title'],
                            'notes'     =>  $value['notes'],
                            'latitude'  =>  $value['latitude'],
                            'longitude' =>  $value['longitude'],
                            'created_at'=>  $value['created_at'],
                            'modified_at'=> $value['modified_at'],
                            'status'     => $value['status'],
                            'animalname' => $value['animalname'],
                            'animalimage' => '',//base64_encode($fileContent),
                            'threat_level_id' =>$value['threat_level_id'],
                            'level'         => $value['level'],
                            'color'         => $value['color'],
                            'username'      => $value['username'],
                        );
                       
                       
                   }
                     
                   $notification_seetingcount = ThreatNotificationSettings::model()->findAllByAttributes(array('user_id'=>$user_id));
                   $sql1='';
                   if(!empty($notification_seeting) &&  !empty($user_locations)){
                     
                        $sql1="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username,u.alert_days
                                from wild_alert_posts wap,user_locations ul , threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and tn.user_id = ul.user_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$user_id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=1)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                and ul.alert_notification =1
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else if(!empty($notification_seeting)){
                       
                        $sql1="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,threat_notification_settings tn, animals a,threat_levels tl,user u
                                where tn.threat_id = a.threat_level_id
                                and a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and u.id = '$user_id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status= 1)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and tn.distance >= (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) 
                                group by wap.id
                                order by wap.id DESC";
                  }else if(!empty($user_locations)){
                     
                       $sql1="select wap.id,  wap.user_id,  wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from wild_alert_posts wap,user_locations ul, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id
                                and a.threat_level_id=tl.id
                                and ul.user_id = '$user_id'
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status=1)
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and  (((acos(sin((ul.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((ul.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((ul.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <=20
                                and ul.alert_notification =1
                                group by wap.id
                                order by wap.id DESC,ul.location_type";
                  }else{
                     
                         $sql1="select wap.id,  wap.user_id, wap.animal_id,  wap.title,  wap.notes,  wap.latitude,  wap.longitude,  wap.created_at,  wap.modified_at,  wap.image_name,  wap.image_path,  wap.status,a.name as animalname,a.threat_level_id,tl.level,tl.color,u.name as username
                                from  wild_alert_posts wap, animals a,threat_levels tl,user u
                                where a.id = wap.animal_id and u.id = wap.user_id
                                and a.threat_level_id=tl.id
                                and wap.created_at  >= DATE_SUB(CURDATE(), INTERVAL u.alert_days DAY) 
                                and wap.id NOT IN (select alert_post_id from notification_status where user_id='$user_id' and status = 1)
                                and (((acos(sin((u.latitude*pi()/180)) * sin((wap.latitude*pi()/180))+cos((u.latitude*pi()/180)) * cos((wap.latitude*pi()/180)) * cos(((u.longitude- wap.longitude)*pi()/180))))*180/pi())*60*1.1515) <= 20
                                group by wap.id
                                order by wap.id DESC";
                          
                  }
                   
                   
                   
                   $countallnotification = Yii::app()->db->createCommand($sql1)->queryAll();
                     //echo "<pre>"; print_r($countallnotification); die;
                   
                   
                    $alertcount = count($countallnotification);

        $this->render('AllNotificationWidget', [
            'getallNotification'=>$getallNotification,'alertcount' => $alertcount
           
        ]);
    }
}
