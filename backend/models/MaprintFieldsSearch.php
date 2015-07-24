<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaprintFields;

/**
 * MaprintFieldsSearch represents the model behind the search form about `app\models\MaprintFields`.
 */
class MaprintFieldsSearch extends MaprintFields
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'viewer_id', 'setOrder'], 'integer'],
            [['name', 'code_field', 'type', 'validation', 'required'], 'safe'],
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
        $query = MaprintFields::find();

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
            'setOrder' => $this->setOrder,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code_field', $this->code_field])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'validation', $this->validation])
            ->andFilterWhere(['like', 'required', $this->required]);

        return $dataProvider;
    }
}
