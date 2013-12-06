<?php
$this->breadcrumbs = array(
    $model_consulta->label(2) => array('consulta/admin'),
    $model->label(2),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label(2)); ?>
    <span style="float: right;">
<!--        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('consulta/create'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Create'); ?>">
            <i class="icon-plus"></i>
        </a>-->
    </span>
</h1>

<br>

<fieldset>
    <legend><?php echo Yii::t('app', 'Consulta'); ?></legend>
    <?php echo CHtml::hiddenField('confirm_msg', Yii::t('app', 'Você tem certeza disso?')); ?>
    <?php echo CHtml::hiddenField('url', Yii::app()->request->baseUrl); ?>
    <?php echo CHtml::hiddenField('pago', Yii::t('app', 'Pago')); ?>
    <?php echo CHtml::hiddenField('em_aberto', Yii::t('app', 'Em aberto')); ?>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => 'striped',
        'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
        'data' => $model_consulta,
        'nullDisplay' => '-',
        'attributes' => array(
            array(
                'name' => 'id_cliente',
                'value' => $model_consulta->idCliente->idPessoa,
            ),
            array(
                'name' => 'id_dentista',
                'value' => $model_consulta->idDentista->idPessoa,
            ),
            array(
                'name' => 'id_procedimento',
                'value' => $model_consulta->idProcedimento,
            ),
            array(
                'label' => Yii::t('app', 'Valor'),
                'value' => 'R$ ' . $model->valor,
            ),
            array(
                'name' => 'id_status',
                'type' => 'raw',
                'value' => $model_consulta->getStatusNome(true),
            ),
            array(
                'label' => Yii::t('app', 'Pagamento'),
                'type' => 'raw',
                'value' => $model->getStatusNome(),
            )
        ),
    ));
    ?>
</fieldset>

<?php
if ($model_consulta->id_status != 5) {
    $user = Yii::app()->getComponent('user');
    $user->setFlash(
            'info', Yii::t('app', 'Pagamentos só poderão ser realizados após a conclusão da consulta.')
    );

    $this->widget('bootstrap.widgets.TbAlert', array(
        'userComponentId' => 'user',
        'block' => true,
        'fade' => true,
        'closeText' => false,
        'htmlOptions' => array(
            'style' => 'margin-top: 20px;'
        ),
        'alerts' => array(
            'info' => array('block' => false, 'closeText' => false),
        ),
    ));
    ?>

<?php } else if (isset($model->parcelas) && !empty($model->parcelas)) { ?>
    <fieldset>
        <legend><?php echo Yii::t('app', 'Parcelas'); ?></legend>
        <br>
        <table class="parcelas">
            <thead>
                <tr>
                    <th style="width: 40px; text-align: center;">#</th>
                    <th style="text-align: center;"><?php echo Yii::t('app', 'Valor'); ?></th>
                    <th style="width: 120px; text-align: center;"><?php echo Yii::t('app', 'Data de Vencimento'); ?></th>
                    <th style="width: 120px; text-align: center;"><?php echo Yii::t('app', 'Data de Pagamento'); ?></th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <?php if (!Yii::app()->user->pbac('Basic.pagamento.admin')) { ?>
                        <th style="width: 40px; text-align: center;"><?php echo Yii::t('app', 'Pagar'); ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($model->parcelas as $parcela) { ?>
                    <?php $parcela->changeValor(true); ?>
                    <?php $parcela->changeDateVencimento(true); ?>
                    <?php $parcela->changeDatePagamento(true); ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo 'R$ ' . $parcela->valor; ?></td>
                        <td><?php echo $parcela->data_vencimento; ?></td>
                        <td><span id="<?php echo 'data_pagamento_' . $parcela->primaryKey; ?>"><?php echo isset($parcela->data_pagamento) ? $parcela->data_pagamento : ''; ?></span></td>
                        <td><?php echo $parcela->getStatusNome(); ?></td>
                        <?php
                        if (!Yii::app()->user->pbac('Basic.pagamento.admin')) {
                            if ($parcela->id_status == 7) {
                                if ($model->id_tipo_pagamento == 3) {
                                    echo '<td><a href="' . Yii::app()->createUrl('/pagamento/pagarParcela', array('id_parcela' => $parcela->primaryKey, 'id_cliente' => $model_consulta->id_cliente)) . '" style="text-decoration:none;"><icon class="icon-money"></i></a></td>';
                                } else if ($model->id_tipo_pagamento == 2) {
                                    echo '<td><a href="' . Yii::app()->createUrl('/pagamento/pagarBoleto', array('id_parcela' => $parcela->primaryKey, 'id_cliente' => $model_consulta->id_cliente)) . '"><icon class="icon-print"></i></a></td>';
                                }
                            } else {
                                echo '<td></td>';
                            }
                        }
                        ?>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            </tbody>
        </table>
    </fieldset>
<?php } else { ?>

    <?php
    echo CHtml::link(Yii::t('app', 'Gerar pagamentos'), '', array(
        'class' => 'btn',
        'data-toggle' => 'modal',
        'data-target' => '#modal-pagamento',
        'style' => 'margin-top: 20px; margin-left: 180px;'
    ));
    ?>

<?php } ?>

<div id="_parcelas" class="parcelas">
    <fieldset>
        <legend><?php echo Yii::t('app', 'Parcelas'); ?></legend>
        <br>
        <table>
            <thead>
                <tr>
                    <th style="width: 40px; text-align: center;">#</th>
                    <th style="width: 120px; text-align: center;"><?php echo Yii::t('app', 'Valor'); ?></th>
                    <th style="width: 120px; text-align: center;"><?php echo Yii::t('app', 'Data Vencimento'); ?></th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 40px; text-align: center;"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </fieldset>
</div>

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'modal-pagamento'));
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo $model->label(2); ?></h4>
</div>

<div class="modal-body">
    <?php echo CHtml::hiddenField('sucesso', Yii::t('app', 'Sucesso')); ?>
    <?php echo CHtml::hiddenField('erro', Yii::t('app', 'Erro')); ?>
    <?php echo CHtml::hiddenField('valor_txt', Yii::t('app', 'Valor Parcela')); ?>
    <?php echo CHtml::hiddenField('elem_change', ''); ?>
    <div id="event-response"></div>

    <div class="row">
        <label class="span2"><strong><?php echo Yii::t('app', 'Valor'); ?></strong></label>
        <span id="_valor_consulta"><?php echo 'R$ ' . $model->valor; ?></span>
    </div>
    <div class="row" style="margin-top: 15px;">
        <label class="span2"><strong><?php echo Yii::t('app', 'Tipo Pagamento'); ?></strong></label>
        <?php if (Yii::app()->user->level > 10) { ?>
        <?php echo CHtml::dropDownList('tipo_pagamento', '', array(
            '1' => Yii::t('app', 'À vista'),
            '2' => Yii::t('app', 'Boleto bancário'),
            '3' => Yii::t('app', 'Cartão de débito'),
        ), array('prompt' => Yii::t('app', 'Select'))); ?>
        <?php } else { ?>
            <?php echo CHtml::dropDownList('tipo_pagamento', '', array(
            '2' => Yii::t('app', 'Boleto bancário'),
            '3' => Yii::t('app', 'Cartão de débito'),
        ), array('prompt' => Yii::t('app', 'Select'))); ?>
        <?php } ?>
    </div>
    <div class="row" id="_num_parcelas" style="display: none;">
        <label class="span2"><strong><?php echo Yii::t('app', 'Número de parcelas'); ?></strong></label>
        <?php echo CHtml::textField('numero_parcelas', '', array('style' => 'width: 25px;', 'class' => 'parcela')); ?>
        <span>(1~12)</span>
        <a onclick="gerarValorParcelas();" href="javascript:void(0);" class="btn" id="_gerar_valor_parcelas" style="margin-top: -10px; margin-left: 10px;"><?php echo Yii::t('app', 'Gerar'); ?></a>
        <div id="_valor_parcelas">
            
        </div>
    </div>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => Yii::t('app', 'Gerar'),
        'url' => '',
        'htmlOptions' => array(
            'id' => 'parcela-btn',
            'onclick' => 'gerarParcelas("' . $model_consulta->id_consulta . '", "' . $model->id_pagamento . '", "' . $model->valor . '")',
            'disabled' => 'disabled',
        ),
    ));
    ?>
</div>
<?php $this->endWidget(); ?>

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'modal-status'));
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo Yii::t('app', 'Mudança de status'); ?></h4>
</div>

<div class="modal-body">
    <?php echo CHtml::hiddenField('parcela_on', ''); ?>
    <label style="display: inline-block;"><strong><?php echo Yii::t('app', 'Data de Pagamento'); ?></strong></label>
    <?php
    $this->widget('CMaskedTextField', array(
        'name' => 'data_pagamento',
        'value' => '',
        'mask' => '99/99/9999',
        'htmlOptions' => array(
            'size' => 10,
            'id' => 'data_pagamento',
            'style' => 'width: 75px; margin-top: 10px; margin-left: 10px',
        )
    ));
    ?>
    <span class="_error" id="status_error"><?php echo Yii::t('app', 'Preencha a data de pagamento'); ?></span>
</div>

<div class="modal-footer">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => Yii::t('app', 'Salvar'),
        'url' => '',
        'htmlOptions' => array(
            'id' => 'status-btn',
            'onclick' => 'changePagStatus();',
        ),
    ));
    ?>
</div>

<?php $this->endWidget(); ?>

<script>
    $('#tipo_pagamento').change(function() {
        $('#numero_parcelas').val('');
        $('#_valor_parcelas').empty();
        if ($(this).val() == 3) {
            $('#_num_parcelas').show();
            $('#parcela-btn').attr('disabled', 'disabled');
        } else {
            $('#parcela-btn').removeAttr('disabled');
            $('#_num_parcelas').hide();
        }
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

</script>

<style>
    #_parcelas
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
    ._error
    {
        margin-left: 10px;
        color: #B94A48;
        display: none;
    }
</style>