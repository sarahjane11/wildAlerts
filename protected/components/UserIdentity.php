<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    
       private $_id;
       public $email;


       const ERROR_STATUS_INACTIVE=3;
	const ERROR_NOT_AUTHENTICATED=4;
        const ERROR_EMAIL_INVALID=6;
	
	public function authenticate()
	{
              
              $users=  User::model()->findByAttributes(array("email"=> $this->username));
              
              
               
              //if(!empty($users)){
		if(!isset($users['email']) && $users['email']!=$this->username){
			 $this->errorCode=self::ERROR_EMAIL_INVALID;
                          return !$this->errorCode;
                }elseif($users->password!==md5($this->password)){
			 $this->errorCode=self::ERROR_PASSWORD_INVALID;
                          return !$this->errorCode;
                }else if(($users->status) != 1){
                          $this->errorCode = self::ERROR_STATUS_INACTIVE;
                        return !$this->errorCode;

                }else if (($users->is_authenticated) != 1) {
                      $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
                        return !$this->errorCode;

                }
		else{
			$this->_id=$users->id;
			$this->setState('email', $users->email);
                        $this->username=$users->name;
	                $this->errorCode = self::ERROR_NONE;
	                return !$this->errorCode;
                }
//              }else{
//                  
//                  return self::ERROR_USERNAME_INVALID;
//              }
                
                
	}
        
        /**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
           
		return $this->_id;
	}
        
}