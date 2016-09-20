<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity {

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
    const ERROR_STATUS_INACTIVE=3;
    const ERROR_NOT_AUTHENTICATED=4;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        
    }
   
    public function authenticate() {
       
        $user = AdminLogin::model()->find('username = "' . $this->username . '"');
         
        
        if (!isset($user->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
             return !$this->errorCode;
        } else if ($user->password != md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
             return !$this->errorCode;
        } else if(($user->status) != 1){
		 $this->errorCode = self::ERROR_STATUS_INACTIVE;
                return !$this->errorCode;

		}else if (($user->is_authenticated) != 1) {
	            
	                $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
	                return !$this->errorCode;
	           
	        } else{
                        $this->_id=$user->id;
			$this->username=$user->username;
	                $this->errorCode = self::ERROR_NONE;
	                return !$this->errorCode;
	            }
	        
	    }
            
    /**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
           
		return $this->_id;
	}

}
