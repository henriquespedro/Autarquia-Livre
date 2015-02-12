<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewer_group".
 *
 * @property integer $id_viewer
 * @property integer $id_group
 */
class ViewerGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viewer_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_viewer', 'id_group'], 'required'],
            [['id_viewer', 'id_group'], 'integer'],
            [['id_viewer', 'id_group'], 'unique', 'targetAttribute' => ['id_viewer', 'id_group'], 'message' => 'The combination of Id Viewer and Id Group has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_viewer' => 'Id Viewer',
            'id_group' => 'Id Group',
        ];
    }
}
