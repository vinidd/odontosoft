<?php
$this->breadcrumbs = array(
    Dentista::label(2),
);
?>

<h1>
    <?php echo GxHtml::encode(Dentista::label(2)); ?>
</h1>
<br>
<?php if (empty($dentistas)) { ?>

<?php } else { ?>
    <?php foreach ($dentistas as $dentista) { ?>
        <fieldset>
            <legend><?php echo $dentista->idPessoa; ?></legend>
            <?php
            $this->widget('bootstrap.widgets.TbDetailView', array(
                'type' => 'striped',
                'cssFile' => Yii::app()->request->baseUrl . '/css/table-view.css',
                'data' => $dentista,
                'nullDisplay' => '-',
                'attributes' => array(
                    'cro',
                    array(
                        'label' => 'Procedimentos',
                        'type' => 'raw',
                        'value' => function ($data) {
                            $str = '';
                            foreach ($data->procedimentoHasDentistas as $procedimento) {
                                $str .= $procedimento->idProcedimento . '. <br>';
                            }
                            return $str;
                        }
                    ),
                ),
            ));
            ?>
        </fieldset>
        <br>
    <?php } ?>
<?php } ?>