<?php
/* @var $this ConfessionsController */
/* @var $data Confessions */
?>

<div class="view">
	<h5>
		<?php echo CHtml::link( CHtml::encode( $data->link ), array( 'view', 'id'=>$data->link ) ); ?><br>
		<small><?php echo CHtml::encode( date( 'M jS, Y', strtotime( $data->date ) ) );   ?></small>
	</h5><br>
	<?php
	$hugCount = $data->hugCount;
	$hugs = ($hugCount == 1 ? " Hug" : " Hugs");
	$shrugCount = $data->shrugCount;
	$shrugs = ($shrugCount == 1 ? " Shrug" : " Shrugs");


	$markdown = $this->beginWidget( 'CMarkdown', array( 'purifyOutput'=>true ) );
	$output = $markdown->transform( $data->confession );
	$this->endWidget();
	echo strip_tags( $output, '<p><strong><em><blockquote>' );
	?>
	<dl class="tabs pill right">
		<dd class="hug">
			<?php echo "<a data-v='1' data-id='".$data->id."' class='hug-tab' href='#'>". $hugCount . $hugs."</a>";?>
		</dd>
		<dd class="shrug">
			<?php echo "<a data-v='-1' data-id='".$data->id."' class='shrug-tab' href='#'>". $shrugCount . $shrugs."</a>";?>
		</dd>
	</dl>
</div>
<br>
<?php echo CHtml::link( CHtml::encode( $data->commentCount==1 ? '1 comment' : $data->commentCount . ' comments' ), array( 'view', 'id'=>$data->link ) ); ?>
