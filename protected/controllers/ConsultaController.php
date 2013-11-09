<?php

class ConsultaController extends GxController {

    public function filters() {
        return array(
            'userGroupsAccessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'update', 'create', 'buscaConsulta', 'confereHorario'),
                'pbac' => array('write'),
            ),
            array('allow', // allow user with user admin permission to delete, create and view every profile
                'actions' => array('delete', 'admin'),
                'pbac' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Consulta'),
        ));
    }

    public function actionCreate() {
        $model = new Consulta;
        $model_pessoa = new Pessoa;

        if (isset($_POST['Consulta'])) {
            $model->setAttributes($_POST['Consulta']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id_consulta));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'model_pessoa' => $model_pessoa,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Consulta');


        if (isset($_POST['Consulta'])) {
            $model->setAttributes($_POST['Consulta']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id_consulta));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Consulta')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Consulta');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Consulta('search');
        $model->unsetAttributes();

        if (isset($_GET['Consulta']))
            $model->setAttributes($_GET['Consulta']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionBuscaConsulta() {
        if (isset($_POST['id'])) {
            echo $_POST['id'];
        }
    }
    
    public function actionConfereHorario() {
        if (isset($_POST['horario'], $_POST['data'])) {
            if ($consultas = Consulta::model()->find(array('condition' => 'data = ' . $_POST['data'] . ' AND horario = ' . $_POST['horario']))) {
                echo true;
            } else {
                echo false;
            }
        }
    }
}