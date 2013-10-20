<?php

/**
 * This is the model base class for the table "dentista".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Dentista".
 *
 * Columns in table "dentista" available as properties of the model,
 * followed by relations of table "dentista" available as properties of the model.
 *
 * @property integer $id_dentista
 * @property integer $id_pessoa
 * @property string $cro
 * @property string $data_criacao
 *
 * @property Consulta[] $consultas
 * @property Pessoa $idPessoa
 * @property ProcedimentoHasDentista[] $procedimentoHasDentistas
 */
abstract class BaseDentista extends GxActiveRecord {

    public $nome_dentista;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'dentista';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Dentista|Dentistas', $n);
    }

    public static function representingColumn() {
        return 'idPessoa';
    }

    public function rules() {
        return array(
            array('id_pessoa, data_criacao', 'required'),
            array('id_pessoa', 'numerical', 'integerOnly' => true),
            array('cro', 'length', 'max' => 45),
            array('cro', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id_dentista, id_pessoa, cro, data_criacao, nome_dentista', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'consultas' => array(self::HAS_MANY, 'Consulta', 'id_dentista'),
            'idPessoa' => array(self::BELONGS_TO, 'Pessoa', 'id_pessoa'),
            'procedimentoHasDentistas' => array(self::HAS_MANY, 'ProcedimentoHasDentista', 'id_dentista'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id_dentista' => Yii::t('app', 'Id Dentista'),
            'id_pessoa' => null,
            'cro' => Yii::t('app', 'CRO'),
            'data_criacao' => Yii::t('app', 'Data Criacao'),
            'consultas' => null,
            'idPessoa' => null,
            'procedimentoHasDentistas' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->with = array('idPessoa');

        $criteria->compare('id_dentista', $this->id_dentista);
        $criteria->compare('id_pessoa', $this->id_pessoa);
        $criteria->compare('cro', $this->cro, true);
        $criteria->compare('data_criacao', $this->data_criacao, true);
        $criteria->compare('idPessoa.nome', $this->nome_dentista, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function afterFind() {
        $this->nome_dentista = isset($this->idPessoa->nome) ? $this->idPessoa->nome : '';

        parent::afterFind();
    }

}