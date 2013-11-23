
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'procedimento-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'focus' => array($model, 'procedimento'),
        ));
?>
<br>

<?php echo $form->textFieldRow($model, 'procedimento'); ?>
<?php echo $form->textFieldRow($model, 'valor', array('prepend' => 'R$', 'class' => 'money', 'style' => 'width: 80px; text-align: right;'));
?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'inverse',
        'label' => Yii::t('app', 'Salvar'),
        'htmlOptions' => array('id' => 'procedimento-button')
    ));
    ?>
</div>

<?php $this->endWidget('procedimento-form'); ?>
