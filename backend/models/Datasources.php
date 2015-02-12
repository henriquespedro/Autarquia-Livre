<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datasources".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $string
 * @property string $change_data
 */
class Datasources extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datasources';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['change_data'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['type'], 'string', 'max' => 50],
            [['string'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome a Exibir',
            'type' => 'Tipo de Ligação',
            'string' => 'String da Ligação',
            'change_data' => 'Data',
        ];
    }
}
