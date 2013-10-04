<?php

Yii::import('application.models._base.BaseDentista');

class Dentista extends BaseDentista
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}