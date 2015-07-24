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
class AdminUsers extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'admin_users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status',], 'integer'],
            [['username', 'password', 'password_hash', 'email'], 'string'],
            [['create_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'status' => 'Estado',
            'email' => 'E-mail',
            'create_date' => 'Criado em',
        ];
    }

}
