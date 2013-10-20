
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

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'inverse',
        'label' => 'Salvar',
        'htmlOptions' => array('id' => 'procedimento-button')
    ));
    ?>
</div>

<?php $this->endWidget('procedimento-form'); ?>
