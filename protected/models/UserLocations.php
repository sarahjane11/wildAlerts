<?php

/**
 * This is the model class for table "user_locations".
 *
 * The followings are the available columns in table 'user_locations':
 * @property string $id
 * @property string $user_id
 * @property string $location_type
 * @property string $latitude
 * @property string $longitude
 * @property string $created_at
 * @property string $modified_at
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserLocations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserLocations the static model class
	 */
    
        public $user_id;
        public $email_alert;
        public $alert_distance;
        public $alert_days;
        
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_locations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,location_type,description, latitude, longitude, created_at, modified_at, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
                        array('location_type,description,latitude, longitude,,status,modified_at', 'required','on'=>array('setloc')),
			array('user_id', 'length', 'max'=>50),
			array('location_type, latitude, longitude', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, location_type,description, latitude, longitude,alert_notification, created_at, modified_at, status', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'location_type' => 'Location Type',
                        'description' => 'description',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
                        'alert_notification' =>'Alert Notification',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('location_type',$this->location_type,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
                $criteria->compare('alert_notification', $this->alert_notification,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}