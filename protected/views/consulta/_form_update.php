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
<?php echo CHtml::hiddenField('Consulta[id_cliente]', $model->id_cliente, array('id' => 'Consulta_id_cliente')); ?>
<div class="control-group ">
    <label class="control-label" for=""><?php echo Yii::t('app', 'Cliente'); ?></label>
    <div class="controls">
        <input type="text" name="id_cliente" value="<?php echo $model->idCliente->idPessoa->nome; ?>" readonly="readonly">
    </div>
</div>

<?php echo CHtml::hiddenField('Consulta[id_dentista]', $model->id_dentista, array('id' => 'Consulta_id_dentista')); ?>
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
                        $("#Consulta_horario").removeAttr("disabled");
                        $.ajax({
                            "type": "POST",
                            "data": "id=" + ui.item.id_grupo,
                            "url":"' . Yii::app()->request->baseUrl . '/procedimento/dentistaBuscaProcedimento",
                            "success":function(data) {
                                $("#id_procedimento").empty();
                                $("#id_procedimento").removeAttr("disabled");
                                $("#id_procedimento").append(data);
                                $("#id_procedimento").focus();
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

<?php $this->endWidget('consulta-form'); ?>