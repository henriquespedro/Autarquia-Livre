<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Appoptions;

/**
 * AppoptionsSearch represents the model behind the search form about `app\models\Appoptions`.
 */
class AppoptionsSearch extends Appoptions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ldap_port', 'smtp_port'], 'integer'],
            [['server_url', 'manual_url', 'proxy', 'domain', 'ldap', 'smtp_host', 'smtp_username', 'smtp_password'], 'safe'],
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
        $query = Appoptions::find();

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
            'ldap_port' => $this->ldap_port,
            'smtp_port' => $this->smtp_port,
        ]);

        $query->andFilterWhere(['like', 'server_url', $this->server_url])
            ->andFilterWhere(['like', 'manual_url', $this->manual_url])
            ->andFilterWhere(['like', 'proxy', $this->proxy])
            ->andFilterWhere(['like', 'domain', $this->domain])
            ->andFilterWhere(['like', 'ldap', $this->ldap])
            ->andFilterWhere(['like', 'smtp_host', $this->smtp_host])
            ->andFilterWhere(['like', 'smtp_username', $this->smtp_username])
            ->andFilterWhere(['like', 'smtp_password', $this->smtp_password]);

        return $dataProvider;
    }
}
