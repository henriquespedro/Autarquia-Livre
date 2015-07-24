<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maprint_layouts".
 *
 * @property integer $id
 * @property integer $maprint_id
 * @property string $layout
 * @property string $label
 *
 * @property Maprint $maprint
 */
class MaprintLayouts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maprint_layouts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maprint_id'], 'required'],
            [['maprint_id'], 'integer'],
            [['layout', 'label'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'maprint_id' => 'Maprint ID',
            'layout' => 'Layout',
            'label' => 'Label',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaprint()
    {
        return $this->hasOne(Maprint::className(), ['id' => 'maprint_id']);
    }
}
