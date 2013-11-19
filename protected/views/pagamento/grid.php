<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
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
if (false) { //$model_consulta->id_status != 5
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
                    <th style="width: 200px; text-align: center;"><?php echo Yii::t('app', 'Valor'); ?></th>
                    <th style="text-align: center;"><?php echo Yii::t('app', 'Data Vencimento'); ?></th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 40px; text-align: center;"><?php echo Yii::t('app', 'Pagar'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($model->parcelas as $parcela) { ?>
                    <?php $parcela->changeValor(true); ?>
                    <?php $parcela->changeDateVencimento(true); ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo 'R$ ' . $parcela->valor; ?></td>
                        <td><?php echo $parcela->data_vencimento; ?></td>
                        <td><?php echo $parcela->getStatusNome(); ?></td>
                        <td><?php
                            if ($parcela->id_status == 7) {
                                echo '<a href="#" style="text-decoration:none;"><icon class="icon-money"></i></a>';
                            }
                            ?></td>
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
    <?php echo CHtml::hiddenField('url', Yii::app()->request->baseUrl); ?>
    <?php echo CHtml::hiddenField('pago', Yii::t('app', 'Pago')); ?>
    <?php echo CHtml::hiddenField('em_aberto', Yii::t('app', 'Em aberto')); ?>
    <?php echo CHtml::hiddenField('sucesso', Yii::t('app', 'Sucesso')); ?>
    <?php echo CHtml::hiddenField('erro', Yii::t('app', 'Erro')); ?>
    <?php echo CHtml::hiddenField('elem_change', ''); ?>
    <div id="event-response"></div>

    <div class="row">
        <label class="span2"><strong><?php echo Yii::t('app', 'Valor'); ?></strong></label>
        <span><?php echo 'R$ ' . $model->valor; ?></span>
    </div>
    <div class="row" style="margin-top: 15px;">
        <label class="span2"><strong><?php echo Yii::t('app', 'Tipo Pagamento'); ?></strong></label>
        <?php echo CHtml::dropDownList('tipo_pagamento', '', GxHtml::listDataEx(TipoPagamento::model()->findAll()), array('prompt' => Yii::t('app', 'Select'))); ?>
    </div>
    <div class="row" id="_num_parcelas" style="display: none;">
        <label class="span2"><strong><?php echo Yii::t('app', 'Número de parcelas'); ?></strong></label>
        <?php echo CHtml::textField('numero_parcelas', '', array('style' => 'width: 25px;', 'class' => 'parcela')); ?>
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
        ),
    ));
    ?>
</div>
<?php $this->endWidget(); ?>

<script>
    $('#tipo_pagamento').change(function() {
        if ($(this).val() == 3) {
            $('#_num_parcelas').show();
        } else {
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
</style>