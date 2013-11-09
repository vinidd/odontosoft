<?php

/**
 * This is the model base class for the table "procedimento".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Procedimento".
 *
 * Columns in table "procedimento" available as properties of the model,
 * followed by relations of table "procedimento" available as properties of the model.
 *
 * @property integer $id_procedimento
 * @property string $procedimento
 *
 * @property ClienteHasProcedimento[] $clienteHasProcedimentos
 * @property ProcedimentoHasDentista[] $procedimentoHasDentistas
 */
abstract class BaseProcedimento extends GxActiveRecord {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'procedimento';
    }

    public static function label($n = 1) {
        return Yii::t('app', 'Procedimento|Procedimentos', $n);
    }

    public static function representingColumn() {
        return 'procedimento';
    }

    public function rules() {
        return array(
            array('procedimento', 'required'),
            array('procedimento', 'length', 'max' => 120),
            array('procedimento', 'unique'),
            array('id_procedimento, procedimento', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'clienteHasProcedimentos' => array(self::HAS_MANY, 'ClienteHasProcedimento', 'id_procedimento'),
            'procedimentoHasDentistas' => array(self::HAS_MANY, 'ProcedimentoHasDentista', 'id_procedimento'),
        );
    }

    public function pivotModels() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id_procedimento' => Yii::t('app', 'Id Procedimento'),
            'procedimento' => Yii::t('app', 'Procedimento'),
            'clienteHasProcedimentos' => null,
            'procedimentoHasDentistas' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id_procedimento', $this->id_procedimento);
        $criteria->compare('procedimento', $this->procedimento, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => false,
        ));
    }

}