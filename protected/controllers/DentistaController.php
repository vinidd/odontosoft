<?php

class DentistaController extends GxController {

    public function filters() {
        return array(
            'userGroupsAccessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view', 'update'),
                'pbac' => array('write'),
            ),
            array('allow', // allow user with user admin permission to delete, create and view every profile
                'actions' => array('delete', 'admin', 'create', 'teste'),
                'pbac' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $model = $this->loadModel($id, 'Dentista');
        $model_pessoa = $this->loadModel($model->id_pessoa, 'Pessoa');
        $model_pessoa->changeDate(true);
        $model_endereco = Endereco::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey(), 'order' => 'id_endereco DESC'));
        $model_telefones = Telefone::model()->findAll(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey(), 'order' => 'tipo ASC'));

        $this->render('view', array(
            'model' => $model,
            'model_pessoa' => $model_pessoa,
            'model_endereco' => $model_endereco,
            'model_telefones' => $model_telefones,
        ));
    }

    public function actionCreate() {
        $model = new Dentista;
        $model_pessoa = new Pessoa('create');
        $model_usuario = new UserGroupsUser('form');
        $model_endereco = new Endereco;

        $this->performAjaxValidation(array($model_pessoa, $model_usuario, $model_endereco), 'dentista-form');

        //pessoa
        if (isset($_POST['Pessoa'])) {
            $model_pessoa->attributes = $_POST['Pessoa'];

            if ($model_pessoa->validate()) {
                $model_pessoa->changeDate();
                $model_pessoa->save();

                //dentista
                $model->id_pessoa = $model_pessoa->getPrimaryKey();
                $model->data_criacao = date('Y-m-d');
                $model->cro = isset($_POST['Dentista']['cro']) ? $_POST['Dentista']['cro'] : null;
                //$model->save();
            }
        }

        //usuário
        if (isset($_POST['UserGroupsUser']) && $_POST['UserGroupsUser']['username'] && $_POST['UserGroupsUser']['password']) {
            $model_usuario->setScenario('admin');
            $model_usuario->group_id = 4; //dentista
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

        //salva dentista e redireciona
        if ($model->save()) {

            //procedimento
            if (isset($_POST['Procedimento'])) {
                foreach ($_POST['Procedimento'] as $procedimento) {
                    $model_phd = new ProcedimentoHasDentista;
                    $model_phd->id_dentista = $model->getPrimaryKey();
                    $model_phd->id_procedimento = $procedimento;
                    $model_phd->save();
                }
            }

            $this->redirect(array('view', 'id' => $model->getPrimaryKey()));
        }

        $this->render('create', array(
            'model' => $model,
            'model_pessoa' => $model_pessoa,
            'model_usuario' => $model_usuario,
            'model_endereco' => $model_endereco,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Dentista');
        $model_pessoa = $this->loadModel($model->id_pessoa, 'Pessoa');
        $model_pessoa->changeDate(true);
        $model_endereco = Endereco::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey(), 'order' => 'id_endereco DESC'));

        $this->performAjaxValidation(array($model_pessoa, $model_endereco), 'dentista-form');

        //pessoa
        if (isset($_POST['Pessoa'])) {
            $model_pessoa->attributes = $_POST['Pessoa'];

            if ($model_pessoa->validate()) {
                $model_pessoa->changeDate();
                $model_pessoa->save();
                $model->cro = (isset($_POST['Dentista']['cro'])) ? $_POST['Dentista']['cro'] : null;
                $model->save();
            }
        }

        //contato
        if (isset($_POST['Telefone'])) {
            if (isset($_POST['Telefone']['residencial']) && $_POST['Telefone']['residencial']) {
                if (!$model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey() . ' AND tipo = 0'))) {
                    $model_telefone = new Telefone;
                    $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['residencial'], 0);
                } else {
                    $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['residencial'], 0);
                }
                $model_telefone->save();
            } else {
                if ($model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey() . ' AND tipo = 0'))) {
                    $model_telefone->delete();
                }
            }
            if (isset($_POST['Telefone']['celular']) && $_POST['Telefone']['celular']) {
                if (!$model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey() . ' AND tipo = 1'))) {
                    $model_telefone = new Telefone;
                    $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['celular'], 1);
                } else {
                    $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['celular'], 1);
                }
                $model_telefone->save();
            } else {
                if ($model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey() . ' AND tipo = 1'))) {
                    $model_telefone->delete();
                }
            }
            if (isset($_POST['Telefone']['comercial']) && $_POST['Telefone']['comercial']) {
                if (!$model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey() . ' AND tipo = 2'))) {
                    $model_telefone = new Telefone;
                    $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['comercial'], 2);
                } else {
                    $model_telefone->setTelefone($model_pessoa->getPrimaryKey(), $_POST['Telefone']['comercial'], 2);
                }
                $model_telefone->save();
            } else {
                if ($model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey() . ' AND tipo = 2'))) {
                    $model_telefone->delete();
                }
            }
        }

        //endereco
        if (isset($_POST['Endereco'])) {
            $model_endereco->attributes = $_POST['Endereco'];
            if ($model_endereco->validate()) {
                $model_endereco->save();
            }
        }

        //redirect
        if (isset($_POST['Pessoa']) || isset($_POST['Telefone']) || isset($_POST['Endereco']) || isset($_POST['Dentista'])) {
            $this->redirect(array('view', 'id' => $model->id_dentista));
        }

        $model_telefones = Telefone::model()->findAll(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey(), 'order' => 'tipo ASC'));
        
        $this->render('update', array(
            'model' => $model,
            'model_pessoa' => $model_pessoa,
            'model_endereco' => $model_endereco,
            'model_telefones' => $model_telefones,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $model_dentista = $this->loadModel($id, 'Dentista');
            $model_pessoa = $this->loadModel($model_dentista->id_pessoa, 'Pessoa');

            //deletar usuário
            $model_usuario = $this->loadModel($model_pessoa->id_usuario, 'UserGroupsUser');
            $model_usuario->status = 0; //banned

            $model_usuario->save();
            $model_pessoa->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        if (Yii::app()->user->pbac('Basic.dentista.admin')) {
            $this->redirect('admin');
        } else {
            $model_pessoa = Pessoa::model()->find(array('condition' => 'id_usuario = ' . Yii::app()->user->id));
            $model = $model_pessoa->getPerfil();

            $this->redirect(array('view', 'id' => $model->id_dentista));
        }
    }

    public function actionAdmin() {
        $model = new Dentista('search');
        $model->unsetAttributes();

        if (isset($_GET['Dentista']))
            $model->setAttributes($_GET['Dentista']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionTeste() {
        if (isset($_POST['Procedimento'])) {
            foreach ($_POST['Procedimento'] as $proc) {
                echo $proc . '<br>';
            }
            exit;
        }
        $this->render('teste');
    }

}