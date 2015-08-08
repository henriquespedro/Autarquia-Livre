<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Layers;

/**
 * LayersSearch represents the model behind the search form about `app\models\Layers`.
 */
class LayersSearch extends Layers {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'viewer_id', 'setOrder'], 'integer'],
            [['name', 'layer', 'fields', 'layer_type', 'crs', 'style', 'serverType', 'type', 'layer_group', 'chage_data'], 'safe'],
            [['visible', 'show_toc'], 'boolean'],
            [['opacity'], 'number'],
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
        $query = Layers::find();

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
            'show_toc' => $this->show_toc,
            'opacity' => $this->opacity,
            'chage_data' => $this->chage_data,
            'setOrder' => $this->setOrder,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'layer', $this->layer])
                ->andFilterWhere(['like', 'fields', $this->fields])
                ->andFilterWhere(['like', 'layer_type', $this->layer_type])
                ->andFilterWhere(['like', 'crs', $this->crs])
                ->andFilterWhere(['like', 'style', $this->style])
                ->andFilterWhere(['like', 'serverType', $this->serverType])
                ->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'layer_group', $this->layer_group]);

        return $dataProvider;
    }

}
