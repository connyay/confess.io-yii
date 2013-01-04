<?php
/* @var $this ConfessionsController */
/* @var $dataProvider CActiveDataProvider */
$doVote = 'var doVote=function(e,t,n,r){$.ajax({type:"POST",url:"'.Yii::app()->createAbsoluteUrl('/votes/ajax').'",data:{id:t,vote:n,api:"supercereal"},success:function(e){if(e!=="gtfo"){var t=parseInt(r.innerHTML,10);if(t===0){if(n===1){r.innerHTML="1 Hug"}if(n===-1){r.innerHTML="1 Shrug"}}else{t+=1;if(n===1){r.innerHTML=t+" Hugs"}if(n===-1){r.innerHTML=t+" Shrugs"}}}}})};$(".hug-tab, .shrug-tab").click(function(e){e.preventDefault();if(!$(this.parentNode).hasClass("active"))doVote(e,$(this).data("id"),$(this).data("v"),this)})';
Yii::app()->clientScript->registerScript( 'doVote', $doVote, CClientScript::POS_READY );
if ( $search ) {
	$this->breadcrumbs=array(
		'Confessions'=>array( 'index' ),
		'Search',
	);
} else {
	$this->breadcrumbs=array(
		'Confessions',
	);
}

$this->menu=array(
	array( 'label'=>'Confess something', 'url'=>array( 'create' ) ),
);
?>

<h1>Confessions</h1>
<h6 class="show-for-small"><?php echo CHtml::link( "Confess something &raquo;", array( 'create' ) ); ?><br></h6>

<?php $this->widget( 'zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'separator' => '<hr/>',
		'pagerCssClass'=>'hide',
	) );
?>
<br><br><br>
<div class="right">
	<?php
	$pager = new CPagination( $dataProvider->getTotalItemCount() );
	$this->widget( "foundation.widgets.FounPager", array(
			"pages" => $pager,
		) );
	?>
</div>
<hr>

<?php echo '<form method="get" action="' .Yii::app()->createUrl( 'confessions/index' ) .'">';?>
<input type="text" class="GHSearch" placeholder="Search" name="q" value="<?php echo isset( $_GET['q'] ) ? CHtml::encode( $_GET['q'] ) : '' ; ?>" />
</form>
