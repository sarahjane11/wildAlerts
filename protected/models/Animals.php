<?php

/**
 * This is the model class for table "animals".
 *
 * The followings are the available columns in table 'animals':
 * @property string $id
 * @property string $name
 * @property string $threat_level_id
 * @property string $category_id
 * @property string $created_at
 * @property string $modified_at
 * @property integer $status
 * @property string $image_name
 *
 * The followings are the available model relations:
 * @property Categories $category
 * @property ThreatLevels $threatLevel
 * @property WildAlertPosts[] $wildAlertPosts
 */
class Animals extends CActiveRecord
{
    
        protected $class; 
        public $image ;
        //public    $category_id;
        //public    $threat_level_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Animals the static model class
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
		return 'animals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, threat_level_id, category_id, created_at, modified_at, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
                        array('image', 'file', 'types'=>'jpg, gif, png', 'safe' => false),
       
			array('threat_level_id, category_id', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, threat_level_id, category_id, created_at, modified_at, status', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Categories', 'category_id'),
			'threatLevel' => array(self::BELONGS_TO, 'ThreatLevels', 'threat_level_id'),
			'wildAlertPosts' => array(self::HAS_MANY, 'WildAlertPosts', 'animal_id'),
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
			'threat_level_id' => 'Threat Level',
			'category_id' => 'Category',
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
                $criteria->with = array('category','threatLevel');
		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		
                if(isset($_REQUEST['Animals']['threat_level_id']) && !empty($_REQUEST['Animals']['threat_level_id'])){
                    $criteria->compare('threatLevel.level',$_REQUEST['Animals']['threat_level_id'],true);
                }
                if(isset($_REQUEST['Animals']['category_id']) && !empty($_REQUEST['Animals']['category_id'])){
                    $criteria->compare('category.category',$_REQUEST['Animals']['category_id'],true);
                }
		//$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);
		$criteria->compare('status',$this->status);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                       
                 ));
	}
        
}