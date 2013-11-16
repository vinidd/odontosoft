<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
    array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->id_consulta)),
    array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id_consulta), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id_consulta',
        array(
            'name' => 'idCliente',
            'type' => 'raw',
            'value' => $model->idCliente !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->idCliente)), array('cliente/view', 'id' => GxActiveRecord::extractPkValue($model->idCliente, true))) : null,
        ),
        array(
            'name' => 'idDentista',
            'type' => 'raw',
            'value' => $model->idDentista !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->idDentista)), array('dentista/view', 'id' => GxActiveRecord::extractPkValue($model->idDentista, true))) : null,
        ),
        'data',
        'horario',
        'duracao',
        array(
            'name' => 'idStatus',
            'type' => 'raw',
            'value' => $model->idStatus !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->idStatus)), array('status/view', 'id' => GxActiveRecord::extractPkValue($model->idStatus, true))) : null,
        ),
        'data_criacao',
    ),
));
?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('historicos')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->historicos as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('historico/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('pagamentos')); ?></h2>
<?php
echo GxHtml::openTag('ul');
foreach ($model->pagamentos as $relatedModel) {
    echo GxHtml::openTag('li');
    echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('pagamento/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
    echo GxHtml::closeTag('li');
}
echo GxHtml::closeTag('ul');
?>