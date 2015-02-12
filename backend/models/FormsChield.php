<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forms_chield".
 *
 * @property integer $id
 * @property integer $form_id
 * @property string $template
 * @property string $sqlselect
 * @property string $sqlinsert
 * @property string $sqlupdate
 * @property string $sqldelete
 *
 * @property Forms $form
 */
class FormsChield extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forms_chield';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['form_id'], 'required'],
            [['form_id'], 'integer'],
            [['template', 'sqlselect', 'sqlinsert', 'sqlupdate', 'sqldelete'], 'string']
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
            'template' => 'Template',
            'sqlselect' => 'Sqlselect',
            'sqlinsert' => 'Sqlinsert',
            'sqlupdate' => 'Sqlupdate',
            'sqldelete' => 'Sqldelete',
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
