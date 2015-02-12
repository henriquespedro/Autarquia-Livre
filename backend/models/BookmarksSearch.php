<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bookmarks;

/**
 * BookmarksSearch represents the model behind the search form about `app\models\Bookmarks`.
 */
class BookmarksSearch extends Bookmarks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'viewer_id', 'setOrder'], 'integer'],
            [['name', 'description', 'x_coordinate', 'y_coordinate', 'chage_data'], 'safe'],
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
        $query = Bookmarks::find();

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
            'chage_data' => $this->chage_data,
            'setOrder' => $this->setOrder,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'x_coordinate', $this->x_coordinate])
            ->andFilterWhere(['like', 'y_coordinate', $this->y_coordinate]);

        return $dataProvider;
    }
}
