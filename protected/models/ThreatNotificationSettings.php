<?php

/**
 * This is the model class for table "threat_notification_settings".
 *
 * The followings are the available columns in table 'threat_notification_settings':
 * @property integer $id
 * @property integer $user_id
 * @property integer $threat_id
 * @property integer $distance
 * @property integer $status
 * @property string $created_at
 * @property string $modified_at
 */
class ThreatNotificationSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ThreatNotificationSettings the static model class
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
		return 'threat_notification_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, threat_id, distance, status, created_at, modified_at', 'required'),
			array('user_id, threat_id, distance, status', 'numerical', 'integerOnly'=>true),
                       array('distance, status, modified_at', 'required','on'=>array('setloc')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, threat_id, distance, status, created_at, modified_at', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'threat_id' => 'Threat',
			'distance' => 'Distance',
			'status' => 'Status',
			'created_at' => 'Created At',
			'modified_at' => 'Modified At',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('threat_id',$this->threat_id);
		$criteria->compare('distance',$this->distance);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('modified_at',$this->modified_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}