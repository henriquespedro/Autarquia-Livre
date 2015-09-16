<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property integer $id
 * @property string $tabs_id
 * @property string $name
 * @property string $description
 * @property string $code
 * @property string $icon
 *
 * @property ViewerTabsTools[] $viewerTabsTools
 */
class Tools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tabs_id', 'name', 'description', 'code', 'icon'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tabs_id' => 'Tabs ID',
            'name' => 'Name',
            'description' => 'Description',
            'code' => 'Code',
            'icon' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewerTabsTools()
    {
        return $this->hasMany(ViewerTabsTools::className(), ['tools_id' => 'id']);
    }
}
