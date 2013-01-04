<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>	<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>	<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="Make and read anonymous confessions">
		<meta name="keywords" content="group hug, online confession, online confessions, grouphug">
		<title>Grouphug.io &raquo; Anonymous Online Confessions</title>
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/foundation.min.css">
		<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" />
		<link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/touch-icon-iphone.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/touch-icon-ipad.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/touch-icon-iphone-retina.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/touch-icon-ipad-retina.png" />
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	</head>
	<body>

		<nav class="top-bar">
			<ul>
				<li class="name">
					<h1>
						<a href="#"><?php echo CHtml::encode( Yii::app()->name ); ?></a>
					</h1>
				</li>
				<li class="toggle-topbar">
					<a href="#"></a>
				</li>

			</ul>

			<section>

				<?php $this->widget( 'foundation.widgets.FounNavBar', array(
					'items'=>array(
					  array( 'label'=>'Home', 'url'=>array( 'site/index' ) ),
					  array( 'label'=>'Confessions', 'hasDropdown'=>true, 'url'=>array( '' ), 'submenu' => array(
						  array( 'label'=>'View', 'url'=>array( '/confessions' ) ),
						  array( 'label'=>'Write', 'url'=>array( '/confessions/create' ) ),
						),
					  ),

					),
				  ) ); ?>
			</section>
		</nav>
		<div class="row">
			<div class="nine columns">
				<?php if ( isset( $this->breadcrumbs ) ):?><?php $this->widget( 'foundation.widgets.FounBreadcrumbs', array(
					  'links'=>$this->breadcrumbs,
					) ); ?>
				<?php endif?><?php echo $content; ?>
				<div class="clear"></div>
			</div>
			<footer class="row">
				<div class="twelve columns">
					<hr>
					<div class="row">
						<div class="seven columns right">
							<p>
								<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://grouphug.io/confessions" data-text="Check out this site" data-via="GroupHugIO">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script><br>
								grouphug.io — made with love by: <a href="http://twitter.com/_connyay" target="_blank">@_connyay</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/foundation.min.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36788545-1']);
	_gaq.push(['_trackPageview']);
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = 'http://www.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
	</body>
</html>