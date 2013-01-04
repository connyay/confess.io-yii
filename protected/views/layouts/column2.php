<?php /* @var $this Controller */ ?>
<?php $this->beginContent( '//layouts/main' ); ?>
		<?php echo $content; ?>
</div>

<div class="three columns">
	<?php if ($this->menu ) : ?>
	<h5>Menu</h5>
	<?php
	$this->widget( 'zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array( 'class'=>'side-nav' ),
		) );
?>
	<?php endif ?>

</div>

<?php $this->endContent(); ?>
