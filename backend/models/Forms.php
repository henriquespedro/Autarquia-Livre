<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forms".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $description
 * @property string $html_template
 * @property string $sql_select
 * @property string $sql_insert
 * @property string $sql_update
 * @property string $sql_delete
 * @property string $icon
 * @property string $chage_data
 * @property integer $setOrder
 *
 * @property Viewers $viewer
 */
class Forms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forms';
    }

        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameters(){
        return $this->hasMany(FormsParameters::className(), ['form_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChield(){
        return $this->hasMany(FormsChield::className(), ['form_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'description', 'html_template', 'sql_select', 'sql_insert', 'sql_update', 'sql_delete', 'icon'], 'string'],
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
            'html_template' => 'Html Template',
            'sql_select' => 'Sql Select',
            'sql_insert' => 'Sql Insert',
            'sql_update' => 'Sql Update',
            'sql_delete' => 'Sql Delete',
            'icon' => 'Icon',
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
