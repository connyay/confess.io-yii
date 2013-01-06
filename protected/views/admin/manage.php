<?php
/* @var $this AdminController */
?>

<div class="panel">
	<h5>Unapproved Confessions.</h5>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$confessions,
		'columns'=>array(
			'id',
			'link',
			'confession',
			'status',
			'date',
			array(
				'class'=>'CButtonColumn',
						'template' => '{view} {update}',
						'viewButtonUrl'=>'Yii::app()->createUrl("/confessions/view",array("id"=>$data->link))',
						'updateButtonUrl'=>'Yii::app()->createUrl("/confessions/approve",array("id"=>$data->link,"pass"=>$data->pass))',
				)
		),
	)); ?>
</div>

<div class="panel">
	<h5>Unapproved Comments.</h5>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$comments,
		'columns'=>array(
			'id',
			'text',
			'confession_id',
			'status',
			'date',
			array(
				'class'=>'CButtonColumn',
						'template' => '{view} {update}',
						'viewButtonUrl'=>'Yii::app()->createUrl("/confessions/view",array("id"=>$data->confession->link))',
						'updateButtonUrl'=>'Yii::app()->createUrl("/comments/approve",array("id"=>$data->id,"pass"=>$data->pass))',
				)
		),
	)); ?>
</div>
