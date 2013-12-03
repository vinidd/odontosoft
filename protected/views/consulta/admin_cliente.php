<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<h1>
    <?php echo GxHtml::encode(Yii::t('app', Consulta::label(2))); ?>
    <span style="float: right;">
        <a style="text-decoration: none;" href="<?php echo Yii::app()->createUrl('consulta/create'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t('app', 'Create'); ?>">
            <i class="icon-plus"></i>
        </a>
    </span>
</h1>

<br>

<?php
if (isset($model->clienteHasProcedimentos) && !empty($model->clienteHasProcedimentos)) {
    foreach ($model->clienteHasProcedimentos as $procedimento) {
        $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => $procedimento->idProcedimento->procedimento,
            'headerIcon' => 'icon-bookmark',
            'htmlHeaderOptions' => array('style' => 'padding-top: 20px;'),
            'htmlOptions' => array('class' => 'bootstrap-widget-table'),
        ));
        ?>

        <table class="table">
            <tbody>
                <?php if (isset($procedimento->clienteHasProcedimentoHasConsultas) && !empty($procedimento->clienteHasProcedimentoHasConsultas)) { ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo Yii::t('app', 'Dentista'); ?></th>
                        <th><?php echo Yii::t('app', 'Data'); ?></th>
                        <th><?php echo Yii::t('app', 'Horário'); ?></th>
                        <th style="width: 120px;">Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php foreach ($procedimento->clienteHasProcedimentoHasConsultas as $consulta) { ?>
                    <?php $consulta->idConsulta->changeDate(true); ?>
                    <tr>
                        <td style="width: 60px"><?php echo $consulta->idConsulta->id_consulta; ?></td>
                        <td><?php echo $consulta->idConsulta->idDentista->idPessoa->nome; ?></td>
                        <td><?php echo $consulta->idConsulta->data; ?></td>
                        <td><?php echo $consulta->idConsulta->horario; ?></td>
                        <td style="text-align: center;"><?php echo $consulta->idConsulta->getStatusNome(); ?></td>
                        <td style="width: 20px; text-align: center;"><?php echo '<a class="icon-money" style="text-decoration:none;" href="' . Yii::app()->createUrl("pagamento/grid", array("id" => $consulta->idConsulta->id_consulta)) . '"></a>' ?></td>
                        <td style="width: 20px; text-align: center;"><?php echo '<a class="icon-stethoscope" style="text-decoration:none;" href="' . Yii::app()->createUrl("consulta/atestado", array("id" => $consulta->idConsulta->id_consulta)) . '"></a>' ?></td>
                        <td style="width: 20px; text-align: center;"><?php echo '<a class="icon-file-text-alt" style="text-decoration:none;" href="' . Yii::app()->createUrl("consulta/receita", array("id" => $consulta->idConsulta->id_consulta)) . '"></a>' ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
        </table>
        <?php $this->endWidget(); ?>
    <?php } ?>
<?php } else { ?>
<i><?php echo Yii::t('zii', 'No results found.'); ?></i>
<?php } ?>