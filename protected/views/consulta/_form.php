<script>
    $(document).ready(function() {
        checkTelefone('consulta');
    });
</script>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'consulta-form',
    'type' => 'inline',
//    'enableAjaxValidation' => true,
//    'enableClientValidation' => true,
        //'focus' => array(''),
        ));
?>

<br>
<fieldset>
    <legend>Cliente</legend>
    <br>
    <?php echo CHtml::hiddenField('Cliente[id_cliente]', isset($model_cliente->id_cliente) ? $model_cliente->id_cliente : '', array('id' => 'Cliente_id_cliente')); ?>
    <div class="control-group">
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name' => 'id_cliente',
                'value' => isset($model_cliente->id_pessoa) ? $model_cliente->idPessoa : '',
                'source' => Yii::app()->createUrl('/pessoa/pessoaAutoComplete/', array('grupo' => 'cliente')),
                'options' => array(
                    'minLength' => '3',
                    'select' => 'js:function(event, ui) {
                        $("#Cliente_id_cliente").val(ui.item.id_grupo);
                        $.ajax({
                            "type": "POST",
                            "data": "id=" + ui.item.id,
                            "url":"' . Yii::app()->request->baseUrl . '/pessoa/pessoaBuscaContato",
                            "success":function(data) {
                                obj = JSON.parse(data);
                                $("#id_cliente").attr("readonly", "readonly");
                                $("#Pessoa_data_nascimento").val(obj.data_nascimento);
                                $("#Pessoa_data_nascimento").css("border-color", "#468847");
                                $("#Pessoa_sexo").val(obj.sexo);
                                $("#Pessoa_sexo").css("border-color", "#468847");
                                $("#Pessoa_email").val(obj.email);
                                $("#Pessoa_email").css("border-color", "#468847");
                                $("#Telefone_residencial").val(obj.telefone_residencial);
                                $("#Telefone_celular").val(obj.telefone_celular);
                                $("#Telefone_comercial").val(obj.telefone_comercial);
                                $("#Telefone_residencial").trigger("blur");
                                $("#id_cliente").trigger("blur");
                                $("#consulta-button").removeAttr("disabled");
                                $("#Telefone_residencial").removeAttr("readonly");
                                $("#Telefone_celular").removeAttr("readonly");
                                $("#Telefone_comercial").removeAttr("readonly");
                            }
                        });
                    }'
                ),
                'htmlOptions' => array(
                    'id' => 'id_cliente',
                    'placeholder' => 'Nome',
                ),
            ));
            ?>
            <?php echo $form->maskedTextFieldRow($model_pessoa, 'data_nascimento', '99/99/9999', array('readonly' => 'readonly')); ?>
            <?php echo $form->textFieldRow($model_pessoa, 'email', array('readonly' => 'readonly')); ?>
        </div>
    </div>

    <div id="pessoa-detail">

        <div class="clear"></div>

        <div class="control-group ">
            <label class="control-label tel_label" style="width: 220px;" for="Telefone_residencial">Telefone Residencial</label>
            <label class="control-label tel_label" style="width: 220px;" for="Telefone_celular">Telefone Celular</label>
            <label class="control-label tel_label" style="width: 220px;" for="Telefone_comercial">Telefone Comercial</label>
            <div class="controls">
                <input class="telefone" id="Telefone_residencial" type="text" name="Telefone[residencial]" readonly="readonly"/>
                <input class="telefone" id="Telefone_celular" type="text" name="Telefone[celular]" readonly="readonly"/>
                <input class="telefone" id="Telefone_comercial" type="text" name="Telefone[comercial]" readonly="readonly"/>
            </div>
        </div>
    </div>
</fieldset>

<!--<fieldset>
    <legend>Dentista</legend>
    <br>
<?php echo CHtml::hiddenField('Dentista[id_dentista]', isset($model_dentista->id_dentista) ? $model_dentista->id_dentista : '', array('id' => 'Dentista_id_dentista')); ?>
    <div class="control-group">
        <div class="controls">
<?php
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name' => 'id_dentista',
    'value' => isset($model_dentista->id_pessoa) ? $model_dentista->idPessoa : '',
    'source' => Yii::app()->createUrl('/pessoa/pessoaAutoComplete/', array('grupo' => 'dentista')),
    'options' => array(
        'minLength' => '3',
        'select' => 'js:function(event, ui) {
                        $("#Dentista_id_dentista").val(ui.item.id_grupo);
//                        $.ajax({
//                            "type": "POST",
//                            "data": "id=" + ui.item.id,
//                            "url":"' . Yii::app()->request->baseUrl . '/pessoa/pessoaBuscaContato",
//                            "success":function(data) {
//                                obj = JSON.parse(data);
//                                $("#id_dentista").attr("readonly", "readonly");
//                                $("#Pessoa_data_nascimento").val(obj.data_nascimento);
//                                $("#Pessoa_data_nascimento").css("border-color", "#468847");
//                                $("#Pessoa_sexo").val(obj.sexo);
//                                $("#Pessoa_sexo").css("border-color", "#468847");
//                                $("#Pessoa_email").val(obj.email);
//                                $("#Pessoa_email").css("border-color", "#468847");
//                                $("#Telefone_residencial").val(obj.telefone_residencial);
//                                $("#Telefone_celular").val(obj.telefone_celular);
//                                $("#Telefone_comercial").val(obj.telefone_comercial);
//                                $("#Telefone_residencial").trigger("blur");
//                                $("#id_dentista").trigger("blur");
//                                $("#consulta-button").removeAttr("disabled");
//                            }
//                        });
                    }'
    ),
    'htmlOptions' => array(
        'id' => 'id_dentista',
        'placeholder' => 'Nome',
    ),
));
?>
            <span id="id_dentista_em_" class="help-inline error" style="display:none">Nome não pode ser vazio.</span>
        </div>
    </div>
</fieldset>-->

<?php $this->widget('ext.flowing-calendar.FlowingCalendarWidget'); ?>

<br><br>

<?php $this->renderPartial('grid_consulta'); ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'reset',
        'type' => 'danger',
        'label' => 'Limpar',
        'htmlOptions' => array('id' => 'dentista-reset', 'onclick' => 'btnReset();'),
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'inverse',
        'label' => 'Salvar',
        'htmlOptions' => array('id' => 'consulta-button', 'disabled' => 'disabled'),
    ));
    ?>
</div>

<?php $this->endWidget('consulta-form'); ?>

<style>
    .tel_error
    {
        display: none;
        color: #B94A48;
    }
    .clear
    {
        margin-top: 10px;
    }
</style>