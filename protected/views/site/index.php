<?php if (Yii::app()->user->pbac('Basic.cliente.write') && !Yii::app()->user->pbac('Basic.cliente.admin')) { ?>
    <div class='widget-right'>
        <ul>
            <li>
                <a href="<?php echo Yii::app()->request->baseUrl . '/cliente'; ?>">
                    <div>
                        <i class="icon-user icon-3x "></i>
                        <br>
                        <span>Perfil</span>
                    </div>
                </a>
            </li> 
            <li>
                <a href="<?php echo Yii::app()->request->baseUrl . '/consulta/create'; ?>">
                    <div>
                        <i class="icon-book icon-3x "></i>
                        <br>
                        <span>Agendar Consulta</span>
                    </div>
                </a>
            </li> 
            <li>
                <a href="<?php echo Yii::app()->request->baseUrl . '/consulta/admin'; ?>">
                    <div>
                        <i class="icon-list-alt icon-3x "></i>
                        <br>
                        <span>Ver Consultas</span>
                    </div>
                </a>
            </li> 
        </ul>
    </div>
<?php } ?>

<div class='main-site'>

    <div class='column'>
        <?php
        $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Dentistas',
            'headerIcon' => 'icon-ok',
            'htmlHeaderOptions' => array(
                'class' => 'header-box',
            ),
            'htmlOptions' => array(
                'style' => 'width: 500px;'
            ),
        ));
        ?>
        <?php $this->endWidget(); ?>

    </div>

    <div class='column'>
        <?php
        $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Dentistas',
            'headerIcon' => 'icon-ok',
            'htmlHeaderOptions' => array(
                'class' => 'header-box',
            ),
            'htmlOptions' => array(
                'style' => 'width: 500px;'
            ),
        ));
        ?>
        <?php $this->endWidget(); ?>
    </div>
</div>