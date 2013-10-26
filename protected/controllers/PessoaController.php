<?php

class PessoaController extends GxController {

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
                'actions' => array('delete', 'admin', 'create', 'cidadeAutoComplete', 'pessoaAutoComplete', 'pessoaBuscaContato'),
                'pbac' => array('admin', 'admin.admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Pessoa'),
        ));
    }

    public function actionCreate() {
        $model = new Pessoa;


        if (isset($_POST['Pessoa'])) {
            $model->setAttributes($_POST['Pessoa']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id_pessoa));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Pessoa');


        if (isset($_POST['Pessoa'])) {
            $model->setAttributes($_POST['Pessoa']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id_pessoa));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Pessoa')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Pessoa');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Pessoa('search');
        $model->unsetAttributes();

        if (isset($_GET['Pessoa']))
            $model->setAttributes($_GET['Pessoa']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionCidadeAutoComplete() {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT cidade.id_cidade as id, CONCAT(cidade.nome,", ",estado.uf," - ",pais.nome) as value, CONCAT(cidade.nome,", ",estado.uf," - ",pais.nome) as label
                FROM cidade 
                INNER JOIN estado ON cidade.id_estado = estado.id_estado 
                INNER JOIN pais ON estado.id_pais = pais.id_pais
                WHERE cidade.nome LIKE :qterm';
            $sql .= ' ORDER BY cidade.nome ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = $_GET['term'] . '%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
        } else {
            return false;
        }
    }
    
    public function actionPessoaAutoComplete($grupo = '') {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT p.id_pessoa as id, p.nome as value, p.nome as label';
            $sql .= ' FROM pessoa p ';
            
            if ($grupo) {
                $sql .= ' INNER JOIN ' . $grupo . ' gr ON p.id_pessoa = gr.id_pessoa';
            }
            
            $sql .= ' WHERE p.nome LIKE :qterm';
            $sql .= ' ORDER BY p.nome ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = $_GET['term'] . '%';
            $command->bindParam(':qterm', $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
        } else {
            return false;
        }
    }
    
    public function actionPessoaBuscaContato() {
        if ($_POST['id']) {
            echo $_POST['id'];
        }
    }
}