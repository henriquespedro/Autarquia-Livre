<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewer_tabs_tools".
 *
 * @property integer $id
 * @property integer $tabs_id
 * @property integer $tools_id
 *
 * @property Tools $tools
 * @property ViewerTabs $tabs
 */
class ViewerTabsTools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viewer_tabs_tools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tabs_id', 'tools_id'], 'integer']
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
            'tools_id' => 'Tools ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTools()
    {
        return $this->hasOne(Tools::className(), ['id' => 'tools_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabs()
    {
        return $this->hasOne(ViewerTabs::className(), ['id' => 'tabs_id']);
    }
}
