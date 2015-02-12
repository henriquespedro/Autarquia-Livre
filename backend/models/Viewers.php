<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewers".
 *
 * @property integer $id
 * @property string $description
 * @property string $name
 * @property string $scales
 * @property string $init_extent
 * @property string $max_extent
 * @property string $projection
 * @property string $units
 * @property boolean $active
 * @property string $author
 * @property string $theme
 * @property string $create_data
 * @property string $modified_dat
 */
class Viewers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viewers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'boolean'],
            [['create_data', 'modified_dat'], 'safe'],
            [['description'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 100],
            [['scales', 'init_extent', 'max_extent'], 'string', 'max' => 250],
            [['projection', 'units', 'author', 'theme'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Descrição',
            'name' => 'Nome',
            'scales' => 'Escalas',
            'init_extent' => 'Extent inicial',
            'max_extent' => 'Máximo extent',
            'projection' => 'Sistema de projecção',
            'units' => 'Unidades',
            'active' => 'Ativo',
            'author' => 'Autor',
            'theme' => 'Tema',
            'create_data' => 'Criado em',
            'modified_dat' => 'Modificado em',
        ];
    }
}
