<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label()); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('procedimento/update', array('id' => $model->id_procedimento)); ?>" data-toggle="tooltip" data-placement="bottom" title="Editar">
            <i class="icon-pencil"></i>
        </a>
        <?php if (Yii::app()->user->pbac('Basic.procedimento.admin')) { ?>
            &nbsp;
            <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('procedimento/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="Gerenciar">
                <i class="icon-reorder"></i>
            </a>
        <?php } ?>
    </span>
</h1>
<br>
<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'type' => 'striped',
    'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
    'data' => $model,
    'nullDisplay' => '-',
    'attributes' => array(
        'procedimento',
        'valorNome',
    ),
));
?>