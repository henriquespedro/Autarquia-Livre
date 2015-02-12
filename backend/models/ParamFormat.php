<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param_format".
 *
 * @property integer $id
 * @property string $name
 * @property string $format
 */
class ParamFormat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'param_format';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'format'], 'string']
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
            'format' => 'Format',
        ];
    }
}
