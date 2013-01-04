<?php

/**
 * This is the model class for table "{{confessions}}".
 *
 * The followings are the available columns in table '{{confessions}}':
 *
 * @property integer $id
 * @property string $link
 * @property string $confession
 * @property string $date
 * @property integer $status
 * @property string $pass
 *
 * The followings are the available model relations:
 * @property Votes[] $votes
 * @property Comments[] $comments
 */
class Confessions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string  $className active record class name.
	 * @return Confessions the static model class
	 */
	public static function model( $className=__CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 *
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{confessions}}';
	}

	/**
	 *
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array( 'confession', 'required' ),
			array( 'link', 'length', 'max'=>5 ),
			array( 'date', 'safe' ),
			array( 'status', 'numerical', 'integerOnly'=>true ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'id, link, confession, date', 'safe', 'on'=>'search' ),
		);
	}

	/**
	 *
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			// Vote relation and stats
			'votes' => array( self::HAS_MANY, 'Votes', 'confession_id' ),
			'hugCount' => array( self::STAT, 'Votes', 'confession_id', 'condition'=>'vote=1' ),
			'shrugCount' => array( self::STAT, 'Votes', 'confession_id', 'condition'=>'vote=-1' ),
			// Comment relation and stats
			'comments' => array( self::HAS_MANY, 'Comments', 'confession_id', 'condition'=>'comments.status=1' ),
			'commentCount' => array( self::STAT, 'Comments', 'confession_id', 'condition'=>'status=1' ),
		);
	}

	/**
	 *
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'link' => 'Link',
			'confession' => 'Confession',
			'date' => 'Date',
			'status' => 'Status',
		);
	}

	/**
	 * Adds a new comment to this confession.
	 *
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment( $comment ) {
		$pass = sha1( $this->link . uniqid() );
		$pass = substr( $pass, 0, 6 );

		$comment->confession_id=$this->id;
		$comment->pass=$pass;
		// email generated in comment afterSave
		return $comment->save( false );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare( 'id', $this->id );
		$criteria->compare( 'link', $this->link, true );
		$criteria->compare( 'confession', $this->confession, true );
		$criteria->compare( 'date', $this->date, true );

		return new CActiveDataProvider( $this, array(
				'criteria'=>$criteria,
			) );
	}

	public function beforeSave() {
		parent::beforeSave();
		if ( $this->status != 1 ) {
			// I chose this method of getting the next ID vs getting the ID after save
			// because the update after insert was slow as shit.
			$nextID = Yii::app()->ai->createCommand()
			->select( 'auto_increment' )
			->from( 'tables' )
			->where( 'table_name=:table_name AND table_schema=:table_schema', array( ':table_name'=>'tbl_confessions', ':table_schema'=>'yii_grouphug' ) )
			->queryRow();
			$nextID = $nextID['auto_increment'];
			$hash = PseudoCrypt::udihash( $nextID );
			//echo $nextID . " / " . $hash; die();
			// quick and dirty hash to approve comments
			$pass = sha1( $hash . uniqid() );
			$pass = substr( $pass, 0, 6 );
			$this->link = $hash;
			$this->pass = $pass;
		}
	return true;
	}
	public function afterSave() {
		parent::afterSave();
		// TODO: Remove hard coded URI
		$body = "Here is the new post: " . $this->confession
			. "<br><br>http://grouphug.io/confessions/approve/id/".$this->link."/pass/".$this->pass;

		Yii::import( 'ext.yii-mail.YiiMailMessage' );
		$message = new YiiMailMessage;
		$message->setBody( $body, 'text/html' );
		$message->subject = 'New Post // ' . $this->link;
		$message->addTo( 'grouphug.io@gmail.com' );
		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send( $message );
	}
}
// http://blog.kevburnsjr.com/php-unique-hash
class PseudoCrypt {

	private static $golden_primes = array(
		1, 41, 2377, 147299, 9132313, 566201239, 35104476161, 2176477521929
	);
	private static $chars = array(
		0=>48, 1=>49, 2=>50, 3=>51, 4=>52, 5=>53, 6=>54, 7=>55, 8=>56, 9=>57, 10=>65,
		11=>66, 12=>67, 13=>68, 14=>69, 15=>70, 16=>71, 17=>72, 18=>73, 19=>74, 20=>75,
		21=>76, 22=>77, 23=>78, 24=>79, 25=>80, 26=>81, 27=>82, 28=>83, 29=>84, 30=>85,
		31=>86, 32=>87, 33=>88, 34=>89, 35=>90, 36=>97, 37=>98, 38=>99, 39=>100, 40=>101,
		41=>102, 42=>103, 43=>104, 44=>105, 45=>106, 46=>107, 47=>108, 48=>109, 49=>110,
		50=>111, 51=>112, 52=>113, 53=>114, 54=>115, 55=>116, 56=>117, 57=>118, 58=>119,
		59=>120, 60=>121, 61=>122
	);
	public static function base62( $int ) {
		$key = "";
		while ( $int > 0 ) {
			$mod = $int-( floor( $int/62 )*62 );
			$key .= chr( self::$chars[$mod] );
			$int = floor( $int/62 );
		}
		return strrev( $key );
	}
	public static function udihash( $num, $len = 5 ) {
		$ceil = pow( 62, $len );
		$prime = self::$golden_primes[$len];
		$dec = ( $num * $prime )-floor( $num * $prime/$ceil )*$ceil;
		$hash = self::base62( $dec );
		return str_pad( $hash, $len, "0", STR_PAD_LEFT );
	}
}
