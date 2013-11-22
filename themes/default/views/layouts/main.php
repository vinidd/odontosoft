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
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.maskedinput.js'); ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.maskMoney.js'); ?>

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
                                array(
                                    'label' => Yii::t('app', 'Cliente'),
                                    'url' => array('/cliente/admin'),
                                    'visible' => Yii::app()->user->pbac('Basic.cliente.admin'),
                                    'items' => array(
                                        array(
                                            'label' => Yii::t('app', 'Create'),
                                            'url' => array('/cliente/create'),
                                        ),
                                        array(
                                            'label' => Yii::t('app', 'Manage'),
                                            'url' => array('/cliente/admin'),
                                        ),
                                    ),
                                ),
                                array(
                                    'label' => Yii::t('app', 'Dentista'),
                                    'url' => array('/dentista/admin'),
                                    'visible' => Yii::app()->user->pbac('Basic.dentista.admin'),
                                    'items' => array(
                                        array(
                                            'label' => Yii::t('app', 'Create'),
                                            'url' => array('/dentista/create'),
                                        ),
                                        array(
                                            'label' => Yii::t('app', 'Manage'),
                                            'url' => array('/dentista/admin'),
                                        ),
                                    ),
                                ),
                                array(
                                    'label' => Yii::t('app', 'Recepcionista'),
                                    'url' => array('/recepcionista/admin'),
                                    'visible' => Yii::app()->user->pbac('Basic.recepcionista.admin'),
                                    'items' => array(
                                        array(
                                            'label' => Yii::t('app', 'Create'),
                                            'url' => array('/recepcionista/create'),
                                        ),
                                        array(
                                            'label' => Yii::t('app', 'Manage'),
                                            'url' => array('/recepcionista/admin'),
                                        ),
                                    ),
                                ),
                                array(
                                    'label' => Yii::t('app', 'Procedimento'),
                                    'url' => array('/procedimento/admin'),
                                    'visible' => Yii::app()->user->pbac('Basic.procedimento.admin'),
                                    'items' => array(
                                        array(
                                            'label' => Yii::t('app', 'Create'),
                                            'url' => array('/procedimento/create'),
                                        ),
                                        array(
                                            'label' => Yii::t('app', 'Manage'),
                                            'url' => array('/procedimento/admin'),
                                        ),
                                    ),
                                ),
                                array(
                                    'label' => Yii::t('app', 'Consulta'),
                                    'url' => array('/consulta/admin'),
                                    'visible' => Yii::app()->user->pbac('Basic.consulta.admin'),
                                    'items' => array(
                                        array(
                                            'label' => Yii::t('app', 'Create'),
                                            'url' => array('/consulta/create'),
                                        ),
                                        array(
                                            'label' => Yii::t('app', 'Manage'),
                                            'url' => array('/consulta/admin'),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                        array(
                            'class' => 'bootstrap.widgets.TbMenu',
                            'htmlOptions' => array('class' => 'pull-right'),
                            'items' => array(
                                array(
                                    'label' => 'Config',
                                    'url' => array('/userGroups'),
                                    'visible' => Yii::app()->user->pbac('userGroups.admin.admin')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Meu Perfil'),
                                    'url' => array('/cliente'),
                                    'visible' => Yii::app()->user->pbac('Basic.cliente.write') && !Yii::app()->user->pbac('Basic.cliente.admin')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Meu Perfil'),
                                    'url' => array('/dentista'),
                                    'visible' => Yii::app()->user->pbac('Basic.dentista.write') && !Yii::app()->user->pbac('Basic.dentista.admin')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Meu Perfil'),
                                    'url' => array('/recepcionista'),
                                    'visible' => Yii::app()->user->pbac('Basic.recepcionista.write') && !Yii::app()->user->pbac('Basic.recepcionista.admin')
                                ),
                                '---',
                                array(
                                    'label' => 'Login',
                                    'url' => array('/userGroups'),
                                    'visible' => Yii::app()->user->isGuest
                                ),
                                array(
                                    'label' => 'Logout (' . Yii::app()->user->name . ')',
                                    'url' => array('/userGroups/user/logout'),
                                    'visible' => !Yii::app()->user->isGuest
                                ),
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
                    'heading' => 'Odontosoft',
                    'headingOptions' => array('style' => 'color:#eeeeee; display: inline;'),
                ));
                echo CHtml::form(Yii::app()->request->baseUrl . '/site/changeLanguage', 'post', array('id' => 'lang-form', 'style' => 'float:right;'));
                echo CHtml::imageButton(Yii::app()->request->baseUrl . '/images/brasil-icon.png', array('style' => 'width: 50px; margin-right: 10px;', 'onclick' => 'changeLang("pt")'));
                echo CHtml::imageButton(Yii::app()->request->baseUrl . '/images/usa-icon.png', array('style' => 'width: 50px;', 'onclick' => 'changeLang("en")'));
                echo CHtml::hiddenField('lang', '');
                
                echo CHtml::hiddenField('path', Yii::app()->request->requestUri);
                echo CHtml::endForm();
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
