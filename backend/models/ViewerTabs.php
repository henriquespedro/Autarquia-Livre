<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewer_tabs".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $code
 * @property string $name
 */
class ViewerTabs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viewer_tabs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'integer'],
            [['code', 'name'], 'string']
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
            'code' => 'Codigo',
            'name' => 'Nome',
        ];
    }
}
