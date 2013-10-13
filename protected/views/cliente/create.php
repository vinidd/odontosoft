<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', Yii::t('zii', 'Create')),
);

//$this->menu = array(
//    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
//    array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
//);
?>
    
<h1>
    <?php echo GxHtml::encode($model->label(2)); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('cliente/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="Gerenciar">
            <i class="icon-reorder"></i>
        </a>
    </span>
</h1>
    
<?php
$this->renderPartial('_form', array(
    'model' => $model,
    'model_pessoa' => $model_pessoa,
    'model_usuario' => $model_usuario,
    'model_endereco' => $model_endereco,
    'buttons' => 'create'
));
?>
