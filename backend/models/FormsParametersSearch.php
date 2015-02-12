<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FormsParameters;

/**
 * FormsParametersSearch represents the model behind the search form about `app\models\FormsParameters`.
 */
class FormsParametersSearch extends FormsParameters
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_id'], 'integer'],
            [['type', 'parameter', 'label', 'description_field', 'sqlquery'], 'safe'],
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
        $query = FormsParameters::find();

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
            'form_id' => $this->form_id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'parameter', $this->parameter])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'description_field', $this->description_field])
            ->andFilterWhere(['like', 'sqlquery', $this->sqlquery]);

        return $dataProvider;
    }
}
