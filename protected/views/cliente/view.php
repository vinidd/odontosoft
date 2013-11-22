<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    GxHtml::valueEx($model),
);
?>


<h1>
    <?php echo GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('cliente/update', array('id' => $model->id_cliente)); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Edit'); ?>">
            <i class="icon-pencil"></i>
        </a>
        <?php if (Yii::app()->user->pbac('Basic.cliente.admin')) { ?>
            &nbsp;
            <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('cliente/admin'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Manage'); ?>">
                <i class="icon-reorder"></i>
            </a>
        <?php } ?>
    </span>
</h1>
<br>
<fieldset>
    <legend><?php echo Yii::t('app', 'Dados Pessoais'); ?></legend>
    <br>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => 'striped',
        'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
        'data' => $model_pessoa,
        'nullDisplay' => '-',
        'attributes' => array(
            'nome',
            'data_nascimento',
            array(
                'name' => 'sexo',
                'value' => $model_pessoa->getSexo(),
            ),
            'cpf',
            'rg',
            'email',
        ),
    ));
    ?>
</fieldset>
<br>
<fieldset>
    <legend><?php echo Yii::t('app', 'Contato'); ?></legend>
    <br>
    <?php
    foreach ($model_telefones as $model_telefone) {
        $this->widget('bootstrap.widgets.TbDetailView', array(
            'type' => 'striped',
            //'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
            'data' => $model_telefone,
            'nullDisplay' => '-',
            'attributes' => array(
                array(
                    'type' => 'raw',
                    'label' => $model_telefone->getTipo(),
                    'value' => $model_telefone->numero,
                )
            )
        ));
    }
    ?>
</fieldset>
<br>
<fieldset>
    <legend><?php echo Yii::t('app', 'Endereço'); ?></legend>
    <br>
    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type' => 'striped',
        //'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
        'data' => $model_endereco,
        'nullDisplay' => '-',
        'attributes' => array(
            'nome',
            array(
                'name' => 'tipo',
                'value' => $model_endereco->getTipo(),
            ),
            'cep',
            'rua',
            'numero',
            'complemento',
            'descricao',
            'bairro',
            array(
                'name' => 'id_cidade',
                'value' => $model_endereco->getCidade(),
                'label' => Yii::t('app', 'Cidade'),
            )
        )
    ));
    ?>
</fieldset>