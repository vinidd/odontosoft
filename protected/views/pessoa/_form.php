<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'pessoa-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model, 'nome', array('maxlength' => 120)); ?>
		<?php echo $form->error($model,'nome'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'data_nascimento'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'data_nascimento',
			'value' => $model->data_nascimento,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'data_nascimento'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
		<?php echo $form->checkBox($model, 'sexo'); ?>
		<?php echo $form->error($model,'sexo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cpf'); ?>
		<?php echo $form->textField($model, 'cpf', array('maxlength' => 14)); ?>
		<?php echo $form->error($model,'cpf'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'rg'); ?>
		<?php echo $form->textField($model, 'rg', array('maxlength' => 10)); ?>
		<?php echo $form->error($model,'rg'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 120)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('clientes')); ?></label>
		<?php echo $form->checkBoxList($model, 'clientes', GxHtml::encodeEx(GxHtml::listDataEx(Cliente::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('dentistas')); ?></label>
		<?php echo $form->checkBoxList($model, 'dentistas', GxHtml::encodeEx(GxHtml::listDataEx(Dentista::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('enderecos')); ?></label>
		<?php echo $form->checkBoxList($model, 'enderecos', GxHtml::encodeEx(GxHtml::listDataEx(Endereco::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('recepcionistas')); ?></label>
		<?php echo $form->checkBoxList($model, 'recepcionistas', GxHtml::encodeEx(GxHtml::listDataEx(Recepcionista::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('telefones')); ?></label>
		<?php echo $form->checkBoxList($model, 'telefones', GxHtml::encodeEx(GxHtml::listDataEx(Telefone::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->