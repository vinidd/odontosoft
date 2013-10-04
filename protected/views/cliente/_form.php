<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'cliente-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
        ));
?>

<fieldset>
    <legend>Dados Pessoais</legend>

    <?php echo $form->textFieldRow($model_pessoa, 'nome'); ?>
    <?php echo $form->maskedTextFieldRow($model_pessoa, 'data_nascimento', '99/99/9999'); ?>
    <?php
    echo $form->radioButtonListInlineRow($model_pessoa, 'sexo', array(
        'Masculino',
        'Feminino',
    ));
    ?>
    <?php echo $form->maskedTextFieldRow($model_pessoa, 'cpf', '999.999.999-99'); ?>
    <?php echo $form->textFieldRow($model_pessoa, 'rg', array('class' => 'rg')); ?>
    <?php echo $form->textFieldRow($model_pessoa, 'email'); ?>
</fieldset>

<fieldset>
    <legend>Usuário <small>(opcional)</small></legend>
    
    <?php echo $form->textFieldRow($model_usuario, 'username'); ?>
    <?php echo $form->passwordFieldRow($model_usuario, 'password'); ?>
    <?php echo $form->passwordFieldRow($model_usuario, 'password_confirm'); ?>
</fieldset>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'success',
        'label' => 'Salvar'
    ));
    ?>
</div>

<?php $this->endWidget('cliente-form'); ?>