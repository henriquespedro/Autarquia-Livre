<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "search_parameters".
 *
 * @property integer $id
 * @property integer $search_id
 * @property string $name
 * @property boolean $require
 * @property string $type
 * @property string $sqlquery
 * @property string $value_field
 * @property string $description_field
 *
 * @property Search $search
 */
class SearchParameters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'search_parameters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['search_id'], 'required'],
            [['search_id'], 'integer'],
            [['name', 'type', 'sqlquery', 'value_field', 'description_field'], 'string'],
            [['require'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'search_id' => 'Search ID',
            'name' => 'Name',
            'require' => 'Require',
            'type' => 'Type',
            'sqlquery' => 'Sqlquery',
            'value_field' => 'Value Field',
            'description_field' => 'Description Field',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearch()
    {
        return $this->hasOne(Search::className(), ['id' => 'search_id']);
    }
}
