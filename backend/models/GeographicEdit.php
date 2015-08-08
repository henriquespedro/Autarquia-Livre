<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "geographic_edit".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $layer
 * @property string $type
 * @property string $chage_data
 * @property integer $setOrder
 *
 * @property Viewers $viewer
 */
class GeographicEdit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geographic_edit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'layer', 'type','featureNS', 'serverType'], 'string'],
            [['chage_data'], 'safe']
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
            'type' => 'Type',
            'chage_data' => 'Chage Data',
            'setOrder' => 'Set Order',
            'featureNS' => 'Feature Name Server',
            'serverType' => 'Server',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewer()
    {
        return $this->hasOne(Viewers::className(), ['id' => 'viewer_id']);
    }
}
