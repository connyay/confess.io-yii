<ol>
<?php foreach ( $comments as $comment ): ?>
<?php if ( $comment->status>=1 ): ?>
<h5><small><em> <?php echo CHtml::encode( date( 'M jS, Y', strtotime( $comment->date ) ) );   ?></em></small></h5>
<li>
	<div class="content">
		<?php
		$markdown = $this->beginWidget('CMarkdown', array('purifyOutput'=>true));
		$output = $markdown->transform($comment->text);
		$this->endWidget();
		echo strip_tags($output, '<p><strong><em><blockquote>');
		?>
	</div>
</li>
<hr>
<?php endif; ?>
<?php endforeach; ?>
</ol>
