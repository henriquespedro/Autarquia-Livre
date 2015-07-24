<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaprintScales;

/**
 * MaprintScalesSearch represents the model behind the search form about `app\models\MaprintScales`.
 */
class MaprintScalesSearch extends MaprintScales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'maprint_id'], 'integer'],
            [['scale', 'label'], 'safe'],
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
        $query = MaprintScales::find();

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
            'maprint_id' => $this->maprint_id,
        ]);

        $query->andFilterWhere(['like', 'scale', $this->scale])
            ->andFilterWhere(['like', 'label', $this->label]);

        return $dataProvider;
    }
}
