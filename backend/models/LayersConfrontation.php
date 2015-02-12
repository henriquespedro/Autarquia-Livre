<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "layers_confrontation".
 *
 * @property integer $id
 * @property integer $confrontation_id
 * @property string $name
 * @property string $layer
 * @property string $description_field
 * @property string $regulement_field
 *
 * @property ConfigConfrontation $confrontation
 */
class LayersConfrontation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'layers_confrontation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['confrontation_id'], 'required'],
            [['confrontation_id'], 'integer'],
            [['name', 'layer', 'description_field', 'regulement_field'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'confrontation_id' => 'Confrontation ID',
            'name' => 'Name',
            'layer' => 'Layer',
            'description_field' => 'Description Field',
            'regulement_field' => 'Regulement Field',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfrontation()
    {
        return $this->hasOne(ConfigConfrontation::className(), ['id' => 'confrontation_id']);
    }
}
