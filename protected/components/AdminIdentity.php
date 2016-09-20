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

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        
    }

    public function authenticate() {
         
        $user = AdminLogin::model()->find('username = "' . $this->username . '"');
        
        if (!isset($user->username)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password != md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else if(($user->status) != 1){
		 $this->errorCode = self::ERROR_NONE;
                return !$this->errorCode;

		}else if (($user->is_authenticated) != 1) {
	            
	                $this->errorCode = self::ERROR_NONE;
	                return !$this->errorCode;
	           
	        } else{
	            
	                $this->errorCode = self::ERROR_NONE;
	                return !$this->errorCode;
	            }
	        
	    }

}
