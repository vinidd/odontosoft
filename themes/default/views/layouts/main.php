<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/default.js'); ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div id="page">

            <div id="menu">
                <?php
                $this->widget('bootstrap.widgets.TbNavBar', array(
                    'fixed' => 'top',
                    'brandOptions' => array('id' => 'brand'),
                    'items' => array(
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'htmlOptions' => array('class' => 'pull-left'),
                            'items' => array(
                                array('label' => Yii::t('zii', 'Home'), 'url' => array('/site/index')),
                                array('label' => 'Cliente', 'url' => array('/cliente'), 'visible' => Yii::app()->user->pbac('Basic.cliente.admin'),
                                    'items' => array(
                                        array('label' => 'Incluir', 'url' => array('/cliente/create')),
                                    )),
                                array('label' => 'Pessoa', 'url' => array('/pessoa'), 'visible' => Yii::app()->user->pbac('Basic.pessoa.admin'),
                                    'items' => array(
                                        array('label' => 'Base Pessoa', 'url' => array('/pessoa/basePessoa')),
                                    )),
                            ),
                        ),
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                array('label' => 'User', 'url' => array('#'), 'visible' => !Yii::app()->user->isGuest, 'items' => array(
                                        array('label' => 'Item', 'url' => '#'),
                                    )
                                ),
                                '---',
                                array('label' => 'Login', 'url' => array('/userGroups'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                                '---',
                            ),
                        ),
                    ),
                ));
                ?>
            </div>

            <div id="tread">
                <?php
                $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                    'heading' => 'I\'M NOT YELLING!',
                    'headingOptions' => array('style' => 'color:#eeeeee; display: inline;'),
                ));
                ?>

                <?php $this->endWidget(); ?>
            </div>

            <div id="breadcrumb">
                <div class="container">
                    <?php
                    if (isset($this->breadcrumbs)):
                        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                            'separator' => '-',
                        ));
                    endif
                    ?>
                </div>
            </div>

            <div class="container">

                <?php echo $content; ?>

                <div class="clear"></div>

            </div>

            <div id="footer">
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </div><!-- footer -->
        </div>
    </body>
</html>
