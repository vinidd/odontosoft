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
                'actions' => array('grid', 'gerarParcelas', 'changeStatusParcela', 'pagarParcela', 'pagarBoleto', 'welcomeBack'),
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

    public function actionChangeStatusParcela() {
        if (isset($_POST['id_parcela'], $_POST['data_pagamento'])) {
            $model = $this->loadModel($_POST['id_parcela'], 'Parcela');
            $model->id_status = 6;
            $model->data_pagamento = $_POST['data_pagamento'];
            $model->save();
            echo true;
        }
    }

    public function actionPagarParcela($id_parcela = 0, $id_cliente = 0) {
        if (isset($_POST['id_parcela'], $_POST['id_cliente']) && strlen($_POST['id_parcela']) && strlen($_POST['id_parcela'])) {
            $id_parcela = $_POST['id_parcela'];
            $id_cliente = $_POST['id_cliente'];
        }

        if ($id_parcela > 0 && $id_cliente > 0) {
            $model_parcela = $this->loadModel($id_parcela, 'Parcela');
            $model_cliente = $this->loadModel($id_cliente, 'Cliente');
            $model_endereco = Endereco::model()->find(array(
                'condition' => 'id_pessoa = ' . $model_cliente->id_pessoa
            ));
            $model_telefone = Telefone::model()->find(array(
                'condition' => 'id_pessoa = ' . $model_cliente->id_pessoa,
                'order' => 'tipo ASC'
            ));
        }

        $moip = new Moip();
        $moip->setEnvironment('test');
        $moip->setCredential(array(
            'key' => 'CXH5IRJIEIAPDT2ZF9O8SGYXJSYBESIO359FM3JG',
            'token' => 'WVBRJPKDY8EMP6ZQLQPD3GYUTSMJW2ZK'
        ));
        $moip->setUniqueID($model_parcela->primaryKey);
        $moip->setValue($model_parcela->valor);
        $moip->setReason('Pagamento odontosoft');
        $moip->setPayer(array(
            'payerId' => $model_cliente->primaryKey,
            'name' => $model_cliente->idPessoa->nome,
            'email' => $model_cliente->idPessoa->email,
            'billingAddress' => array(
                'address' => $model_endereco->rua,
                'number' => $model_endereco->numero,
                'complement' => isset($model_endereco->complemento) ? $model_endereco->complemento : '',
                'city' => $model_endereco->idCidade->nome,
                'neighborhood' => isset($model_endereco->bairro) ? $model_endereco->bairro : '',
                'state' => $model_endereco->idCidade->idEstado->nome,
                'country' => $model_endereco->idCidade->idEstado->idPais->nome,
                'zipCode' => isset($model_endereco->cep) ? $model_endereco->cep : '',
                'phone' => isset($model_telefone->numero) ? $model_telefone->numero : '',
            )
        ));
        $moip->addPaymentWay('debitCard');
        $moip->setReturnURL('http://localhost' . Yii::app()->createUrl('/pagamento/welcomeBack', array('id_parcela' => $model_parcela->primaryKey)));
        $moip->validate('Basic');
        $moip->send();
        $this->redirect($moip->getAnswer()->payment_url);
    }

    public function actionPagarBoleto($id_parcela = 0, $id_cliente = 0) {
        if (isset($_POST['id_parcela'], $_POST['id_cliente']) && strlen($_POST['id_parcela']) && strlen($_POST['id_parcela'])) {
            $id_parcela = $_POST['id_parcela'];
            $id_cliente = $_POST['id_cliente'];
        }

        if ($id_parcela > 0 && $id_cliente > 0) {
            $model_parcela = $this->loadModel($id_parcela, 'Parcela');
            $model_cliente = $this->loadModel($id_cliente, 'Cliente');
            $model_endereco = Endereco::model()->find(array(
                'condition' => 'id_pessoa = ' . $model_cliente->id_pessoa
            ));
            $model_telefone = Telefone::model()->find(array(
                'condition' => 'id_pessoa = ' . $model_cliente->id_pessoa,
                'order' => 'tipo ASC'
            ));
        }
        $moip = new Moip();
        $moip->setEnvironment('test');
        $moip->setCredential(array(
            'key' => 'CXH5IRJIEIAPDT2ZF9O8SGYXJSYBESIO359FM3JG',
            'token' => 'WVBRJPKDY8EMP6ZQLQPD3GYUTSMJW2ZK'
        ));
        $moip->setUniqueID($model_parcela->primaryKey);
        $moip->setValue('100.00');
        $moip->setReason('Pagamento odontosoft');
        $moip->setPayer(array(
            'payerId' => $model_cliente->primaryKey,
            'name' => $model_cliente->idPessoa->nome,
            'email' => $model_cliente->idPessoa->email,
            'billingAddress' => array(
                'address' => $model_endereco->rua,
                'number' => $model_endereco->numero,
                'complement' => isset($model_endereco->complemento) ? $model_endereco->complemento : '',
                'city' => $model_endereco->idCidade->nome,
                'neighborhood' => isset($model_endereco->bairro) ? $model_endereco->bairro : '',
                'state' => $model_endereco->idCidade->idEstado->nome,
                'country' => $model_endereco->idCidade->idEstado->idPais->nome,
                'zipCode' => isset($model_endereco->cep) ? $model_endereco->cep : '',
                'phone' => isset($model_telefone->numero) ? $model_telefone->numero : '',
            )
        ));
        $moip->addPaymentWay('billet');
        $moip->validate('Basic');
        print_r($moip->send());
        $this->redirect($moip->getAnswer()->payment_url);
    }

    public function actionWelcomeBack($id_parcela) {
        $model_parcela = $this->loadModel($id_parcela, 'Parcela');
        $model_parcela->id_status = 6;
        $model_parcela->data_pagamento = date('Y-m-d');
        $model_parcela->save();
        
        $model_pagamento = Pagamento::model()->findByPk($model_parcela->idPagamento->id_pagamento);
        
        $unpaid = false;
        foreach ($model_pagamento->parcelas as $parcela) {
            if ($parcela->id_status == 7) {
                $unpaid = true;
            }
        }
        
        if (!$unpaid) {
            $model_pagamento->id_status = 6;
            $model_pagamento->save();
        }
        
        $model_consulta = Consulta::model()->findByPk($model_pagamento->idConsulta->id_consulta);
        $model_cliente = Cliente::model()->findByPk($model_consulta->idCliente->id_cliente);
        
        $this->render('welcomeBack', array(
            'model_pagamento' => $model_pagamento,
            'model_consulta' => $model_consulta,
            'model_cliente' => $model_cliente,
        ));
    }
}
