<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'consulta-form',
    'type' => 'horizontal',
//    'enableAjaxValidation' => true,
//    'enableClientValidation' => true,
//    'focus' => array($model_pessoa, 'nome'),
        ));
?>
<br>
<?php echo CHtml::hiddenField('Consulta[id_consulta]', $model->id_consulta); ?>
<?php echo CHtml::hiddenField('data_atual', $model->data); ?>
<?php echo CHtml::hiddenField('horario_atual', $model->horario); ?>
<?php echo CHtml::hiddenField('dentista', $model->id_dentista); ?>
<?php echo CHtml::hiddenField('procedimento', $model->id_procedimento); ?>
<?php echo CHtml::hiddenField('url', Yii::app()->request->baseUrl); ?>

<?php echo CHtml::hiddenField('Consulta[id_cliente]', $model->id_cliente); ?>
<div class="control-group ">
    <label class="control-label" for=""><?php echo Yii::t('app', 'Cliente'); ?></label>
    <div class="controls">
        <input type="text" name="id_cliente" value="<?php echo $model->idCliente->idPessoa->nome; ?>" readonly="readonly">
    </div>
</div>

<?php echo CHtml::hiddenField('Consulta[id_dentista]', $model->id_dentista); ?>
<div class="control-group">
    <label class="control-label" for=""><?php echo Yii::t('app', 'Dentista'); ?></label>
    <div class="controls">
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'id_dentista_consulta',
            'value' => $model->idDentista->idPessoa->nome,
            'source' => Yii::app()->createUrl('/pessoa/pessoaAutoComplete/', array('grupo' => 'dentista')),
            'options' => array(
                'minLength' => '3',
                'select' => 'js:function(event, ui) {
                        $("#Consulta_id_dentista").val(ui.item.id_grupo);
                        $.ajax({
                            "type": "POST",
                            "data": "id=" + ui.item.id_grupo,
                            "url":"' . Yii::app()->request->baseUrl . '/procedimento/dentistaBuscaProcedimento",
                            "success":function(data) {
                                $("#Consulta_valor").val("");
                                $("#valor_view").val("");
                                $("#id_procedimento").empty();
                                $("#id_procedimento").append(data);
                                $("#id_procedimento").focus();
                                
                                if (ui.item.id_grupo === $("#dentista").val()) {
                                    $("#id_procedimento").val($("#procedimento").val());
                                }
                            }
                        });
                    }'
            ),
            'htmlOptions' => array(
                'id' => 'id_dentista_consulta',
            ),
        ));
        ?>
    </div>
</div>

<?php
$procedimentos = Procedimento::model()->findAll(array(
    'join' => 'inner join procedimento_has_dentista phd on phd.id_procedimento = t.id_procedimento'
    . ' inner join dentista d on phd.id_dentista = d.id_dentista',
    'condition' => 'd.id_dentista = ' . $model->id_dentista,
    'order' => 't.procedimento ASC',
        ));
?>

<div class="control-group">
    <label class="control-label" for=""><?php echo Yii::t('app', 'Procedimento'); ?></label>
    <div class="controls">
        <?php echo CHtml::dropDownList('Consulta[id_procedimento]', $model->id_procedimento, CHtml::listData($procedimentos, 'id_procedimento', 'procedimento'), array('id' => 'id_procedimento', 'class' => 'span3')); ?>
    </div>
</div>

<?php 
$modelPagamento = Pagamento::model()->find(array('condition' => 'id_consulta = ' . $model->id_consulta));
$modelPagamento->changeValor(true);
?>

<div class="control-group">
    <label class="control-label" for=""><?php echo Yii::t('app', 'Valor'); ?></label>
    <div class="controls">
        <div class="input-prepend">
            <span class="add-on">R$</span>
            <input id="valor_view" class="money" type="text" maxlength="9" name="valor_view" value="<?php echo $modelPagamento->valor; ?>" placeholder="<?php echo Yii::t('app', 'Valor'); ?>" style="text-align: right; width: 80px;"
                   <?php echo (Yii::app()->user->level >= 15) ? '' : 'disabled="disabled"'; ?>>
            <?php echo CHtml::hiddenField('Consulta[valor]', $modelPagamento->valor); ?>
        </div>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for=""><?php echo Yii::t('app', 'Data'); ?></label>
    <div class="controls">
        <?php
        $this->widget('CMaskedTextField', array(
            'name' => 'Consulta[data]',
            'value' => $model->data,
            'mask' => '99/99/9999',
            'htmlOptions' => array(
                'size' => 10,
                'id' => 'nova_data',
                'style' => 'width: 75px;',
                'placeholder' => Yii::t('app', 'Data'),
            )
        ));
        ?>
    </div>
</div>

<div class="control-group ">
    <label class="control-label" for="Consulta_horario"><?php echo Yii::t('app', 'Horário'); ?></label>
    <div class="controls">
        <div class="input-append">
            <input id="Consulta_horario" class="horario" type="text" name="Consulta[horario]" style="text-align:right; width: 31px;" value="<?php echo substr($model->horario, 0, 2); ?>">
            <span class="add-on">:00 h</span>
        </div>
        <span id="horario_em" class="tel_error" style="margin-left: 5px;"><?php echo Yii::t('app', 'Horário indisponível'); ?></span>
    </div>
</div>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'inverse',
        'label' => Yii::t('app', 'Salvar'),
        'htmlOptions' => array('id' => 'consulta-button')
    ));
    ?>
</div>

<?php $this->endWidget('consulta-form'); ?>

<script>
    $(document).ready(function() {
        $('#Consulta_horario').live('blur', function() {
            horario_term = $(this).val() + ':00';
            data_term = changeData($('#nova_data').val());
            if ($(this).val() !== '' && data_term !== '') {
                if (($('#nova_data').val() !== $('#data_atual').val()) || ($('#nova_data').val() === $('#data_atual').val() && horario_term !== $('#horario_atual').val())) {
                    $.ajax({
                        type: "POST",
                        data: {horario: $(this).val(), data: data_term, id_dentista: $('#Consulta_id_dentista').val()},
                        url: $('#url').val() + '/consulta/confereHorario',
                        success: function(data) {
                            if (data) {
                                $('#Consulta_horario').removeAttr('value');
                                $('#Consulta_horario').css('border-color', '#B94A48');
                                $('#horario_em').show();
                                $('#consulta-button').attr('disabled', 'disabled');
                            } else {
                                $('#consulta-button').removeAttr('disabled');
                            }
                        }
                    });
                }
            }
        });

        $('#nova_data').live('blur', function() {
            data_term = changeData($(this).val());
            horario_term = $('#Consulta_horario').val() + ':00';
            if (data_term !== '' && $('#Consulta_horario').val() !== '') {
                if (($('#nova_data').val() !== $('#data_atual').val()) || ($('#nova_data').val() === $('#data_atual').val() && horario_term !== $('#horario_atual').val())) {
                    $.ajax({
                        type: "POST",
                        data: {horario: $('#Consulta_horario').val(), data: data_term, id_dentista: $('#Consulta_id_dentista').val()},
                        url: $('#url').val() + '/consulta/confereHorario',
                        success: function(data) {
                            if (data) {
                                $('#Consulta_horario').removeAttr('value');
                                $('#Consulta_horario').css('border-color', '#B94A48');
                                $('#horario_em').show();
                                $('#consulta-button').attr('disabled', 'disabled');
                            } else {
                                $('#consulta-button').removeAttr('disabled');
                            }
                        }
                    });
                }
            }
        });
    });
</script>

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