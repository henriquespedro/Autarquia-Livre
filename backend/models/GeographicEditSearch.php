<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeographicEdit;

/**
 * GeographicEditSearch represents the model behind the search form about `app\models\GeographicEdit`.
 */
class GeographicEditSearch extends GeographicEdit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'viewer_id', 'setOrder'], 'integer'],
            [['name', 'layer', 'type', 'chage_data'], 'safe'],
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
        $query = GeographicEdit::find();

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
            'chage_data' => $this->chage_data,
            'setOrder' => $this->setOrder,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'layer', $this->layer])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
