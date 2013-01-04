<?php
/* @var $this ConfessionsController */
/* @var $model Confessions */
/* @var $form CActiveForm */

$launchModal = '$("#confessionBox").focus();var showDialog=function(e){e.preventDefault();$("#createModal").reveal();$("#confirm").focus()};$("#confessionBox").keyup(function(e){if($("#confessionBox").val()==""){$("#submitBtn").attr("disabled","disabled")}else{$("#submitBtn").removeAttr("disabled")}});$("#confirm").click(function(e){$("#submitBtn").attr("disabled","disabled");$("#confirm").attr("disabled","disabled");$("#confessions-form").unbind("submit").submit()});$("#formatting").click(function(e){e.preventDefault();$("#formatModal").reveal()});$("#confessions-form").submit(function(e){showDialog(e)})';

Yii::app()->clientScript->registerScript( 'launchModal', $launchModal, CClientScript::POS_READY );
?>

<div class="form">
	<?php $form=$this->beginWidget( 'CActiveForm', array(
		'id'=>'confessions-form',
		'enableAjaxValidation'=>false,
	) ); ?>
	<div class="row">
		<?php echo $form->textArea( $model, 'confession', array( 'rows'=>6, 'cols'=>50, 'id'=>'confessionBox', 'placeholder'=>'What is on your mind?' ) ); ?>
	</div>
	<div class="row buttons">
		<dl class="sub-nav right">
			<dd>
				<a href="#" id="formatting" tabindex="-1">Formatting</a>
			</dd>
		</dl><?php echo CHtml::submitButton( $model->isNewRecord ? 'Confess' : 'Save', array( "class"=>"button", 'disabled'=>'disabled', 'id'=>'submitBtn' ) ); ?>
	</div><?php $this->endWidget(); ?>
</div><!-- form -->

<div id="createModal" class="reveal-modal">
	<h3>Last Step</h3>

	<p>Once the confession is submitted there is no going back...</p>

	<a class="button" id="confirm" href="#">Confirm</a> <a class="close-reveal-modal">×</a>
</div>

<div id="formatModal" class="reveal-modal">
	<h3>Formatting:</h3>

	<p>**Hello world** will come out like <strong>Hello world</strong></p>
	<p>*Hello world* will come out like <em>Hello world</em></p>
	<p>&gt;Hello world will come out like <blockquote>Hello world</blockquote></p>

	<a class="close-reveal-modal">×</a>
</div>
