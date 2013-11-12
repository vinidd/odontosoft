<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', Yii::t('zii', 'Create')),
);
?>

<h1>
    <?php echo GxHtml::encode($model->label()); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('consulta/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Manage'); ?>">
            <i class="icon-reorder"></i>
        </a>
    </span>
</h1>

<?php
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true,
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array('style' => 'margin-top: 20px;'),
    'userComponentId' => 'user',
    'alerts' => array(// configurations per alert type
        'success',
        'error'
    ),
));
?>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'model_pessoa' => $model_pessoa,
    'model_cliente' => isset($model_cliente) ? $model_cliente : null,
    'model_telefones' => isset($model_telefones) ? $model_telefones : null,
    'buttons' => 'create'
));
?>