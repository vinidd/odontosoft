<?php

Yii::import('application.models._base.BaseReceita');

class Receita extends BaseReceita
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}