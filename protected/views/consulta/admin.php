<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label(2)); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('consulta/create'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Create'); ?>">
            <i class="icon-plus"></i>
        </a>
    </span>
</h1>

<br>

<h4 style="color:red;">TO DO:</h4>
<dl style="color:red; margin-left: 40px;">
    <dt>Aguardando</dt>
    <dd>- Confirmado</dd>
    <dd>- Adiado</dd>
    <dt>Adiado</dt>
    <dd>- Confirmado</dd>
    <dd>- Cancelado</dd>
</dl> 

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'fixedHeader' => true,
    'type' => 'striped bordered',
    'headerOffset' => 40,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'class' => 'CButtonColumn',
            'template' => '{receita}{atestado}{update}{delete}',
            'htmlOptions' => array('style' => 'width: 60px;'),
            'buttons' => array(
                'receita' => array(
                    'label' => '',
                    //'imageUrl' => Yii::app()->request->baseUrl . '/images/usa-icon.png',
                    'url' => '"#"',
                    'options' => array('class' => 'icon-stethoscope', 'style' => 'text-decoration: none;'),
                ),
                'atestado' => array(
                    'label' => '',
                    'url' => '"#"',
                    'options' => array('class' => 'icon-file-text-alt', 'style' => 'text-decoration: none; margin-left: 5px;'),
                ),
                'update' => array(
                    'label' => '',
                    'imageUrl' => '',
                    'url' => 'Yii::app()->createUrl("consulta/update", array("id"=>$data->id_consulta))',
                    'options' => array('class' => 'icon-pencil', 'style' => 'text-decoration: none; margin-left: 5px;'),
                ),
                'delete' => array(
                    'label' => '',
                    'imageUrl' => '',
                    'url' => 'Yii::app()->createUrl("consulta/delete", array("id"=>$data->id_consulta))',
                    'options' => array('class' => 'icon-trash', 'style' => 'text-decoration: none; margin-left: 5px;'),
                ),
            )
        ),
        array(
            'name' => 'IdNome',
            'filter' => GxHtml::textField('Consulta[idN]', $model->idN),
            'htmlOptions' => array(
                'style' => 'width: 30px; text-align: center;',
                'id' => 'id_',
            )
        ),
        array(
            'name' => 'ClienteNome',
            'filter' => GxHtml::textField('Consulta[clienteN]', $model->clienteN),
        ),
        array(
            'name' => 'DentistaNome',
            'filter' => GxHtml::textField('Consulta[dentistaN]', $model->dentistaN),
        ),
        array(
            'sortable' => true,
            'name' => 'DataNome',
            'filter' => GxHtml::textField('Consulta[dataN]', $model->dataN),
            'htmlOptions' => array(
                'style' => 'width: 70px;'
            )
        ),
        array(
            'name' => 'horario',
            'htmlOptions' => array(
                'style' => 'width: 50px;'
            )
        ),
        array(
            'name' => 'StatusNome',
            'type' => 'raw',
            'filter' => GxHtml::dropDownList('Consulta[statusN]', '', array(
                '1' => Yii::t('app', 'Confirmado'),
                '2' => Yii::t('app', 'Aguardando'),
                '3' => Yii::t('app', 'Cancelado'),
                '4' => Yii::t('app', 'Adiado'),
                '5' => Yii::t('app', 'Concluído'),
                    ), array('prompt' => '')),
            'htmlOptions' => array(
                'style' => 'width: 120px; text-align: center; cursor: pointer;',
                'id' => 'status_btn',
                'onclick' => 'changeStatus(this);',
            ),
        )
    ),
));
?>

<script>
    $('#Consulta_dataN').live('focus', function() {
        $(this).mask("99/99/9999");
    });

    $(document).ready(function() {
        $('.modal-backdrop').live('click', function() {
            if ($('#elem_change').val() === 'true') {
                location.reload();
            }
        });
        $('.close').live('click', function() {
            if ($('#elem_change').val() === 'true') {
                location.reload();
            }
        });
    });

    $(document).ready(function() {
        $('#novo_horario').live('blur', function() {
            if ($(this).val() > 24 || $(this).val() < 8) {
                $(this).val('');
                $(this).css('border-color', '#B94A48');
                $('#horario_em').css('display', 'inline-block');
            } else {
                nova_data = changeData($('#nova_data').val());
                $.ajax({
                    type: "POST",
                    data: {horario: $(this).val(), data: nova_data, id_consulta: $('#id_elem').val()},
                    url: $('#url').val() + '/consulta/confereHorario',
                    success: function(data) {
                        if (data) {
                            $('#novo_horario').val('');
                            $('#novo_horario').css('border-color', '#B94A48');
                            $('#horario_em').css('display', 'inline-block');
                        } else {
                            $('#novo_horario').css('border-color', '#468847');
                            $('#horario_em').css('display', 'none');
                        }
                    }
                });
            }
        });
    });

    function changeStatus(el) {
        status = el.firstElementChild.className;
        id = el.parentNode.querySelector("#id_").textContent;
        switch (status) {
            case 'btn-success' :
                statusConfirmado(id);
                break;
        }
    }

    function statusConfirmado(id) {
        $('#change-status').find('#status_atual').find('#confirmado').show();
        $('#change-status').find('#status_new').find('#cancelado').show();
        $('#change-status').find('#status_new').find('#adiado').show();
        $('#change-status').find('#status_new').find('#concluido').show();
        $('#change-status').find('#id_elem').val(id);
        $('#event-response').empty();
        $('#event-response').hide();
        $('#concluido_text').hide();
        $('#adiado_text').hide();
        $('#change-status').modal('toggle');
    }

    function newAdiado() {
        $('#event-response').empty();
        $('#event-response').append('<img src="' + $('#url').val() + '/images/loading.gif">');
        $('#event-response').show();
        id = $('#id_elem').val();
        data = changeData($('#nova_data').val());
        horario = $('#novo_horario').val();
        $.ajax({
            type: "POST",
            data: {id: id, data: data, horario: horario},
            url: $('#url').val() + '/consulta/adiarConsulta',
            success: function(data) {
                if (data) {
                    obj = JSON.parse(data);
                    $('#event-response').empty();
                    $('#event-response').text(obj.text);
                    if (obj.status) {
                        $('#event-response').attr('class', 'event-success');
                        $('#change-status').find('#status_atual').find('#adiado').show();
                        $('#change-status').find('#status_atual').find('#confirmado').hide();
                        $('#change-status').find('#status_new').find('#adiado').hide();
                        $('#elem_change').val('true');
                    } else {
                        $('#event-response').attr('class', 'event-fail');
                    }
                } else {
                    $('#event-response').empty();
                    $('#event-response').hide();
                }
            }
        });
    }

    function newConcluido() {
        $('#event-response').empty();
        $('#event-response').append('<img src="' + $('#url').val() + '/images/loading.gif">');
        $('#event-response').show();
        id = $('#id_elem').val();
        descricao = $('#descricao').val();
        $.ajax({
            type: "POST",
            data: {id: id, descricao: descricao},
            url: $('#url').val() + '/consulta/concluirConsulta',
            success: function(data) {
                if (data) {
                    obj = JSON.parse(data);
                    $('#event-response').empty();
                    $('#event-response').text(obj.text);
                    if (obj.status) {
                        $('#event-response').attr('class', 'event-success');
                        $('#change-status').find('#status_atual').find('#concluido').show();
                        $('#change-status').find('#status_atual').find('#confirmado').hide();
                        $('#change-status').find('#status_atual').find('#adiado').hide();
                        $('#change-status').find('#status_new').find('#adiado').hide();
                        $('#change-status').find('#status_new').find('#confirmado').hide();
                        $('#change-status').find('#status_new').find('#concluido').hide();
                        $('#change-status').find('#status_new').find('#cancelado').hide();
                        $('#change-status').find('#status_new').find('#aguardando').hide();
                        $('#elem_change').val('true');
                    } else {
                        $('#event-response').attr('class', 'event-fail');
                    }
                } else {
                    $('#event-response').empty();
                    $('#event-response').hide();
                }
            }
        });
    }

    function newCancelado() {
        $('#concluido_text').hide();
        $('#adiado_text').hide();
        var r = confirm($('#confirm_text').val());
        if (r) {
            $('#event-response').empty();
            $('#event-response').append('<img src="' + $('#url').val() + '/images/loading.gif">');
            $('#event-response').show();
            id = $('#id_elem').val();
            descricao = $('#descricao').val();
            $.ajax({
                type: "POST",
                data: {id: id},
                url: $('#url').val() + '/consulta/cancelarConsulta',
                success: function(data) {
                    if (data) {
                        obj = JSON.parse(data);
                        $('#event-response').empty();
                        $('#event-response').text(obj.text);
                        if (obj.status) {
                            $('#event-response').attr('class', 'event-success');
                            $('#change-status').find('#status_atual').find('#cancelado').show();
                            $('#change-status').find('#status_atual').find('#confirmado').hide();
                            $('#change-status').find('#status_atual').find('#adiado').hide();
                            $('#change-status').find('#status_atual').find('#aguardando').hide();
                            $('#change-status').find('#status_new').hide();
                            $('#elem_change').val('true');
                        } else {
                            $('#event-response').attr('class', 'event-fail');
                        }
                    } else {
                        $('#event-response').empty();
                        $('#event-response').hide();
                    }
                }
            });
        }
    }
</script>

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array(
    'id' => 'change-status',
));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo Yii::t('app', 'Change') . ' ' . Yii::t('app', 'Status'); ?></h4>
</div>

<div class="modal-body">
    <input id="id_elem" type="hidden" name="id_elem" value="">
    <input id="elem_change" type="hidden" name="elem_change" value="">
    <input id="url" type="hidden" name="url" value="<?php echo Yii::app()->request->baseUrl; ?>">
    <input id="confirm_text" type="hidden" name="confirm_text" value="<?php echo Yii::t('app', 'Você tem certeza que deseja disso?'); ?>">
    <div id="event-response"></div>
    <div id="status_atual">
        <span>Status: </span>
        <div id="confirmado" class="btn-block btn-success"><?php echo Yii::t('app', 'Confirmado'); ?></div>
        <div id="aguardando" class="btn-block btn-info"><?php echo Yii::t('app', 'Aguardando'); ?></div>
        <div id="cancelado" class="btn-block btn-danger"><?php echo Yii::t('app', 'Cancelado'); ?></div>
        <div id="adiado" class="btn-block btn-warning"><?php echo Yii::t('app', 'Adiado'); ?></div>
        <div id="concluido" class="btn-block btn-inverse"><?php echo Yii::t('app', 'Concluído'); ?></div>
    </div>
    <br>
    <div id="status_new">
        <span><?php echo Yii::t('app', 'Alterar para:'); ?></span>
        <div id="confirmado" class="btn-block btn-success"><?php echo Yii::t('app', 'Confirmado'); ?></div>
        <div id="aguardando" class="btn-block btn-info"><?php echo Yii::t('app', 'Aguardando'); ?></div>
        <div id="cancelado" class="btn-block btn-danger" onclick="newCancelado();"><?php echo Yii::t('app', 'Cancelado'); ?></div>
        <div id="adiado" class="btn-block btn-warning" onclick="$('#adiado_text').show();
                $('#concluido_text').hide();"><?php echo Yii::t('app', 'Adiado'); ?></div>
        <div id="concluido" class="btn-block btn-inverse" onclick="$('#concluido_text').show();
                $('#adiado_text').hide();"><?php echo Yii::t('app', 'Concluído'); ?></div>
    </div>
    <div id="adiado_text">
        <br>
        <span><?php echo Yii::t('app', 'Adiar para:'); ?></span>
        <?php
        $this->widget('CMaskedTextField', array(
            'name' => 'nova_data',
            'mask' => '99/99/9999',
            'htmlOptions' => array(
                'size' => 10,
                'id' => 'nova_data',
                'style' => 'width: 75px;',
                'placeholder' => Yii::t('app', 'Data'),
            )
        ));
        ?>
        <div style="margin-left: 10px; margin-top: 10px; display:inline-block" class="input-append">
            <input id="novo_horario" class="horario" type="text" name="novo_horario" style="text-align:right; width: 50px;" placeholder="<?php echo Yii::t('app', 'Horário'); ?>">
            <span class="add-on">:00 h</span>
        </div>
        <input type="button" id="btn-adiar" class="btn" style="height: 35px; width: 80px; margin-top: -10px; margin-left: 10px;" onclick="newAdiado();" value="<?php echo Yii::t('app', 'Adiar'); ?>">
        <span id="horario_em" class="tel_error" style="margin-left: 5px; display: none;"><?php echo Yii::t('app', 'Horário indisponível'); ?></span>
    </div>
    <div id="concluido_text">
        <br>
        <span><?php echo Yii::t('app', 'Descrição'); ?>:</span>
        <textarea id="descricao" rows="2" style="width: 400px;"></textarea>
        <input type="button" id="btn-concluir" class="btn" style="height: 35px; width: 80px; margin-top: -10px; margin-left: 10px;" onclick="newConcluido();" value="<?php echo Yii::t('app', 'Concluir'); ?>">
    </div>
</div>

<div class="modal-footer">

</div>

<?php $this->endWidget(); ?>

<style>
    .tel_error
    {
        color: #B94A48;
        width: 150px;
    }
    #status_btn:hover
    {
        opacity: 0.8;
    }
    #status_text
    {
        text-align: center;
        width: 120px;
        display: inline-block;
    }
    .btn-block
    {
        text-align: center;
        display: block;
        width: 120px;
        font-size: 14pt;
        height: 30px;
        vertical-align: middle;
        line-height: 30px;
        /*margin-left: 10px;*/
        margin: 10px;
        cursor: pointer;
    }
    .modal-body span
    {
        display: block;
        margin-bottom: 10px;
    }
    #status_atual div, #status_new div
    {
        display: none;
    }
    #status_new div:hover
    {
        opacity: 0.8;
    }
    #adiado_text, #concluido_text
    {
        display: none;
    }
    #event-response
    {
        display: none;
        height: 40px;
        border-radius: 4px;
        vertical-align: middle;
        line-height: 40px;
        text-align: center;
        margin-bottom: 10px;
    }
    .event-success
    {
        background-color: #5BB75B;
    }
    .event-fail
    {
        background-color: #DA4F49;
    }
</style>