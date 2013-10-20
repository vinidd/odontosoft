<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id_consulta')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id_consulta), array('view', 'id' => $data->id_consulta)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id_cliente')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idCliente)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_dentista')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idDentista)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data')); ?>:
	<?php echo GxHtml::encode($data->data); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('horario')); ?>:
	<?php echo GxHtml::encode($data->horario); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('duracao')); ?>:
	<?php echo GxHtml::encode($data->duracao); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_status')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idStatus)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('data_criacao')); ?>:
	<?php echo GxHtml::encode($data->data_criacao); ?>
	<br />
	*/ ?>

</div>