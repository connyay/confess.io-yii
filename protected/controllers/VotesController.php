<?php

class VotesController extends ERestController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function _filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function _accessRules() {
		return array(
			array( 'allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array( 'ajax' ),
				'users'=>array( '*' ),
			),
		);
	}


	public function actionAjax( ) {
		$api; $id; $vote;
		//print_r($_POST);
		//die();
		// Half baked security

		if ( !isset( $_POST['id'] ) || !isset( $_POST['vote'] ) || !isset( $_POST['api'] ) ) {
			return false;
		} else {
			$id = $_POST['id'];
			$api = $_POST['api'];
			$vote = $_POST['vote'];
		}

		if(isset($_SERVER['HTTP_X_FORWARDED_VARNISH'])) {
			$ip = $_SERVER["HTTP_X_FORWARDED_VARNISH"];
		} else {
		$ip = Yii::app()->request->userHostAddress;
		}


		$ip = ip2long( $ip );
		$model=Votes::model()->findByAttributes( array( 'user_ip'=>$ip, 'confession_id'=>$id ) );
		if ( $model===null ) {
			echo "New vote";
			$model=new Votes;
		} else {
			if ( $model->vote == $vote ) {
				echo "gtfo";
			} else {
				echo "Changed vote";
				$model->vote = $vote;
				$model->save();
				return true;
			}
		}

		$model->user_ip = $ip;
		$model->confession_id = $id;
		$model->vote = $vote;
		$model->save( false );

	}

}
