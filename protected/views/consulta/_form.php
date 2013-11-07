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

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/grid-consulta.js'); ?>
<?php echo '<link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/collapse.css" />'; ?>
<?php $this->widget('ext.flowing-calendar.FlowingCalendarWidget'); ?>

<br><br>

<?php //$this->renderPartial('grid_consulta'); ?>

<div class="form-actions">
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

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array(
    'id' => 'create-consulta'
));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Consulta'); ?></h4>
</div>

<div class="modal-body">
    <?php echo CHtml::hiddenField('url', Yii::app()->request->baseUrl, array('id' => 'url')); ?>
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
                    'class' => 'span2'
                ),
            ));
            ?>
            <?php echo $form->maskedTextFieldRow($model_pessoa, 'data_nascimento', '99/99/9999', array('readonly' => 'readonly', 'class' => 'span2')); ?>
            <?php echo $form->textFieldRow($model_pessoa, 'email', array('readonly' => 'readonly', 'class' => 'span2')); ?>
        </div>
        <div id="pessoa-detail">

            <div class="clear"></div>

            <div class="control-group ">
                <div class="controls">
                    <input class="telefone span2" id="Telefone_residencial" type="text" name="Telefone[residencial]" readonly="readonly" placeholder="Telefone Residencial"/>
                    <input class="telefone span2" id="Telefone_celular" type="text" name="Telefone[celular]" readonly="readonly" placeholder="Telefone Celular"/>
                    <input class="telefone span2" id="Telefone_comercial" type="text" name="Telefone[comercial]" readonly="readonly" placeholder="Telefone Comercial"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="collapse-receptor">
    <!--<div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading head">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    <span class="legend">
                        <span id="horario"></span> &nbsp; <span id="status"></span>
                    </span>
                    <div class="separator">
                        <span class="right">
                            <i class="icon-angle-down icon-large"></i>
                        </span>
                    </div>
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse">
                <div class="accordion-inner">
                    <span id="cliente"></span>
                    <span id="dentista"></span>
                    <span id="duracao"></span>
                    <span id="descricao"></span>
                </div>
            </div>
        </div>
    </div>-->
</div>

<div class="modal-footer">
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
        'type' => 'primary',
        'label' => Yii::t('app', 'Salvar'),
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>