<?php

class PagamentoController extends GxController {

    public function filters() {
        return array(
            'userGroupsAccessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('grid', 'gerarParcelas'),
                'pbac' => array('write'),
            ),
            array('allow', // allow user with user admin permission to delete, create and view every profile
                'actions' => array('delete', 'admin', 'create'),
                'pbac' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Pagamento'),
        ));
    }

    public function actionCreate() {
        $model = new Pagamento;


        if (isset($_POST['Pagamento'])) {
            $model->setAttributes($_POST['Pagamento']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id_pagamento));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Pagamento');


        if (isset($_POST['Pagamento'])) {
            $model->setAttributes($_POST['Pagamento']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id_pagamento));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Pagamento')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Pagamento');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Pagamento('search');
        $model->unsetAttributes();

        if (isset($_GET['Pagamento']))
            $model->setAttributes($_GET['Pagamento']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionGrid($id) {
        $model = Pagamento::model()->find(array(
            'condition' => 'id_consulta = ' . $id
        ));
        $model_consulta = $this->loadModel($id, 'Consulta');

        $model->changeValor(true);

        $this->render('grid', array(
            'model' => $model,
            'model_consulta' => $model_consulta
        ));
    }

    public function actionGerarParcelas() {
        if (isset($_POST['id_consulta'], $_POST['id_pagamento'], $_POST['tipo_pagamento'], $_POST['valor'], $_POST['numero'])) {
            $valor_flo = number_format($_POST['valor'], 2, '.', '');
            $valor_arr = explode('.', $valor_flo);
            $valor_int = $valor_arr[0];
            $valor_dec = str_pad(substr($valor_arr[1], 0, 2), 2, '0', STR_PAD_RIGHT);
            $valor = $valor_int . '.' . $valor_dec;

            $model = $this->loadModel($_POST['id_pagamento'], 'Pagamento');
            $model->id_tipo_pagamento = $_POST['tipo_pagamento'];
            if ($model->id_tipo_pagamento == 1) {
                $model->id_status = 6;
            }
            $model->save();

            for ($i = 1; $i <= $_POST['numero']; $i++) {
                $model_parcela = new Parcela;
                $model_parcela->id_pagamento = $model->primaryKey;
                $model_parcela->valor = $valor;

                if ($model->id_tipo_pagamento == 1) {
                    $model_parcela->data_pagamento = date('Y-m-d');
                    $model_parcela->data_vencimento = date('Y-m-d');
                    $model_parcela->id_status = 6;
                } else {
                    $inc = '+' . (30 * $i) . ' day';
                    $date = strtotime($inc, strtotime(date('Y-m-d')));
                    $model_parcela->data_vencimento = date("Y-m-d", $date);
                    $model_parcela->id_status = 7;
                }
                $model_parcela->save();
            }
            echo true;
        }
    }

}
