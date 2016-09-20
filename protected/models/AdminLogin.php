<?php

/**
 * This is the model class for table "admin_login".
 *
 * The followings are the available columns in table 'admin_login':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property integer $is_authenticated
 * @property integer $status
 */
class AdminLogin extends CActiveRecord
{

	public $username;
        public $password;
        private $_identity;
        public $rememberMe=0;
        public $oldpassword;
        public $newpassword;

	

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminLogin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('is_authenticated, status', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, is_authenticated, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'is_authenticated' => 'Is Authenticated',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_authenticated',$this->is_authenticated);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new AdminIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate()) {
               
                    $this->addError('password', 'Incorrect username or password.');
              
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {

           
        if ($this->_identity === null) {
            
            $this->_identity = new AdminIdentity($this->username, $this->password);
            $this->_identity->authenticate();
            
             if ($this->_identity->errorCode === 3) {
                 
                    $this->addError('username', 'Your account is not verified');
                    
            } else if ($this->_identity->errorCode === 4) {
                
                $this->addError('username', 'Your account deactivated');
                
            }  else {
                
                $this->addError('password', 'Incorrect username or password.');
                
            }
        }
        if ($this->_identity->errorCode === AdminIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false; //echo $this->_identity->errorCode; 
    }


}
