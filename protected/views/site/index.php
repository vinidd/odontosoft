<div class='widget-right'>
    <ul> <!-- sei la man coloca as coisa aqui -->
        <li> <a href=""><i class="icon-linkedin-sign icon-3x "></i><br>asda 1</a></li> 
        <li><a href=""><i class="icon-bug icon-3x "></i><br>asda 2</a></li> 
        <li><a href=""><i class="icon-check-sign icon-3x "></i><br>asda 3</a></li> 
 
 
</ul>
</div>

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