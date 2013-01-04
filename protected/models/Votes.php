<?php

/**
 * This is the model class for table "{{votes}}".
 *
 * The followings are the available columns in table '{{votes}}':
 * @property integer $id
 * @property integer $confession_id
 * @property integer $user_ip
 * @property integer $vote
 *
 * The followings are the available model relations:
 * @property Confessions $confession
 */
class Votes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Votes the static model class
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
		return '{{votes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('confession_id', 'required'),
			array('confession_id, user_ip, vote', 'numerical', 'integerOnly'=>true),
			array('id, confession_id, vote', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'confession' => array(self::BELONGS_TO, 'Confessions', 'confession_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'confession_id' => 'Confession',
			'user_ip' => 'User Ip',
			'vote' => 'Vote',
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
		$criteria->compare('confession_id',$this->confession_id);
		$criteria->compare('user_ip',$this->user_ip);
		$criteria->compare('vote',$this->vote);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}