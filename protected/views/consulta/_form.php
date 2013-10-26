<script>
    $(document).ready(function() {
        checkTelefone('cliente');
    });
</script>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'consulta-form',
    'type' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
        //'focus' => array(''),
        ));
?>

<br>
<fieldset>
    <legend>Cliente</legend>
    <br>
    <?php echo CHtml::hiddenField('Pessoa[id_pessoa]', isset($model_pessoa->id_pessoa) ? $model_pessoa->id_pessoa : '', array('id' => 'Pessoa_id_pessoa')); ?>

    <div class="control-group">
        <label class="control-label pessoa_label" for="id_cliente">Nome <span class='required'>*</span></label>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'id_pessoa',
                'value' => isset($model_pessoa->id_pessoa) ? $model_pessoa->nome : '',
                'source' => Yii::app()->createUrl('/pessoa/pessoaAutoComplete/', array('grupo' => 'cliente')),
                'options' => array(
                    'minLength' => '3',
                    'select' => 'js:function(event, ui) {
                        $("#Pessoa_id_pessoa").val(ui.item.id); 
                        $.ajax({
                            "type": "POST",
                            "data": "id=" + ui.item.id,
                            "url":"' . Yii::app()->request->baseUrl . '/pessoa/pessoaBuscaContato",
                            "success":function(data) {
                                console.log(data);
                            }
                        });
                    }'
                ),
                'htmlOptions' => array(
                    'id' => 'id_pessoa',
                ),
            ));
            ?>
            <span id="id_pessoa_em_" class="help-inline error" style="display:none">Nome não pode ser vazio.</span>
        </div>
    </div>

    <?php echo $form->textFieldRow($model_pessoa, 'email'); ?>

    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_residencial">Telefone Residencial</label>
        <div class="controls">
            <input class="telefone" id="Telefone_residencial" type="text" name="Telefone[residencial]"
        </div>
    </div>
    <br>
    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_celular">Telefone Celular</label>
        <div class="controls">
            <input class="telefone" id="Telefone_celular" type="text" name="Telefone[celular]"
        </div>
    </div>
    <br>
    <div class="control-group ">
        <label class="control-label tel_label" for="Telefone_comercial">Telefone Comercial</label>
        <div class="controls">
            <input class="telefone" id="Telefone_comercial" type="text" name="Telefone[comercial]"
        </div>
    </div>
    <br>
</fieldset>

<?php $this->endWidget('consulta-form'); ?>