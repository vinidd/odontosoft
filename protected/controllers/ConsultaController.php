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
                'actions' => array('index', 'view', 'update', 'admin', 'create', 'buscaConsulta', 'confereHorario'),
                'pbac' => array('write'),
            ),
            array('allow', // allow user with user admin permission to delete, create and view every profile
                'actions' => array('delete'),
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

        //se for cliente
        if (Yii::app()->user->pbac('Basic.consulta.write') && !Yii::app()->user->pbac('Basic.consulta.admin')) {
            $model_pessoa = Pessoa::model()->find(array('condition' => 'id_usuario = ' . Yii::app()->user->id));
            $model_pessoa->changeDate(true);
            $model_cliente = Cliente::model()->find(array('condition' => 'id_pessoa = ' . $model_pessoa->id_pessoa));
            $model_telefones = Telefone::model()->findAll(array('condition' => 'id_pessoa = ' . $model_pessoa->getPrimaryKey(), 'order' => 'tipo ASC'));
        }

        //salvando consulta e relações
        if (isset($_POST['Cliente'], $_POST['id_procedimento'], $_POST['Dentista'], $_POST['data'], $_POST['Consulta'], $_POST['Telefone'])) {
            $cliente = $this->loadModel($_POST['Cliente']['id_cliente'], 'Cliente');

            //contato
            if (isset($_POST['Telefone'])) {
                if (isset($_POST['Telefone']['residencial']) && $_POST['Telefone']['residencial']) {
                    if (!$model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $cliente->id_pessoa . ' AND tipo = 0'))) {
                        $model_telefone = new Telefone;
                        $model_telefone->setTelefone($cliente->id_pessoa, $_POST['Telefone']['residencial'], 0);
                    } else {
                        $model_telefone->setTelefone($cliente->id_pessoa, $_POST['Telefone']['residencial'], 0);
                    }
                    $model_telefone->save();
                } else {
                    if ($model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $cliente->id_pessoa . ' AND tipo = 0'))) {
                        $model_telefone->delete();
                    }
                }
                if (isset($_POST['Telefone']['celular']) && $_POST['Telefone']['celular']) {
                    if (!$model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $cliente->id_pessoa . ' AND tipo = 1'))) {
                        $model_telefone = new Telefone;
                        $model_telefone->setTelefone($cliente->id_pessoa, $_POST['Telefone']['celular'], 1);
                    } else {
                        $model_telefone->setTelefone($cliente->id_pessoa, $_POST['Telefone']['celular'], 1);
                    }
                    $model_telefone->save();
                } else {
                    if ($model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $cliente->id_pessoa . ' AND tipo = 1'))) {
                        $model_telefone->delete();
                    }
                }
                if (isset($_POST['Telefone']['comercial']) && $_POST['Telefone']['comercial']) {
                    if (!$model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $cliente->id_pessoa . ' AND tipo = 2'))) {
                        $model_telefone = new Telefone;
                        $model_telefone->setTelefone($cliente->id_pessoa, $_POST['Telefone']['comercial'], 2);
                    } else {
                        $model_telefone->setTelefone($cliente->id_pessoa, $_POST['Telefone']['comercial'], 2);
                    }
                    $model_telefone->save();
                } else {
                    if ($model_telefone = Telefone::model()->find(array('condition' => 'id_pessoa = ' . $cliente->id_pessoa . ' AND tipo = 2'))) {
                        $model_telefone->delete();
                    }
                }
            }

            //consulta
            $consulta = new Consulta;
            $consulta->id_cliente = $cliente->primaryKey;
            $consulta->id_dentista = $_POST['Dentista']['id_dentista'];
            $consulta->data = $_POST['data'];
            $consulta->horario = $_POST['Consulta']['horario'] . ':00';
            $consulta->id_status = (isset($model_cliente) ? 2 : 1);
            $consulta->id_procedimento = $_POST['id_procedimento'];
            $consulta->data_criacao = date('Y-m-d');

            if ($consulta->validate()) {
                $consulta->save();

                $chp = ClienteHasProcedimento::model()->find(array('condition' => 'id_cliente = ' . $cliente->primaryKey . ' AND id_procedimento = ' . $_POST['id_procedimento']));
                if ($chp) {
                    $chphc = new ClienteHasProcedimentoHasConsulta;
                    $chphc->id_cliente_has_procedimento = $chp->primaryKey;
                    $chphc->id_consulta = $consulta->primaryKey;
                    $chphc->save();
                } else {
                    $chp = new ClienteHasProcedimento;
                    $chp->id_cliente = $cliente->primaryKey;
                    $chp->id_procedimento = $_POST['id_procedimento'];
                    $chp->save();

                    $chphc = new ClienteHasProcedimentoHasConsulta;
                    $chphc->id_cliente_has_procedimento = $chp->primaryKey;
                    $chphc->id_consulta = $consulta->primaryKey;
                    $chphc->save();
                }
                $erro = false;
            } else {
                $erro = true;
            }
        }

        if (isset($erro) && $erro) {
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                    'error', Yii::t('app', 'Erro ao agendar consulta, por favor, complete todos os campos.')
            );
        } else if (isset($erro) && !$erro) {
            $user = Yii::app()->getComponent('user');
            $user->setFlash(
                    'success', Yii::t('app', 'Consulta agendada com sucesso.')
            );
        }

        $this->render('create', array(
            'model' => $model,
            'model_pessoa' => $model_pessoa,
            'model_cliente' => isset($model_cliente) ? $model_cliente : null,
            'model_telefones' => isset($model_telefones) ? $model_telefones : null,
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
        } else
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

        if (Yii::app()->user->pbac('Basic.consulta.admin')) {
            $this->render('admin', array(
                'model' => $model,
            ));
        } else if (!Yii::app()->user->pbac('Basic.consulta.admin') && Yii::app()->user->pbac('Basic.consulta.write')) {
            $this->render('admin_cliente', array(
                'model' => $model,
            ));
        }
    }

    public function actionBuscaConsulta() {
        if (isset($_POST['id'])) {
            $model_consulta = $this->loadModel($_POST['id'], 'Consulta');
            $result = array(
                'horario' => $model_consulta->horario,
                'status' => Yii::t('app', $model_consulta->idStatus->nome),
                'cliente' => $model_consulta->idCliente->idPessoa->nome,
                'dentista' => $model_consulta->idDentista->idPessoa->nome,
                'duracao' => $model_consulta->duracao ? $model_consulta->duracao : '',
                'procedimento' => $model_consulta->idProcedimento->procedimento,
                'descricao' => $model_consulta->descricao ? $model_consulta->descricao : '',
            );

            echo CJSON::encode($result);
        }
    }

    public function actionConfereHorario() {
        if (isset($_POST['horario'], $_POST['data'], $_POST['id_dentista'])) {
            if ($consultas = Consulta::model()->find(array('condition' => 'data = "' . $_POST['data'] . '" AND horario = "' . $_POST['horario'] . ':00" AND id_dentista = ' . $_POST['id_dentista']))) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    
    public function actionGetReceita() {
        //cria um arquivo em consulta/view com um formulário pro dentista/recepcionista incluir uma receita
        //isso vai ficar bem parecido com o actionCreate.. da uma olhada no do Cliente.. e o view do create é o _form
        
    }
    
    public function actionPrintReceita() {
        //cria um arquivo em consulta/view só com o html/php pra gerar o pdf.. chama isso depois que tu salvou a receita em GetReceita
        
        //tem um exemplo em cliente/printView .. e o view é print_view
    }
}
