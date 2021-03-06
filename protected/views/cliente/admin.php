<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label(2)); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('cliente/create'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Create'); ?>">
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
            'viewButtonUrl' => 'Yii::app()->createUrl("cliente/view", array("id" => $data["id_cliente"]))',
            'updateButtonUrl' => 'Yii::app()->createUrl("cliente/update", array("id" => $data["id_cliente"]))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("cliente/delete", array("id" => $data["id_cliente"]))',
        ),
        'nome_cliente'
    ),
));
?>