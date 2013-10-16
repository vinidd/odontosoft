<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id_recepcionista')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id_recepcionista), array('view', 'id' => $data->id_recepcionista)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id_pessoa')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idPessoa)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_criacao')); ?>:
	<?php echo GxHtml::encode($data->data_criacao); ?>
	<br />

</div>