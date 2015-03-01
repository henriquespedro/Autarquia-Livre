<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "search".
 *
 * @property integer $id
 * @property integer $viewer_id
 * @property string $name
 * @property string $description
 * @property string $sql_search
 * @property boolean $visible
 * @property string $chage_data
 * @property integer $setOrder
 *
 * @property Viewers $viewer
 */
class Search extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'search';
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParameters(){
        return $this->hasMany(SearchParameters::className(), ['search_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewer_id'], 'required'],
            [['viewer_id', 'setOrder'], 'integer'],
            [['name', 'description', 'sql_search'], 'string'],
            [['visible'], 'boolean'],
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
            'sql_search' => 'Sql Search',
            'visible' => 'Visible',
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
