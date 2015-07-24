<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdminUsers;

/**
 * AdminUsersSearch represents the model behind the search form about `app\models\AdminUsers`.
 */
class AdminUsersSearch extends AdminUsers {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status',], 'integer'],
            [['username', 'password', 'password_hash', 'email'], 'string'],
            [['create_date'], 'safe']
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
        $query = AdminUsers::find();

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
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'password_hash', $this->password_hash]);

        return $dataProvider;
    }

}
