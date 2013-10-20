<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', Yii::t('zii', 'Create')),
);
?>
    
<h1>
    <?php echo GxHtml::encode($model->label()); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('procedimento/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="Gerenciar">
            <i class="icon-reorder"></i>
        </a>
    </span>
</h1>
    
<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'buttons' => 'create'
));
?>
