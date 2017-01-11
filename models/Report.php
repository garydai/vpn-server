<?php

namespace app\models;

use yii\db\ActiveRecord;

class Report extends ActiveRecord
{
	public static function tableName()
    {
        return 'report';
    }
}