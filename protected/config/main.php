<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'OdontoSoft',
    'theme' => 'default',
    'language' => 'pt',
    'sourceLanguage' => 'pt_br',
    'timeZone' => 'America/Sao_Paulo',
    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
        'application.messages.*',
        'ext.giix-components.*',
        'application.modules.userGroups.models.*',
        'application.modules.userGroups.controllers.*',
        'application.modules.userGroups.components.*',
        'application.modules.userGroups.userGroupsModule',
        'application.vendors.moip-php.lib.*',
    ),
    'modules' => array(
        'userGroups' => array(
            'accessCode' => 'ninjaturtles',
            'salt' => 'n1nj4',
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'ninjaturtles',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'bootstrap.gii',
                'ext.giix-core',
            ),
        ),
    ),
    // application components
    'components' => array(
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.extensions.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf',
                    'defaultParams' => array(
                        'mode' => 'pt_BR',
                        'format' => 'A4',
                        'default_font_size' => 11,
                        'default_font' => 'Helvetica',
                        'mgl' => 10,
                        'mgr' => 10,
                        'mgt' => 16,
                        'mgb' => 16,
                        'mgh' => 9,
                        'mgf' => 9,
                        'orientation' => 'P',
                    ),
                ),
            ),
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => true,
            'forceCopyAssets' => false, //true
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'userGroups.components.WebUserGroups',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'showScriptName' => false,
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=odontosoft',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
