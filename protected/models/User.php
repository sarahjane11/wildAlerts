<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $facebook_id
 * @property integer $is_authenticated
 * @property integer $authentication_string
 * @property string $created_at
 * @property string $modified_at
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property UserLocations[] $userLocations
 * @property WildAlertPosts[] $wildAlertPosts
 */
class User extends CActiveRecord
{
    public $email;
    public $oldpassword;
    public $newpassword;
    public $name;
    public $facebook_id;
    private $_identity;
    public $rememberMe=0;
    public $user_id;
    public $location_type;
    public $alert_notifucation;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('email,password', 'required', 'on'=>array('login','register')),
                   
                        array('name', 'required', 'on'=>'register'),
			array('email,name,facebook_id', 'required','on'=>array('fblogin')),
                        array('email','required','on'=>array('checkmail')),
                        array('oldpassword,newpassword','required','on'=>array('changepassword')),
                        array('password','required','on'=>array('resetpassword')),
			array('is_authenticated, status', 'numerical', 'integerOnly'=>true),
                        array('email', 'email','message'=>"Please enter valid email."),
                        array('email', 'unique','message'=>'Email already exists!','on'=>array('register')), 
                        array('latitude,longitude','required','on'=>array('currentlcation')), 
			array('name', 'length', 'max'=>200 ),
			array('email', 'length', 'max'=>50),
			array('password, facebook_id', 'length', 'max'=>100 ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, password, authentication_string,facebook_id, is_authenticated,latitude,longitude, created_at, modified_at, status', 'safe', 'on'=>'search'),
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
			'userLocations' => array(self::HAS_MANY, 'UserLocations', 'user_id'),
			'wildAlertPosts' => array(self::HAS_MANY, 'WildAlertPosts', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'facebook_id' => 'Facebook',
			'is_authenticated' => 'Is Authenticated',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('is_authenticated',$this->is_authenticated);
                $criteria->compare('latitude', $this->latitude,true);
                $criteria->compare('longitude', $this->longitude,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
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
               
                $this->_identity = new UserIdentity($this->email, $this->password);
                if (!$this->_identity->authenticate()) {

                        $this->addError('password', 'Incorrect email or password.');

                }
            }
        }

        /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
        public function login(){

             
            if ($this->_identity === null) {
                $this->_identity = new UserIdentity($this->email, $this->password);
                
                $this->_identity->authenticate();
                
                 if ($this->_identity->errorCode === 3) {
                 
                    $this->addError('password', 'Your account has been deactivated');
                    
                } else if ($this->_identity->errorCode === 4) {

                    $this->addError('password', 'Your account is not verified');

               
                } else if ($this->_identity->errorCode === 6) {
                    
                    $this->addError('password', 'Incorrect email or password.');
                    

                }else {
                   
                    $this->addError('password', 'Incorrect email or password.');

                }
            }
            if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
                $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
                Yii::app()->user->login($this->_identity, $duration);
                return true;
            } else
                return false; //echo $this->_identity->errorCode ; //  return false;
        }
        
        
      //fb login 
        public function socailLogin($facebook_id){
             
            if ($this->_identity === null) {
                
                $this->_identity = new SocialUserIdentity("","",$facebook_id);
                $this->_identity->authenticate();
                 
            }
           
            if ($this->_identity->errorCode === SocialUserIdentity::ERROR_NONE) {
                $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
                Yii::app()->user->login($this->_identity, $duration);
                
                return true;
            } else
              return false;
            
        }

}
