<?php

/**
 * This is the model base class for the table "cliente_has_procedimento".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ClienteHasProcedimento".
 *
 * Columns in table "cliente_has_procedimento" available as properties of the model,
 * followed by relations of table "cliente_has_procedimento" available as properties of the model.
 *
 * @property integer $id_cliente_has_procedimento
 * @property integer $id_procedimento
 * @property integer $id_cliente
 *
 * @property Cliente $idCliente
 * @property Procedimento $idProcedimento
 * @property ClienteHasProcedimentoHasConsulta[] $clienteHasProcedimentoHasConsultas
 */
abstract class BaseClienteHasProcedimento extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'cliente_has_procedimento';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ClienteHasProcedimento|ClienteHasProcedimentos', $n);
	}

	public static function representingColumn() {
		return 'id_cliente_has_procedimento';
	}

	public function rules() {
		return array(
			array('id_procedimento, id_cliente', 'required'),
			array('id_procedimento, id_cliente', 'numerical', 'integerOnly'=>true),
			array('id_cliente_has_procedimento, id_procedimento, id_cliente', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idCliente' => array(self::BELONGS_TO, 'Cliente', 'id_cliente'),
			'idProcedimento' => array(self::BELONGS_TO, 'Procedimento', 'id_procedimento'),
			'clienteHasProcedimentoHasConsultas' => array(self::HAS_MANY, 'ClienteHasProcedimentoHasConsulta', 'id_cliente_has_procedimento'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id_cliente_has_procedimento' => Yii::t('app', 'Id Cliente Has Procedimento'),
			'id_procedimento' => null,
			'id_cliente' => null,
			'idCliente' => null,
			'idProcedimento' => null,
			'clienteHasProcedimentoHasConsultas' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id_cliente_has_procedimento', $this->id_cliente_has_procedimento);
		$criteria->compare('id_procedimento', $this->id_procedimento);
		$criteria->compare('id_cliente', $this->id_cliente);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}