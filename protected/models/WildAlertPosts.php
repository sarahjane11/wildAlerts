<?php

/**
 * This is the model class for table "wild_alert_posts".
 *
 * The followings are the available columns in table 'wild_alert_posts':
 * @property string $id
 * @property string $user_id
 * @property string $animal_id
 * @property string $title
 * @property string $notes
 * @property string $latitude
 * @property string $longitude
 * @property string $created_at
 * @property string $modified_at
 * @property string $image_name
 * @property string $image_path
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Animals $animal
 * @property User $user
 */
class WildAlertPosts extends CActiveRecord
{
    public $tid;
    public $animalname;
    public $animaltlid;
    public $animalcid;
    public $tl;
    public $animalcategory;
    public $uname;
    public $tlcolor;
    public $email_alert;
    public $alert_distance;
    public $alert_days;
    


    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WildAlertPosts the static model class
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
		return 'wild_alert_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, animal_id, title, latitude, longitude, modified_at, image_name, image_path, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('user_id, animal_id', 'length', 'max'=>50),
			array('title, notes', 'length', 'max'=>255),
			array('latitude, longitude, image_name, image_path', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, animal_id, title, notes, latitude, longitude, created_at, modified_at, image_name, image_path, status', 'safe', 'on'=>'search'),
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
			'animal' => array(self::BELONGS_TO, 'Animals', 'animal_id'),
                        'animal1' => array(self::BELONGS_TO, 'Animals', 'animal_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
                        'userlocations' => array(self::HAS_MANY, 'UserLocations', 'user_id'),
                        'threat'=>array(self::HAS_MANY,'ThreatLevels',array('threat_level_id'=>'id'),'through'=>'animal'),
                        'categories'=>array(self::HAS_MANY,'Categories',array('category_id'=>'id'),'through'=>'animal1'), 
//                        
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
			'animal_id' => 'Animal',
			'title' => 'Title',
			'notes' => 'Notes',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
			'image_name' => 'Image Name',
			'image_path' => 'Image Path',
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
		$criteria->compare('animal_id',$this->animal_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_path',$this->image_path,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}