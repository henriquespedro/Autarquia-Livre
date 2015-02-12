<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $create_date
 * @property string $last_login
 */
class AdminUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'string'],
            [['create_date', 'last_login'], 'safe']
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
            'create_date' => 'Create Date',
            'last_login' => 'Last Login',
        ];
    }
}
