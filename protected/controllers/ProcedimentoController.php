<?php

class ProcedimentoController extends GxController {

    public function filters() {
        return array(
            'userGroupsAccessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow user with user admin permission to delete, create and view every profile
                'actions' => array('delete', 'admin', 'create', 'index', 'update', 'view', 'getProcedimento', 'dentistaBuscaProcedimento'),
                'pbac' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Procedimento'),
        ));
    }

    public function actionCreate() {
        $model = new Procedimento;

        $this->performAjaxValidation($model, 'procedimento-form');

        if (isset($_POST['Procedimento'])) {
            $model->setAttributes($_POST['Procedimento']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id_procedimento));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Procedimento');


        if (isset($_POST['Procedimento'])) {
            $model->setAttributes($_POST['Procedimento']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id_procedimento));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Procedimento')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        if (Yii::app()->user->pbac('Basic.procedimento.admin')) {
            $this->redirect('admin');
        }
    }

    public function actionAdmin() {
        $model = new Procedimento('search');
        $model->unsetAttributes();

        if (isset($_GET['Procedimento']))
            $model->setAttributes($_GET['Procedimento']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionGetProcedimento($term) {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT id_procedimento as id, procedimento as value, procedimento as label
                FROM procedimento
                WHERE procedimento LIKE :qterm';
            $sql .= ' ORDER BY procedimento ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = $_GET['term'] . '%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
            exit;
        } else {
            return false;
        }
    }

    public function actionDentistaBuscaProcedimento() {
        if (isset($_POST['id'])) {
            $procedimentos = Procedimento::model()->findAll(array(
                'join' => 'inner join procedimento_has_dentista phd on phd.id_procedimento = t.id_procedimento'
                . ' inner join dentista d on phd.id_dentista = d.id_dentista',
                'condition' => 'd.id_dentista = ' . $_POST['id'],
                'order' => 't.procedimento ASC',
            ));

            $data = CHtml::listData($procedimentos, 'id_procedimento', 'procedimento');

            echo "<option value=''>" . Yii::t('app', 'Selecione um procedimento') ."</option>";
            foreach ($data as $value => $procedimento_name) {
                echo CHtml::tag('option', array('value' => $value), CHtml::encode($procedimento_name), true);
            }
        }
    }

}
