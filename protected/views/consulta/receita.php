<?php echo '<link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/pdf.css" media="print" />'; ?>

<div class="center head">
    <h3 style="border-left: 5px solid #323232; background-color: #7f7f7f; padding: 5px; color: #fff;"><?php echo Yii::t('app', 'Receita'); ?></h3>
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
            <div class="receita" style="border: 1px solid #323232; margin-top: 20px;padding: 10px;">
                            <?php echo $receita->receita; ?>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<div class="center bottom">
   <br><br><br> <hr class="assinatura" style="width: 300px;"/>
    <div style="text-align: center"><?php echo $model->idDentista->idPessoa->nome; ?> </div>

</div>