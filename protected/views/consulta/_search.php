<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id_consulta'); ?>
		<?php echo $form->textField($model, 'id_consulta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_cliente'); ?>
		<?php echo $form->dropDownList($model, 'id_cliente', GxHtml::listDataEx(Cliente::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_dentista'); ?>
		<?php echo $form->dropDownList($model, 'id_dentista', GxHtml::listDataEx(Dentista::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'data'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'data',
			'value' => $model->data,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'horario'); ?>
		<?php echo $form->textField($model, 'horario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'duracao'); ?>
		<?php echo $form->textField($model, 'duracao', array('maxlength' => 2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_status'); ?>
		<?php echo $form->dropDownList($model, 'id_status', GxHtml::listDataEx(Status::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'data_criacao'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'data_criacao',
			'value' => $model->data_criacao,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
