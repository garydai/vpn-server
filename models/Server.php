<?php

namespace app\models;

use yii\db\ActiveRecord;

class Server extends ActiveRecord
{
	public static function tableName()
    {
        return 'server';
    }
}