<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id_pagamento')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id_pagamento), array('view', 'id' => $data->id_pagamento)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id_consulta')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idConsulta)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('valor')); ?>:
	<?php echo GxHtml::encode($data->valor); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_tipo_pagamento')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idTipoPagamento)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_status')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idStatus)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_criacao')); ?>:
	<?php echo GxHtml::encode($data->data_criacao); ?>
	<br />

</div>