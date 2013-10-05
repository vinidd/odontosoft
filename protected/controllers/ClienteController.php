<?php

class ClienteController extends GxController {

    public function filters() {
        return array(
            'userGroupsAccessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'view' actions
                'actions' => array('view', 'update', 'index'),
                'users' => array('@'),
            ),
            array('allow', // allow user with user admin permission to delete, create and view every profile
                'actions' => array('delete', 'admin', 'create'),
                'pbac' => array('admin', 'admin.admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Cliente'),
        ));
    }

    public function actionCreate() {
        $model = new Cliente;
        $model_pessoa = new Pessoa;
        $model_usuario = new UserGroupsUser('form');
        $model_endereco = new Endereco;
        
        $this->performAjaxValidation(array($model_pessoa, $model_usuario, $model_endereco), 'cliente-form');

        //pessoa
        if (isset($_POST['Pessoa'])) {
            $model_pessoa->attributes = $_POST['Pessoa'];

            if ($model_pessoa->validate()) {
                $model_pessoa->changeDate();
                $model_pessoa->save();

                //cliente
                $model->id_pessoa = $model_pessoa->getPrimaryKey();
                $model->data_criacao = date('Y-m-d');
                //$model->save();
            }
        }

        //usuário
        if (isset($_POST['UserGroupsUser'])
                && $_POST['UserGroupsUser']['username']
                && $_POST['UserGroupsUser']['password']) {
            $model_usuario->setScenario('admin');
            $model_usuario->group_id = 2; //user
            $model_usuario->status = 4; //ativo
            $model_usuario->username = $_POST['UserGroupsUser']['username'];
            $model_usuario->email = $model_pessoa->email;
            $model_usuario->password = $_POST['UserGroupsUser']['password'];

            if ($model_usuario->save()) {
                $model_pessoa->id_usuario = $model_usuario->getPrimaryKey();
                $model_pessoa->save();
            }
        }

        //contato
        if (isset($_POST['Telefone'])) {
            if (isset($_POST['Telefone']['residencial']) && $_POST['Telefone']['residencial']) {
                $model_telefone = new Telefone;
                $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['residencial'], 0);
                $model_telefone->save();
            }
            if (isset($_POST['Telefone']['celular']) && $_POST['Telefone']['celular']) {
                $model_telefone = new Telefone;
                $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['celular'], 1);
                $model_telefone->save();
            }
            if (isset($_POST['Telefone']['comercial']) && $_POST['Telefone']['comercial']) {
                $model_telefone = new Telefone;
                $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['comercial'], 2);
                $model_telefone->save();
            }
        }
        
        //endereco
        if (isset($_POST['Endereco'])) {
            $model_endereco->attributes = $_POST['Endereco'];
            $model_endereco->id_pessoa = $model_pessoa->getPrimaryKey();
            if ($model_endereco->validate()) {
                $model_endereco->save();
            }
        }
        
        //salva cliente e redireciona
        if ($model->save()) {
            $this->redirect(Yii::app()->request->baseUrl . '/site/index');
        }
        
        $this->render('create', array(
            'model' => $model,
            'model_pessoa' => $model_pessoa,
            'model_usuario' => $model_usuario,
            'model_endereco' => $model_endereco,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Cliente');


        if (isset($_POST['Cliente'])) {
            $model->setAttributes($_POST['Cliente']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id_cliente));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Cliente')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Cliente');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Cliente('search');
        $model->unsetAttributes();

        if (isset($_GET['Cliente']))
            $model->setAttributes($_GET['Cliente']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}