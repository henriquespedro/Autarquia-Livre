<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forms_parameters".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $type
 * @property string $parameter
 * @property string $label
 * @property string $description_field
 * @property string $sqlquery
 *
 * @property Forms $form
 */
class FormsParameters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forms_parameters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id'], 'required'],
            [['form_id'], 'integer'],
            [['type', 'parameter', 'label', 'description_field', 'sqlquery'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form_id' => 'Form ID',
            'type' => 'Type',
            'parameter' => 'Parameter',
            'label' => 'Label',
            'description_field' => 'Description Field',
            'sqlquery' => 'Sqlquery',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Forms::className(), ['id' => 'form_id']);
    }
}
