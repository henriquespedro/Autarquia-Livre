<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maprint".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $description
 * @property string $description_font
 * @property string $layer
 * @property string $chage_data
 * @property integer $setOrder
 *
 * @property Viewers $viewer
 * @property MaprintScales[] $maprintScales
 * @property MaprintLayouts[] $maprintLayouts
 */
class Maprint extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'maprint';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'description', 'description_font', 'layer', 'serverType'], 'string'],
            [['chage_data'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'viewer_id' => 'Viewer ID',
            'name' => 'Nome',
            'description' => 'Descrição',
            'description_font' => 'Fonte dos dados',
            'layer' => 'Layer',
            'chage_data' => 'Chage Data',
            'setOrder' => 'Set Order',
            'serverType' => 'Servidor de Impressão',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewer() {
        return $this->hasOne(Viewers::className(), ['id' => 'viewer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaprintScales() {
        return $this->hasMany(MaprintScales::className(), ['maprint_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaprintLayouts() {
        return $this->hasMany(MaprintLayouts::className(), ['maprint_id' => 'id']);
    }

}
