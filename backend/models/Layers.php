<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "layers".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $layer
 * @property string $layer_type
 * @property boolean $visible
 * @property boolean $show_toc
 * @property double $opacity
 * @property string $crs
 * @property string $style
 * @property string $serverType
 * @property string $type
 * @property string $icon
 * @property string $chage_data
 * @property integer $setOrder
 *
 * @property Viewers $viewer
 */
class Layers extends \yii\db\ActiveRecord
{
    public $permissionsgroups; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'layers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'layer', 'fields', 'layer_type', 'crs', 'style', 'serverType', 'type', 'layer_group'], 'string'],
            [['visible', 'show_toc'], 'boolean'],
            [['opacity'], 'number'],
            [['chage_data'], 'safe'],
            [['permissionsgroups'], 'safe']
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
            'name' => 'Nome',
            'layer' => 'Layer',
            'fields' => 'Campos',
            'layer_type' => 'Formato',
            'visible' => 'Visível',
            'show_toc' => 'Mostrar na TOC',
            'opacity' => 'Transparência',
            'crs' => 'Sistema de Coordenadas',
            'style' => 'Style',
            'serverType' => 'Tipo de Server',
            'type' => 'Tipo',
            'layer_group' => 'Grupo',
            'chage_data' => 'Chage Data',
            'setOrder' => 'Ordem',
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
