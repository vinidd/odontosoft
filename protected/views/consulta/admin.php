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

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'fixedHeader' => true,
    'type' => 'striped bordered',
    'headerOffset' => 40,
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl' => 'Yii::app()->createUrl("consulta/view", array("id" => $data["id_consulta"]))',
            'updateButtonUrl' => 'Yii::app()->createUrl("consulta/update", array("id" => $data["id_consulta"]))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("consulta/delete", array("id" => $data["id_consulta"]))',
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
                'style' => 'width: 120px; text-align: center;',
            ),
        )
    ),
));
?>

<script>
    $('#Consulta_dataN').live('focus', function() {
        $(this).mask("99/99/9999");
    });
</script>