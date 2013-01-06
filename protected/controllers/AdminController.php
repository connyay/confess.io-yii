<?php

class AdminController extends Controller
{
	public $defaultAction = 'manage';
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules() {
		return array(
			array( 'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array( 'manage' ),
				'users'=>array( 'admin' ),
			),
			array( 'deny',  // deny all users
				'users'=>array( '*' ),
			),
		);
	}
	public function actionManage() {
		$criteria = new CDbCriteria();

		$criteria=array(
			'condition' => 'status=0',
			'order'=>'id desc' );


		$confessions=new CActiveDataProvider( 'Confessions',
			array( 'criteria'=>$criteria,
			) );
		$comments=new CActiveDataProvider( 'Comments',
			array( 'criteria'=>$criteria,
			) );
		$this->render( 'manage', array(
				'confessions'=>$confessions,
				'comments'=>$comments
			) );
	}

}
