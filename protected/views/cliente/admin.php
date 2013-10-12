<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Gerenciar'),
);

$this->menu = array(
    array('label' => Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
    array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cliente-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Gerenciar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>
<br>
<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'fixedHeader' => true,
    'type' => 'striped bordered',
    'headerOffset' => 40,
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'viewButtonUrl' => 'Yii::app()->createUrl("cliente/view", array("id" => $data["id_cliente"]))',
            'updateButtonUrl' => 'Yii::app()->createUrl("cliente/update", array("id" => $data["id_cliente"]))',
            'deleteButtonUrl' => 'Yii::app()->createUrl("cliente/delete", array("id" => $data["id_cliente"]))',
        ),
        'idPessoa',
    ),
));
?>