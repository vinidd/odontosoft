<?php echo '<link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/pdf.css" media="print" />'; ?>

<div class="center head">
    <h3><?php echo Yii::t('app', 'Receita'); ?></h3>
</div>

<div class="left sub-head">
    <span class="name"><?php echo Yii::t('app', 'Paciente'); ?></span>
    <span class="response"><?php echo $model->idCliente->idPessoa->nome; ?></span>
</div>

<div class="right sub-head">
    <span class="name"><?php echo Yii::t('app', 'Data'); ?></span>
    <span class="response"><?php echo $model->data; ?></span>
</div>

<div class="content">
    <?php if (isset($model->receitas) && !empty($model->receitas)) { ?>
        <?php foreach ($model->receitas as $receita) { ?>
            <div class="receita">
                <?php echo $receita->receita; ?>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<div class="center bottom">
    <hr class="assinatura"/>
    <span><?php echo $model->idDentista->idPessoa->nome; ?></span>
</div>