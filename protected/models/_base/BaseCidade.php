<?php

/**
 * This is the model base class for the table "cidade".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Cidade".
 *
 * Columns in table "cidade" available as properties of the model,
 * followed by relations of table "cidade" available as properties of the model.
 *
 * @property integer $id_cidade
 * @property string $nome
 * @property integer $id_estado
 *
 * @property Estado $idEstado
 * @property Endereco[] $enderecos
 */
abstract class BaseCidade extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'cidade';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Cidade|Cidades', $n);
	}

	public static function representingColumn() {
		return 'nome';
	}

	public function rules() {
		return array(
			array('id_estado', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>255),
			array('nome, id_estado', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id_cidade, nome, id_estado', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idEstado' => array(self::BELONGS_TO, 'Estado', 'id_estado'),
			'enderecos' => array(self::HAS_MANY, 'Endereco', 'id_cidade'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id_cidade' => Yii::t('app', 'Id Cidade'),
			'nome' => Yii::t('app', 'Nome'),
			'id_estado' => null,
			'idEstado' => null,
			'enderecos' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id_cidade', $this->id_cidade);
		$criteria->compare('nome', $this->nome, true);
		$criteria->compare('id_estado', $this->id_estado);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}