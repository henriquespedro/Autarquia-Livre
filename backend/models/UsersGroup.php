<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_group".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_group
 *
 * @property Users $idUser
 */
class UsersGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_group'], 'required'],
            [['id_user', 'id_group'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Utilizador',
            'id_group' => 'Grupo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
