<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LayersConfrontation;

/**
 * LayersConfrontationSearch represents the model behind the search form about `app\models\LayersConfrontation`.
 */
class LayersConfrontationSearch extends LayersConfrontation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'confrontation_id'], 'integer'],
            [['name', 'layer', 'description_field', 'regulement_field'], 'safe'],
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
        $query = LayersConfrontation::find();

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
            'confrontation_id' => $this->confrontation_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'layer', $this->layer])
            ->andFilterWhere(['like', 'description_field', $this->description_field])
            ->andFilterWhere(['like', 'regulement_field', $this->regulement_field]);

        return $dataProvider;
    }
}
