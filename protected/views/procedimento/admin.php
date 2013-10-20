<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Gerenciar'),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label(2)); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('procedimento/create'); ?>" data-toggle="tooltip" data-placement="bottom" title="Incluir">
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
            'viewButtonUrl' => 'Yii::app()->createUrl("procedimento/view", array("id" => $data["id_procedimento"]))',
            'updateButtonUrl' => 'Yii::app()->createUrl("procedimento/update", array("id" => $data["id_procedimento"]))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("procedimento/delete", array("id" => $data["id_procedimento"]))',
        ),
        'procedimento'
    ),
));
?>