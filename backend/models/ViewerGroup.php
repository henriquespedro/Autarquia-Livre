<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewer_group".
 *
 * @property integer $viewer_id
 * @property integer $group_id
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
            [['viewer_id', 'group_id'], 'required'],
            [['viewer_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'viewer_id' => 'Id Viewer',
            'group_id' => 'Grupo',
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
