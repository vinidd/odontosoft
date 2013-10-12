<script>
    $(document).ready(function() {
        checkTelefone();
    });
</script>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'cliente-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
        ));
?>
<br>
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

<?php if (isset($model_usuario)) { ?>
    <fieldset>
        <legend>Usuário <small>(opcional)</small></legend>

        <?php echo $form->textFieldRow($model_usuario, 'username'); ?>
        <?php echo $form->passwordFieldRow($model_usuario, 'password'); ?>
        <?php echo $form->passwordFieldRow($model_usuario, 'password_confirm'); ?>
    </fieldset>
<?php } ?>

<?php
if (isset($model_telefones)) {
    foreach ($model_telefones as $model_telefone) {
        if ($model_telefone->tipo == 0) {
            $tel_res = $model_telefone->numero;
        } else if ($model_telefone->tipo == 1) {
            $tel_cel = $model_telefone->numero;
        } else if ($model_telefone->tipo == 2) {
            $tel_com = $model_telefone->numero;
        }
    }
}
?>

<fieldset>
    <legend>Contato <small id="Telefone_em">(preencha pelo menos um telefone)</small></legend>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_residencial">Telefone Residencial</label>
        <div class="controls">
            <input class="telefone" id="Telefone_residencial" type="text" name="Telefone[residencial]"
                   <?php echo isset($tel_res) ? ' value="' . $tel_res . '"' : ''; ?>>
        </div>
    </div>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_celular">Telefone Celular</label>
        <div class="controls">
            <input class="telefone" id="Telefone_celular" type="text" name="Telefone[celular]"
                   <?php echo isset($tel_cel) ? ' value="' . $tel_cel . '"' : ''; ?>>
        </div>
    </div>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_comercial">Telefone Comercial</label>
        <div class="controls">
            <input class="telefone" id="Telefone_comercial" type="text" name="Telefone[comercial]"
                   <?php echo isset($tel_com) ? ' value="' . $tel_com . '"' : ''; ?>>
        </div>
    </div>

</fieldset>

<fieldset>
    <legend>Endereço</legend>

    <?php echo $form->textFieldRow($model_endereco, 'nome', array('hint' => 'Exemplo: Minha casa')); ?>
    <?php
    echo $form->radioButtonListInlineRow($model_endereco, 'tipo', array(
        'Casa',
        'Apartamento',
        'Comercial'
    ));
    ?>
    <?php echo $form->maskedTextFieldRow($model_endereco, 'cep', '99999-999'); ?>
    <?php echo $form->textFieldRow($model_endereco, 'rua'); ?>
    <?php echo $form->textFieldRow($model_endereco, 'numero'); ?>
    <?php echo $form->textFieldRow($model_endereco, 'complemento'); ?>
    <?php
    echo $form->textAreaRow($model_endereco, 'descricao', array(
        'style' => 'width: 412px'
    ));
    ?>
    <?php echo $form->textFieldRow($model_endereco, 'bairro'); ?>
    <?php echo CHtml::hiddenField('Endereco[id_cidade]', '', array('id' => 'Endereco_id_cidade')); ?>

    <div class="control-group">
        <label class="control-label cidade_label" for="id_cidade">Cidade <span class='required'>*</span></label>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'id_cidade',
                'value' => $model_endereco->id_cidade,
                'source' => Yii::app()->createUrl('/pessoa/cidadeAutoComplete'),
                'options' => array(
                    'minLength' => '3',
                    'select' => 'js:function(event, ui) { $("#Endereco_id_cidade").val(ui.item.id); }'
                ),
                'htmlOptions' => array(
                    'id' => 'id_cidade',
                ),
            ));
            ?>
            <span id="id_cidade_em_" class="help-inline error" style="display:none">Cidade não pode ser vazio.</span>
        </div>
    </div>

</fieldset>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'inverse',
        'label' => 'Salvar',
        'htmlOptions' => array('id' => 'cliente-button')
    ));
    ?>
</div>

<?php $this->endWidget('cliente-form'); ?>