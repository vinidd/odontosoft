<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id_dentista')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id_dentista), array('view', 'id' => $data->id_dentista)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id_pessoa')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idPessoa)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cro')); ?>:
	<?php echo GxHtml::encode($data->cro); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('data_criacao')); ?>:
	<?php echo GxHtml::encode($data->data_criacao); ?>
	<br />

</div>