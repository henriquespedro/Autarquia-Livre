<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param_server".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 */
class ParamServer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'param_server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'url'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'type' => 'Tipo',
            'url' => 'URL',
        ];
    }
}
