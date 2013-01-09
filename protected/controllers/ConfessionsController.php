<?php

class ConfessionsController extends ERestController
{
	/**
	 *
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 *
	 *
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
			array( 'allow',
				'actions'=>array( 'restList', 'restView', 'restCreate', 'index', 'view', 'create', 'write', 'approve' ),
				'users'=>array( '*' ),
			),
			array( 'allow',
				'actions'=>array( 'admin', 'delete', 'update' ),
				'users'=>array( 'admin' ),
			),
			array( 'deny',
				'users'=>array( '*' ),
			),
		);
	}

	/**
	 * Displays one confession by short link
	 *
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView( $id ) {

		$model = $this->loadShort( $id );

		if ( isset( $_POST['Comments'] ) ) {
			$comment=new Comments;
			$comment->attributes=$_POST['Comments'];
			if ( $model->addComment( $comment ) ) {
				Yii::app()->user->setFlash( 'commentSubmitted', 'Thank you for your comment. Your comment will be posted once it is approved.' );
				$this->refresh();
			}
		}

		$this->render( 'view', array(
				'model'=>$model,
			) );
	}

	/**
	 * Creates a new confession.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model=new Confessions;

		if ( isset( $_POST['Confessions'] ) ) {
			$model->attributes=$_POST['Confessions'];
			if ( $model->save() )
				$this->redirect( array( 'view', 'id'=>$model->link ) );
		}

		$this->render( 'create', array(
				'model'=>$model,
			) );
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id the ID of the model to be updated
	 */
	/* Hiding Update Action... for now.
	public function actionUpdate( $id ) {
		$model=$this->loadModel( $id );

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if ( isset( $_POST['Confessions'] ) ) {
			$model->attributes=$_POST['Confessions'];
			if ( $model->save() )
				$this->redirect( array( 'view', 'id'=>$model->id ) );
		}

		$this->render( 'update', array(
				'model'=>$model,
			) );
	}
	*/
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id the ID of the model to be deleted
	 */
	/* Hiding Delete Action... for now.
	public function actionDelete( $id ) {
		$this->loadModel( $id )->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if ( !isset( $_GET['ajax'] ) )
			$this->redirect( isset( $_POST['returnUrl'] ) ? $_POST['returnUrl'] : array( 'admin' ) );
	}
	*/
	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$search = false;
		$criteria = new CDbCriteria();
		if ( isset( $_GET['q'] ) ) {
			$q = $_GET['q'];
			$criteria->compare( 'confession', $q, true, 'OR' );
			$criteria->addCondition( 'status=1' );
			$search = true;
		} else {
			$criteria=array(
				'condition' => 'status=1',
				'order'=>'id desc' );
		}

		$dataProvider=new CActiveDataProvider( 'Confessions',
			array( 'criteria'=>$criteria,
				'pagination'=>array( 'pageSize'=>'10', 'pageVar'=>'page' ) ) );
		$this->render( 'index', array(
				'dataProvider'=>$dataProvider,
				'search'=>$search,
			) );
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new Confessions( 'search' );
		$model->unsetAttributes();  // clear any default values
		if ( isset( $_GET['Confessions'] ) )
			$model->attributes=$_GET['Confessions'];

		$this->render( 'admin', array(
				'model'=>$model,
			) );
	}

	public function actionApprove( $id, $pass ) {

		$model = $this->loadShort( $id );

		if ( $model != null && $model->pass == $pass ) {
			$model->status = 1;
			$model->save();
			$this->redirect( array( 'view', 'id'=>$model->link ) );
		}
		else {
			throw new CHttpException( 500, "Approval failed."  );
		}

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel( $id ) {
		$model=Confessions::model()->findByPk( $id );
		if ( $model===null )
			throw new CHttpException( 404, 'The requested page does not exist.' );
		return $model;
	}
	/**
	 * Returns the data model based on the short link given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param string  the short link of the model to be loaded
	 */
	public function loadShort( $short ) {
		$model=Confessions::model()->findByAttributes( array( 'link'=>$short ) );
		if ( $model===null )
			throw new CHttpException( 404, 'The requested page does not exist.' );
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param CModel  the model to be validated
	 */
	protected function performAjaxValidation( $model ) {
		if ( isset( $_POST['ajax'] ) && $_POST['ajax']==='confessions-form' ) {
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}
	}
	/**
	 * Restfulyii Api Methods.
	 */
	public function doRestList() {
		$criteria = new CDbCriteria();
		$criteria=array(
			'condition' => 'status=1',
			'order'=>'id desc',
			'select'=>'id, link, confession, date, status',
			'limit'=>20 );

		$this->outputHelper(
			'Records Retrieved Successfully',
			$this->getModel()->with( array( 'votes'=>array( 'select'=>'vote' ), 'comments'=>array( 'select'=>'text, date, status', 'condition'=>'comments.status=1' ) ) )->limit( $this->restLimit )->offset( $this->restOffset )->findAll( $criteria ),
			$this->getModel()->count( $criteria )
		);
	}

	public function doRestView( $id ) {
		$criteria = new CDbCriteria();
		$criteria=array( 'select'=>'id, link, confession, date, status' );
		$this->outputHelper(
			'Record Retrieved Successfully',
			$this->getModel()->with( array( 'votes'=>array( 'select'=>'vote' ), 'comments'=>array( 'select'=>'text, date, status' ) ) )->findByPk( $id, $criteria ),
			1
		);
	}

	/**
   * Provides the ability to Limit and offset results
   * http://example.local/api/sample/limit/1/2
   * The above example would limit results to 1
   * and offest them by 2
   */

	public function doCustomRestGetLimit($var) {
		 $limit = 15;
	  	 $offset = 0;
		$criteria = new CDbCriteria();
		$criteria=array(
			'condition' => 'status=1',
			'order'=>'id desc',
			'select'=>'id, link, confession, date, status' );

		if(is_array($var)){
	  	  $limit = $var[0];
	  	  $offset = $var[1];
		}
		else {
	  	  $limit = $var;
		}

		$this->outputHelper(
			'Records Retrieved Successfully',
			$this->getModel()->with( array( 'votes'=>array( 'select'=>'vote' ), 'comments'=>array( 'select'=>'text, date, status', 'condition'=>'comments.status=1' ) ) )->limit( $limit )->offset( $offset )->findAll( $criteria ),
			$this->getModel()->count( $criteria )
		);
	}


}
