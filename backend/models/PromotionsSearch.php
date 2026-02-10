<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Promotions;

/**
 * PromotionsSeacrh represents the model behind the search form of `common\models\Promotions`.
 */
class PromotionsSearch extends Promotions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'balance', 'created_at', 'updated_at'], 'integer'],
            [['bookie_name', 'bookie_link', 'login', 'password', 'phone', 'full_name', 'social_link', 'comment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Promotions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'balance' => $this->balance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'bookie_name', $this->bookie_name])
            ->andFilterWhere(['like', 'bookie_link', $this->bookie_link])
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'social_link', $this->social_link])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
