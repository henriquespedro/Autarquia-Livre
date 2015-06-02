<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SearchParameters;

/**
 * SearchParametersSearch represents the model behind the search form about `app\models\SearchParameters`.
 */
class SearchParametersSearch extends SearchParameters
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'search_id'], 'integer'],
            [['name', 'type', 'sqlquery', 'value_field', 'description_field'], 'safe'],
            [['require'], 'boolean'],
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
        $query = SearchParameters::find();

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
            'search_id' => $_GET['id'],
            'require' => $this->require,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'sqlquery', $this->sqlquery])
            ->andFilterWhere(['like', 'value_field', $this->value_field])
            ->andFilterWhere(['like', 'description_field', $this->description_field]);

        return $dataProvider;
    }
}
