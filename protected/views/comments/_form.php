<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */

$validate = '$("#comments-form").submit(function(){$("#submitBtn").attr("disabled","disabled")});$("#commentBox").keyup(function(e){if($("#commentBox").val()==""){$("#submitBtn").attr("disabled","disabled")}else{$("#submitBtn").removeAttr("disabled")}});';

Yii::app()->clientScript->registerScript( 'validate', $validate, CClientScript::POS_READY );
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php echo $form->textArea($model,'text',array('rows'=>5, 'cols'=>50,'maxlength'=>500, 'id'=>'commentBox', 'placeholder'=>'Enter your nice comment here, please.')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array( "class"=>"small button", 'disabled'=>'disabled', 'id'=>'submitBtn' )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->