<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Forms;

/**
 * FormsSearch represents the model behind the search form about `app\models\Forms`.
 */
class FormsSearch extends Forms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'viewer_id', 'setOrder'], 'integer'],
            [['name', 'description', 'html_template', 'sql_select', 'sql_insert', 'sql_update', 'sql_delete', 'icon', 'chage_data'], 'safe'],
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
        $query = Forms::find();

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
            ->andFilterWhere(['like', 'html_template', $this->html_template])
            ->andFilterWhere(['like', 'sql_select', $this->sql_select])
            ->andFilterWhere(['like', 'sql_insert', $this->sql_insert])
            ->andFilterWhere(['like', 'sql_update', $this->sql_update])
            ->andFilterWhere(['like', 'sql_delete', $this->sql_delete])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
