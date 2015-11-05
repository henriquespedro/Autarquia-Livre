<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Viewers;

/**
 * ViewersSearch represents the model behind the search form about `app\models\Viewers`.
 */
class ViewersSearch extends Viewers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['description', 'name', 'scales', 'init_extent', 'max_extent', 'projection', 'units', 'author', 'theme', 'create_data', 'modified_dat','comments'], 'safe'],
            [['active'], 'boolean'],
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
        $query = Viewers::find();

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
            'active' => $this->active,
            'create_data' => $this->create_data,
            'modified_dat' => $this->modified_dat,
//            'comments' => $this->comments,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'scales', $this->scales])
            ->andFilterWhere(['like', 'init_extent', $this->init_extent])
            ->andFilterWhere(['like', 'max_extent', $this->max_extent])
            ->andFilterWhere(['like', 'projection', $this->projection])
            ->andFilterWhere(['like', 'units', $this->units])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'theme', $this->theme]);

        return $dataProvider;
    }
}
