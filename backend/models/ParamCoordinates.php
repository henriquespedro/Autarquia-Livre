<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param_coordinates".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class ParamCoordinates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'param_coordinates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }
}
