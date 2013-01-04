<?php
/* @var $this ConfessionsController */
/* @var $model Confessions */
$doVote = 'var doVote=function(e,t,n,r){$.ajax({type:"POST",url:"'.Yii::app()->createAbsoluteUrl('/votes/ajax').'",data:{id:t,vote:n,api:"supercereal"},success:function(e){if(e!=="gtfo"){var t=parseInt(r.innerHTML,10);if(t===0){if(n===1){r.innerHTML="1 Hug"}if(n===-1){r.innerHTML="1 Shrug"}}else{t+=1;if(n===1){r.innerHTML=t+" Hugs"}if(n===-1){r.innerHTML=t+" Shrugs"}}}}})};$(".hug-tab, .shrug-tab").click(function(e){e.preventDefault();if(!$(this.parentNode).hasClass("active"))doVote(e,$(this).data("id"),$(this).data("v"),this)})';
Yii::app()->clientScript->registerScript( 'doVote', $doVote, CClientScript::POS_READY );
$this->breadcrumbs=array(
	'Confessions'=>array( 'index' ),
	$model->link,
);

$this->menu=array(
	array( 'label'=>'Confess something', 'url'=>array( 'create' ) ),
	array( 'label'=>'List Confessions', 'url'=>array( 'index' ) ),
);
?>

<div class="view">
	<h5><?php echo  CHtml::encode( $model->link ); ?><br>
		<small> <?php echo CHtml::encode( date( 'M jS, Y', strtotime( $model->date ) ) ); ?></small>
	</h5><br>

<?php
$markdown = $this->beginWidget( 'CMarkdown', array( 'purifyOutput'=>true ) );
$output = $markdown->transform( $model->confession );
$this->endWidget();
echo strip_tags( $output, '<p><strong><em><blockquote>' );

$hugCount = $model->hugCount;
$hugs = ( $hugCount == 1 ? " Hug" : " Hugs" );
$shrugCount = $model->shrugCount;
$shrugs = ( $shrugCount == 1 ? " Shrug" : " Shrugs" );
?>

<dl class="tabs pill right">
	<dd class="hug"><?php echo "<a data-v='1' data-id='".$model->id."' class='hug-tab' href='#'> ". $hugCount . $hugs."</a>";?></dd>
	<dd class="shrug"><?php echo "<a data-v='-1' data-id='".$model->id."' class='shrug-tab' href='#'> ". $shrugCount . $shrugs."</a>";?></dd>
</dl>

</div>
<br><br>
<div id="comments">
	<?php if ( $model->commentCount>=1 ): ?>
		<h6 >
		<?php echo $model->commentCount>1 ? $model->commentCount . ' comments' : '1 comment'; ?>
		</h6>

	<?php $this->renderPartial( '_comments', array(
		'comments'=>$model->comments,
	)); ?>
 <?php endif; ?>

<?php if ( Yii::app()->user->hasFlash( 'commentSubmitted' ) ): ?>
	<div class="alert-box success">
		<?php echo Yii::app()->user->getFlash( 'commentSubmitted' ); ?>
		<a href="" class="close">&times;</a>
	</div>
<?php endif; ?>

<h5>Add a Comment</h5>
<?php
$comment=new Comments;
$this->renderPartial( '/comments/_form', array(
	'model'=>$comment,
	'confessionID'=>$model->id,
	) ); ?>
</div><!-- comments -->

<div>
<?php echo '<form method="get" action="' .Yii::app()->createUrl( 'confessions/index' ) .'">';?>
<input type="text" class="GHSearch" placeholder="Search" name="q" value="<?php echo isset( $_GET['q'] ) ? CHtml::encode( $_GET['q'] ) : '' ; ?>" />
</form>
</div>
