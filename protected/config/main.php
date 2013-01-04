<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname( __FILE__ ).DIRECTORY_SEPARATOR.'..',
	'name'=>'confess.io',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'foundation',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'ext.restfullyii.components.*',
	),

	'modules'=>array(

		'user'=>array(
			'hash' => 'sha1',
			'sendActivationMail' => false,
			'loginNotActiv' => true,
			'activeAfterRegister' => true,
			'autoLogin' => true,
			'registrationUrl' => array( '/user/registration' ),
			'recoveryUrl' => array( '/user/recovery' ),
			'loginUrl' => array( '/user/login' ),
			'returnUrl' => array( '/tasks' ),
			'returnLogoutUrl' => array( '/user/login' ),
		),

	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'loginUrl'=>array( 'user/login' ),
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),
		'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType'=>'smtp',
			'transportOptions'=>array(
				'host'=>'smtp.gmail.com',
				'username'=>'hello_github@fakemail.com', // change
				'password'=>'HELLO_GITHUB', // change
				'port'=>'465',
				'encryption'=>'ssl',
			),
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false
		),
		'foundation' => array(
			'class' => 'ext.foundation.components.Foundation'
		),
		'clientScript' => array(
			'coreScriptPosition' => CClientScript::POS_END,
			'scriptMap' => array(
				'jquery.js' => false,
				'jquery.min.js' => false,
			)
		),

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>require(dirname(__FILE__).'/../extensions/restfullyii/config/routes.php'),
		),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yii_grouphug',
			'class'=>'CDbConnection',
			'emulatePrepare' => true,
			'username' => 'ze_db_admin', // change
			'password' => 'HELLO_GITHUB', // change
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		'ai'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=information_schema',
			'class'=>'CDbConnection',
			'emulatePrepare' => true,
			'username' => 'ze_db_admin', // change
			'password' => 'HELLO_GITHUB', // change
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	'params'=>array(
		'adminEmail'=>'hello_github@fakemail.com', // change
	),
);
