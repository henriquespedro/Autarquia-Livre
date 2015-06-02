<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewerGroup;

/**
 * ViewerGroupSearch represents the model behind the search form about `app\models\ViewerGroup`.
 */
class ViewerGroupSearch extends ViewerGroup {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'viewer_id', 'group_id'], 'integer'],
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
        $query = ViewerGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if (isset($_GET['viewer_id'])) {
            $viewer_id = $_GET['viewer_id'];
        } else {
            $viewer_id = $this->viewer_id;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'viewer_id' => $viewer_id,
            'group_id' => $this->group_id,
        ]);

        return $dataProvider;
    }

}
