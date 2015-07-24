<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Search;

/**
 * SearchSearch represents the model behind the search form about `app\models\Search`.
 */
class SearchSearch extends Search {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'viewer_id', 'setOrder', 'datasource_id'], 'integer'],
            [['search_name', 'description', 'sql_search', 'chage_data'], 'safe'],
            [['visible'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Search::find();

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
            'viewer_id' => $_GET['viewer_id'],
            'visible' => $this->visible,
            'datasource_id' => $this->datasource_id,
            'chage_data' => $this->chage_data,
            'setOrder' => $this->setOrder,
        ]);

        $query->andFilterWhere(['like', 'search_name', $this->search_name])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'sql_search', $this->sql_search]);

        return $dataProvider;
    }

}
