<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Edit'),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label()); ?>
    <?php if (Yii::app()->user->pbac('Basic.consulta.write')) { ?>
        <span style="float: right;">
            &nbsp;
            <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('consulta/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Manage'); ?>">
                <i class="icon-reorder"></i>
            </a>
        </span>
    <?php } ?>
</h1>

<?php
$this->renderPartial('_form_update', array(
    'model' => $model,
));
?>