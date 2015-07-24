<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maprint_scales".
 *
 * @property integer $id
 * @property integer $maprint_id
 * @property string $scale
 * @property string $label
 *
 * @property Maprint $maprint
 */
class MaprintScales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'maprint_scales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maprint_id'], 'required'],
            [['maprint_id'], 'integer'],
            [['scale', 'label'], 'string']
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
            'scale' => 'Scale',
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
