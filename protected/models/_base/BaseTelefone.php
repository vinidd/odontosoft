<?php

/**
 * This is the model base class for the table "telefone".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Telefone".
 *
 * Columns in table "telefone" available as properties of the model,
 * followed by relations of table "telefone" available as properties of the model.
 *
 * @property integer $id_telefone
 * @property integer $tipo
 * @property string $numero
 * @property integer $id_pessoa
 *
 * @property Pessoa $idPessoa
 */
abstract class BaseTelefone extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'telefone';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Telefone|Telefones', $n);
	}

	public static function representingColumn() {
		return 'numero';
	}

	public function rules() {
		return array(
			array('tipo, numero, id_pessoa', 'required'),
			array('tipo, id_pessoa', 'numerical', 'integerOnly'=>true),
			array('numero', 'length', 'max'=>13),
			array('id_telefone, tipo, numero, id_pessoa', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idPessoa' => array(self::BELONGS_TO, 'Pessoa', 'id_pessoa'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id_telefone' => Yii::t('app', 'Id Telefone'),
			'tipo' => Yii::t('app', 'Tipo'),
			'numero' => Yii::t('app', 'Numero'),
			'id_pessoa' => null,
			'idPessoa' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id_telefone', $this->id_telefone);
		$criteria->compare('tipo', $this->tipo);
		$criteria->compare('numero', $this->numero, true);
		$criteria->compare('id_pessoa', $this->id_pessoa);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}