<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'dentista-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'focus' => array($model_pessoa, 'nome'),
        ));
?>
<br>
<fieldset>
    <legend><?php echo Yii::t('app', 'Dados Pessoais'); ?></legend>

    <?php echo $form->textFieldRow($model_pessoa, 'nome'); ?>
    <?php echo $form->maskedTextFieldRow($model_pessoa, 'data_nascimento', '99/99/9999'); ?>
    <?php
    echo $form->radioButtonListInlineRow($model_pessoa, 'sexo', array(
        Yii::t('app', 'Masculino'),
        Yii::t('app', 'Feminino'),
    ));
    ?>
    <?php echo $form->maskedTextFieldRow($model_pessoa, 'cpf', '999.999.999-99'); ?>
    <?php echo $form->textFieldRow($model_pessoa, 'rg', array('class' => 'rg')); ?>
    <?php echo $form->textFieldRow($model_pessoa, 'email'); ?>
    <?php echo $form->textFieldRow($model, 'cro'); ?>
</fieldset>

<?php if (isset($model_usuario)) { ?>
    <fieldset>
        <legend><?php echo Yii::t('app', 'User'); ?> <small>(<?php echo Yii::t('app', 'opcional'); ?>)</small></legend>

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
    <legend><?php echo Yii::t('app', 'Contato'); ?><small id="Telefone_em"> (<?php echo Yii::t('app', 'preencha pelo menos um telefone'); ?>)</small></legend>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_residencial"><?php echo Yii::t('app', 'Telefone Residencial'); ?></label>
        <div class="controls">
            <input class="telefone" id="Telefone_residencial" type="text" name="Telefone[residencial]"
                   <?php echo isset($tel_res) ? ' value="' . $tel_res . '"' : ''; ?>>
        </div>
    </div>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_celular"><?php echo Yii::t('app', 'Telefone Celular'); ?></label>
        <div class="controls">
            <input class="telefone" id="Telefone_celular" type="text" name="Telefone[celular]"
                   <?php echo isset($tel_cel) ? ' value="' . $tel_cel . '"' : ''; ?>>
        </div>
    </div>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_comercial"><?php echo Yii::t('app', 'Telefone Comercial'); ?></label>
        <div class="controls">
            <input class="telefone" id="Telefone_comercial" type="text" name="Telefone[comercial]"
                   <?php echo isset($tel_com) ? ' value="' . $tel_com . '"' : ''; ?>>
        </div>
    </div>

</fieldset>

<fieldset>
    <legend><?php echo Yii::t('app', 'Endereço'); ?></legend>

    <?php echo $form->textFieldRow($model_endereco, 'nome', array('hint' => Yii::t('app', 'Exemplo: Minha casa'))); ?>
    <?php
    echo $form->radioButtonListInlineRow($model_endereco, 'tipo', array(
        Yii::t('app', 'Casa'),
        Yii::t('app', 'Apartamento'),
        Yii::t('app', 'Comercial')
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
    <?php echo CHtml::hiddenField('Endereco[id_cidade]', isset($model_endereco->id_cidade) ? $model_endereco->id_cidade : '', array('id' => 'Endereco_id_cidade')); ?>

    <div class="control-group">
        <label class="control-label cidade_label" for="id_cidade"><?php echo Yii::t('app', 'Cidade'); ?> <span class='required'>*</span></label>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'id_cidade',
                'value' => isset($model_endereco->id_cidade) ? $model_endereco->getCidade() : '',
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
            <span id="id_cidade_em_" class="help-inline error" style="display:none"><?php echo Yii::t('app', 'Cidade não pode ser vazio.'); ?></span>
        </div>
    </div>

</fieldset>

<fieldset>
    <legend><?php echo Yii::t('app', 'Procedimentos'); ?></legend>
    <br>
    <?php echo CHtml::hiddenField('delete', Yii::t('app', 'Delete')); ?>
    <?php echo CHtml::hiddenField('unique_msg', Yii::t('app', 'Você já adicionou o procedimento escolhido!')); ?>
    
    <div class="control-group">
        <label class="control-label cidade_label" for="id_cidade"><?php echo Yii::t('app', 'Procedimentos'); ?></label>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'procedimentos',
                'value' => '',
                'source' => Yii::app()->createUrl('/procedimento/getProcedimento'),
                'options' => array(
                    'select' => 'js:function(event, ui) {
                        addProcedimento(ui.item.id, ui.item.label);
                    }'
                ),
                'htmlOptions' => array(
                    'id' => 'procedimentos',
                ),
            ));
            ?>
        </div>
    </div>

    <div class="procedimentos-content">
        <table>
            <thead>
                <tr>
                    <th><?php echo Yii::t('app', 'Procedimentos'); ?></th>
                    <th style="width:50px;"></th>
                </tr>
            </thead>
            <tbody id="receptor">
                <?php if (isset($model_procedimentos)) { ?>
                    <?php foreach ($model_procedimentos as $procedimento) { ?>
                        <tr id='<?php echo $procedimento->id_procedimento; ?>'>
                            <td class='procedimento-label'><?php echo $procedimento->procedimento; ?></td>
                            <td class='delete'><a style='text-decoration:none;' onclick='deleteRow(this, <?php echo $procedimento->id_procedimento; ?>);' href='javascript:void(0)' title='' data-placement='right' data-toggle='tooltip' data-original-title='<?php echo Yii::t('app', 'Delete'); ?>'><i class='icon-trash'></i></a></td>
                            <input type='hidden' name='Procedimento[]' value='<?php echo $procedimento->id_procedimento; ?>'>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>

</fieldset>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'inverse',
        'label' => Yii::t('app', 'Salvar'),
        'htmlOptions' => array('id' => 'dentista-button')
    ));
    ?>
    <span id="val-button" class="help-inline" style="color:#000; display: none;"><?php echo Yii::t('app', 'Há campos em branco ou com valor inválido, corrija-os.'); ?></span>
</div>

<?php $this->endWidget('dentista-form'); ?>

<script>
    $('#dentista-form').submit(function(e) {
        if (valForm('dentista-form')) {
            $('.form-actions').css('background', '#468847');
            $('.form-actions').css('border-top', '1px solid #333');
        } else {
            $('.form-actions').css('background', '#B94A48');
            $('.form-actions').css('border-top', '1px solid #333');
            $('#val-button').show();
            return false;
        }
    });
</script>