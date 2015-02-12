<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localadmin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $create_data
 * @property string $last_login
 */
class Localadmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'localadmin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'string'],
            [['create_data', 'last_login'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'create_data' => 'Criado em',
            'last_login' => 'Ultimo Login',
        ];
    }
}
