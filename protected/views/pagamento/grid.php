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
    <legend>Consulta</legend>
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
        ),
    ));
    ?>
</fieldset>