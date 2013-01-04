<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>This site is a place where you can post and read 100% anonymous online confessions. No ads, easy to use, and mobile friendly.</p>

<p>If you have any suggestions let me know on twitter
	<a href="http://twitter.com/_connyay" target="_blank">@_connyay</a> </p>

</div>

<h6><?php echo CHtml::link( "View the confessions &raquo;", array( 'confessions/index' ) ); ?><br></h6>
<hr>

 <?php echo '<form method="get" action="' .Yii::app()->createUrl('confessions/index') .'">';?>
<input type="text" class="GHSearch" placeholder="Search Confessions" name="q" value="<?=isset($_GET['q']) ? CHtml::encode($_GET['q']) : '' ; ?>" />
</form>
