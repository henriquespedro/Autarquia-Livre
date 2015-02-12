<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookmarks".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $description
 * @property string $x_coordinate
 * @property string $y_coordinate
 * @property string $chage_data
 * @property integer $setOrder
 *
 * @property Viewers $viewer
 */
class Bookmarks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookmarks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'description', 'x_coordinate', 'y_coordinate'], 'string'],
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
            'description' => 'Description',
            'x_coordinate' => 'X Coordinate',
            'y_coordinate' => 'Y Coordinate',
            'chage_data' => 'Chage Data',
            'setOrder' => 'Set Order',
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
