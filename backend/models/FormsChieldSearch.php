<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FormsChield;

/**
 * FormsChieldSearch represents the model behind the search form about `app\models\FormsChield`.
 */
class FormsChieldSearch extends FormsChield
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'form_id'], 'integer'],
            [['template', 'sqlselect', 'sqlinsert', 'sqlupdate', 'sqldelete'], 'safe'],
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
        $query = FormsChield::find();

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
            'form_id' => $_GET['id'],
        ]);

        $query->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'sqlselect', $this->sqlselect])
            ->andFilterWhere(['like', 'sqlinsert', $this->sqlinsert])
            ->andFilterWhere(['like', 'sqlupdate', $this->sqlupdate])
            ->andFilterWhere(['like', 'sqldelete', $this->sqldelete]);

        return $dataProvider;
    }
}
