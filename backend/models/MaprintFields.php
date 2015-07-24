<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maprint_fields".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $code_field
 * @property string $type
 * @property string $validation
 * @property string $required
 * @property integer $setOrder
 */
class MaprintFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maprint_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'code_field', 'type', 'validation', 'required'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'viewer_id' => 'Viewer ID',
            'name' => 'Nome',
            'code_field' => 'Código campo',
            'type' => 'Tipo',
            'validation' => 'Validação',
            'required' => 'Obrigatório',
            'setOrder' => 'Ordem',
        ];
    }
}
