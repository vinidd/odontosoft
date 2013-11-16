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
            'class' => 'CButtonColumn',
            'htmlOptions' => array('style' => 'width: 65px;'),
            'template' => '{pagar}{receita}{atestado}{update}',
            'buttons' => array(
                'pagar' => array(
                    'label' => '',
                    'url' => '"#"',
                    'options' => array('class' => 'icon-money', 'style' => 'text-decoration: none;'),
                ),
                'receita' => array(
                    'label' => '',
                    'url' => '"#"',
                    'options' => array('class' => 'icon-stethoscope', 'style' => 'text-decoration: none; margin-left: 5px;'),
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
            )
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