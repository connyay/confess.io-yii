<?php
/* @var $this ConfessionsController */
/* @var $model Confessions */

$this->breadcrumbs=array(
	'Confessions'=>array( 'index' ),
	'New',
);
$this->menu=array(
	array('label'=>'List Confessions', 'url'=>array('index')),
);
?>

<h2>New Confession</h2>

<h6>Rules:</h6>
<ul>
	<li>If you are thinking about suicide please <a href="http://www.metanoia.org/suicide/" target="_blank">read this.</a></li>
	<li>Don't use any full names.</li>
	<li>Please be patient while waiting for your post to show (posts are moderated to prevent spam).</li>
</ul>

<?php echo $this->renderPartial( '_form', array( 'model'=>$model ) ); ?>
