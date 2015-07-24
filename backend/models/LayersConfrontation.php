<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "layers_confrontation".
 *
 * @property integer $id
 * @property integer $viewer_id
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
            [['viewer_id'], 'required'],
            [['viewer_id'], 'integer'],
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
            'viewer_id' => 'Viewer ID',
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
        return $this->hasOne(ConfigConfrontation::className(), ['id' => 'viewer_id']);
    }
}
