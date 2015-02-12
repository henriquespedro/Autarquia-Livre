<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config_confrontation".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $layer
 * @property string $name
 * @property string $search_field
 *
 * @property Viewers $viewer
 * @property LayersConfrontation[] $layersConfrontations
 */
class ConfigConfrontation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config_confrontation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id'], 'integer'],
            [['layer', 'name', 'search_field'], 'string']
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
            'layer' => 'Layer',
            'name' => 'Name',
            'search_field' => 'Search Field',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewer()
    {
        return $this->hasOne(Viewers::className(), ['id' => 'viewer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayersConfrontations()
    {
        return $this->hasMany(LayersConfrontation::className(), ['confrontation_id' => 'id']);
    }
}
