<?php

$user = Yii::app()->getComponent('user');
$user->setFlash(
        'success', "<strong>" . Yii::t('app', 'Welcome back') . "</strong> " . $model_cliente->idPessoa->nome . "!"
);

// Render them all with single `TbAlert`
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true,
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(// configurations per alert type
// success, info, warning, error or danger
        'success' => array('closeText' => '&times;'),
    ),
));
?>
<br>
<?php 
$this->renderPartial('grid', array(
    'model' => $model_pagamento,
    'model_consulta' => $model_consulta,
));
?>