<?php

/**
 * This is the model base class for the table "procedimento_has_dentista".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ProcedimentoHasDentista".
 *
 * Columns in table "procedimento_has_dentista" available as properties of the model,
 * followed by relations of table "procedimento_has_dentista" available as properties of the model.
 *
 * @property integer $id_procedimento_has_dentista
 * @property integer $id_procedimento
 * @property integer $id_dentista
 *
 * @property Procedimento $idProcedimento
 * @property Dentista $idDentista
 */
abstract class BaseProcedimentoHasDentista extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'procedimento_has_dentista';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ProcedimentoHasDentista|ProcedimentoHasDentistas', $n);
	}

	public static function representingColumn() {
		return 'id_procedimento_has_dentista';
	}

	public function rules() {
		return array(
			array('id_procedimento, id_dentista', 'required'),
			array('id_procedimento, id_dentista', 'numerical', 'integerOnly'=>true),
			array('id_procedimento_has_dentista, id_procedimento, id_dentista', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idProcedimento' => array(self::BELONGS_TO, 'Procedimento', 'id_procedimento'),
			'idDentista' => array(self::BELONGS_TO, 'Dentista', 'id_dentista'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id_procedimento_has_dentista' => Yii::t('app', 'Id Procedimento Has Dentista'),
			'id_procedimento' => null,
			'id_dentista' => null,
			'idProcedimento' => null,
			'idDentista' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id_procedimento_has_dentista', $this->id_procedimento_has_dentista);
		$criteria->compare('id_procedimento', $this->id_procedimento);
		$criteria->compare('id_dentista', $this->id_dentista);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}