<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'teste-form',
    'type' => 'in-line',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
        ));
?>

<?php

$this->widget('bootstrap.widgets.TbSelect2', array(
    'name' => 'Procedimento',
    'data' => GxHtml::listDataEx(Procedimento::model()->findAll()),
    'htmlOptions' => array(
        'multiple' => 'multiple',
    ),
));
?>
<?php

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'inverse',
    'label' => 'Salvar',
    'htmlOptions' => array('id' => 'teste-button')
));
?>

<?php $this->endWidget('teste-form'); ?>