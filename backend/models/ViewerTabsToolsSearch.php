<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ViewerTabsTools;

/**
 * ViewerTabsToolsSearch represents the model behind the search form about `app\models\ViewerTabsTools`.
 */
class ViewerTabsToolsSearch extends ViewerTabsTools
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tabs_id', 'tools_id'], 'integer'],
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
        $query = ViewerTabsTools::find();

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
            'tabs_id' => $_GET['id'],
//            'tabs_id' => $this->tabs_id,
            'tools_id' => $this->tools_id,
        ]);

        return $dataProvider;
    }
}
