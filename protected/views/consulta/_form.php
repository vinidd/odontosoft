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
    <?php echo CHtml::hiddenField('Pessoa[id_pessoa]', isset($model_pessoa->id_pessoa) ? $model_pessoa->id_pessoa : '', array('id' => 'Pessoa_id_pessoa')); ?>

    <div class="control-group">
        <!--<label class="control-label pessoa_label" for="id_cliente">Nome <span class='required'>*</span></label>-->
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
                                obj = JSON.parse(data);
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
                            }
                        });
                    }'
                ),
                'htmlOptions' => array(
                    'id' => 'id_pessoa',
                    'placeholder' => 'Nome',
                ),
            ));
            ?>
            <span id="id_pessoa_em_" class="help-inline error" style="display:none">Nome não pode ser vazio.</span>
        </div>
    </div>

    <div id="pessoa-detail">
        <?php echo $form->maskedTextFieldRow($model_pessoa, 'data_nascimento', '99/99/9999', array('readonly' => 'readonly')); ?>
        <?php echo $form->textFieldRow($model_pessoa, 'sexo', array('readonly' => 'readonly')); ?>
        <?php echo $form->textFieldRow($model_pessoa, 'email', array('readonly' => 'readonly')); ?>
        
        <div class="clear"></div>
        
        <div class="control-group ">
            <label class="control-label tel_label" style="width: 220px;" for="Telefone_residencial">Telefone Residencial</label>
            <label class="control-label tel_label" style="width: 220px;" for="Telefone_celular">Telefone Celular</label>
            <label class="control-label tel_label" style="width: 220px;" for="Telefone_comercial">Telefone Comercial</label>
            <div class="controls">
                <input class="telefone" id="Telefone_residencial" type="text" name="Telefone[residencial]"/>
                <input class="telefone" id="Telefone_celular" type="text" name="Telefone[celular]"/>
                <input class="telefone" id="Telefone_comercial" type="text" name="Telefone[comercial]"/>
            </div>
            <span id="Telefone_em" class="tel_error">Preencha pelo menos um telefone</span>
        </div>
    </div>
</fieldset>

<?php $this->endWidget('consulta-form'); ?>

<style>
    #pessoa-detail
    {
        /*display: none;*/
    }
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