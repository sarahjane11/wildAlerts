<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class SocialUserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    private $_id;
    //public $role;
    public $email;
    public $name;
    public $facebook_id;
    const ERROR_STATUS_INACTIVE=3;
    const ERROR_NOT_AUTHENTICATED=4;
    const ERROR_FACEBOOKID_INVALID=5;
    
    public function __construct($username,$name,$facebook_id) {
        $this->name = $username;
        $this->email = $name;
        $this->facebook_id = $facebook_id;
        
    }

    
    public function authenticate() {
       
        
        $users = User::model()->findByAttributes(array('facebook_id' => $this->facebook_id));
         
        if(!empty($users)){
//        if(!isset($users['email']) && $users['email']!=$this->email){
//            
//			 $this->errorCode=self::ERROR_USERNAME_INVALID;
//                }elseif($users->facebook_id !== $this->facebook_id){
//			$this->errorCode=self::ERROR_FACEBOOKID_INVALID;
//                }else if(($users->status) != 1){
//                         $this->errorCode = self::ERROR_STATUS_INACTIVE;
//                    $this->errorCode;
//
//                }else if (($users->is_authenticated) != 1) {
//                        $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
//                       // return !$this->errorCode;
//
//                }
//		else
			$this->_id=$users->id;
			$this->username=$users->name;
	                $this->errorCode = self::ERROR_NONE;
	                return !$this->errorCode;
        }else{
            
            return self::ERROR_FACEBOOKID_INVALID;
           
        }
	        
	 }

}
