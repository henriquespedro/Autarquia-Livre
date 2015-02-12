<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConfigConfrontation;

/**
 * ConfigConfrontationSearch represents the model behind the search form about `app\models\ConfigConfrontation`.
 */
class ConfigConfrontationSearch extends ConfigConfrontation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'viewer_id'], 'integer'],
            [['layer', 'name', 'search_field'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ConfigConfrontation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'viewer_id' => $this->viewer_id,
        ]);

        $query->andFilterWhere(['like', 'layer', $this->layer])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'search_field', $this->search_field]);

        return $dataProvider;
    }
}
