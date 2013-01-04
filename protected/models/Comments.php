<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property integer $id
 * @property integer $confession_id
 * @property string $text
 * @property string $date
 * @property integer $status
 * @property string $pass
 *
 * The followings are the available model relations:
 * @property Confessions $confession
 */
class Comments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return '{{comments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('confession_id, text', 'required'),
			array('confession_id, status', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>500),
			array('pass', 'length', 'max'=>6),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, confession_id, text, date, status', 'safe', 'on'=>'search'),
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
			'text' => 'Text',
			'date' => 'Date',
			'status' => 'Status',
			'pass' => 'Pass',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('pass',$this->pass,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function afterSave() {
		parent::afterSave();
		if ( $this->status != 1 ) {
			$this->isNewRecord = false;
		$body = "<p>Here is the new comment: " . $this->text
			. "</p><p>". Yii::app()->createAbsoluteUrl('/comments/approve',array('id'=>$this->id, 'pass'=>$this->pass)) ."</p>";

			Yii::import( 'ext.yii-mail.YiiMailMessage' );
			$message = new YiiMailMessage;
			$message->setBody( $body, 'text/html' );
			$message->subject = 'New Comment';
			$message->addTo( Yii::app()->params['adminEmail'] );
			$message->from = Yii::app()->params['adminEmail'];
			Yii::app()->mail->send( $message );
		}

	}
}