<?php
$this->breadcrumbs = array(
    $model->label() => array('index'),
    Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Atestado'),
);
?>

<h1>
    <?php echo Yii::t('app', 'Create') . ' ' . Yii::t('app', 'Atestado'); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('consulta/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Manage'); ?>">
            <i class="icon-reorder"></i>
        </a>
    </span>
</h1>

<br>

<fieldset>
    <legend><?php echo Yii::t('app', 'Consulta'); ?></legend>
    <br>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => 'striped',
        'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
        'data' => $model,
        'nullDisplay' => '-',
        'attributes' => array(
            array(
                'label' => Yii::t('app', 'Cliente'),
                'value' => $model->idCliente->idPessoa->nome,
            ),
            array(
                'label' => Yii::t('app', 'Dentista'),
                'value' => $model->idDentista->idPessoa->nome,
            ),
            array(
                'label' => Yii::t('app', 'Procedimento'),
                'value' => $model->idProcedimento->procedimento,
            ),
        ),
    ));
    ?>
</fieldset>

<fieldset>
    <legend><?php echo Yii::t('app', 'Atestado'); ?></legend>
    <br>
    <?php
    if (isset($model->atestados) && !empty($model->atestados)) {
        foreach ($model->atestados as $atestado) {
            $this->widget('bootstrap.widgets.TbBox', array(
                'title' => ' ',
                'headerButtons' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbButtonGroup',
                        'type' => 'inverse',
                        'buttons' => array(
                            array(
                                'label' => Yii::t('app', 'Imprimir'),
                                'url' => Yii::app()->createUrl("consulta/atestado", array("id" => $model->id_consulta)),
                            ),
                        )),
                ),
                'content' => $atestado->atestado,
            ));
        }
    }
    ?>
    <br>

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'atestado-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbCKEditor', array(
        'model' => $model_atestado,
        'attribute' => 'atestado',
    ));
    ?>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'inverse',
            'label' => Yii::t('app', 'Salvar'),
            'htmlOptions' => array('id' => 'atestado-button')
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>
</fieldset>