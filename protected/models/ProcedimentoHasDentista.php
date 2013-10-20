<?php

Yii::import('application.models._base.BaseProcedimentoHasDentista');

class ProcedimentoHasDentista extends BaseProcedimentoHasDentista
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}