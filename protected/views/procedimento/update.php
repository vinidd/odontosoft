<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
    Yii::t('app', 'Editar'),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?>
    <?php if (Yii::app()->user->pbac('Basic.procedimento.admin')) { ?>
        <span style="float: right;">
            &nbsp;
            <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('procedimento/delete', array('id' => $model->id_procedimento)); ?>" data-toggle="tooltip" data-placement="bottom" title="Excluir">
                <i class="icon-trash"></i>
            </a>
            &nbsp;
            <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('procedimento/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="Gerenciar">
                <i class="icon-reorder"></i>
            </a>
        </span>
    <?php } ?>
</h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
));
?>