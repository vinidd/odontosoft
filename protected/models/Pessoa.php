<?php

Yii::import('application.models._base.BasePessoa');

class Pessoa extends BasePessoa
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}