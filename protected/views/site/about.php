<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<h4>What is <?php echo CHtml::encode(Yii::app()->name); ?>?</h4>

<p><?php echo CHtml::encode(Yii::app()->name); ?> is a place where you can post and read 100% anonymous online confessions. No ads, easy to use, and mobile friendly.</p>


<h4>What does <?php echo CHtml::encode(Yii::app()->name); ?> know about me?</h4>

<p><b>If you post / read confessions:</b> absolutely nothing. We don't attach cookies, log your ip address, etc. Truly is 100% anonymous.</p>

<p><b>If you hug / shrug confessions:</b> your ip address. We had to log IP addresses for voting to make sure people aren't voting many times on the same post.</p>

<h4>Who made <?php echo CHtml::encode(Yii::app()->name); ?>?</h4>

<p>A computer science student that you can find here <a href="http://twitter.com/_connyay" target="_blank">@_connyay</a>.</p>


<h4>I would love to see the source for <?php echo CHtml::encode(Yii::app()->name); ?><h4>

<p>It is your lucky day, fellow nerd! The full source is available <a href="https://github.com/connyay/confess.io-yii" target="_blank">on github!</a>

<h4>I have an idea / suggestion / problem with <?php echo CHtml::encode(Yii::app()->name); ?><h4>

<p>I would love to hear it! I am always available <a href="http://twitter.com/_connyay" target="_blank">@_connyay</a> or <a href="https://github.com/connyay/confess.io-yii/issues" target="_blank">github issue page</a>.</p>

</div>


<h4>I'm sick of reading this page!</h4>
Woah, sorry! <b><?php echo CHtml::link( "View the confessions", array( 'confessions/index' ) ); ?><br></b>
<hr>

 <?php echo '<form method="get" action="' .Yii::app()->createUrl('confessions/index') .'">';?>
<input type="text" class="GHSearch" placeholder="Search Confessions" name="q" value="<?=isset($_GET['q']) ? CHtml::encode($_GET['q']) : '' ; ?>" />
</form>
