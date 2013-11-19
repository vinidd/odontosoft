<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'pagamento-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id_consulta'); ?>
		<?php echo $form->dropDownList($model, 'id_consulta', GxHtml::listDataEx(Consulta::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_consulta'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model, 'valor', array('maxlength' => 7)); ?>
		<?php echo $form->error($model,'valor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_tipo_pagamento'); ?>
		<?php echo $form->dropDownList($model, 'id_tipo_pagamento', GxHtml::listDataEx(TipoPagamento::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_tipo_pagamento'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_status'); ?>
		<?php echo $form->dropDownList($model, 'id_status', GxHtml::listDataEx(Status::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data_criacao'); ?>
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
		<?php echo $form->error($model,'data_criacao'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('parcelas')); ?></label>
		<?php echo $form->checkBoxList($model, 'parcelas', GxHtml::encodeEx(GxHtml::listDataEx(Parcela::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->