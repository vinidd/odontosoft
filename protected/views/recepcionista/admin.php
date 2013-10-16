<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Gerenciar'),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label(2)); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('recepcionista/create'); ?>" data-toggle="tooltip" data-placement="bottom" title="Incluir">
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
            'viewButtonUrl' => 'Yii::app()->createUrl("recepcionista/view", array("id" => $data["id_recepcionista"]))',
            'updateButtonUrl' => 'Yii::app()->createUrl("recepcionista/update", array("id" => $data["id_recepcionista"]))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("recepcionista/delete", array("id" => $data["id_recepcionista"]))',
        ),
        'nome_recepcionista::Recepcionista'
    ),
));
?>