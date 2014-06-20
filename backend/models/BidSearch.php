<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Bid;

/**
 * BidSearch represents the model behind the search form about `common\models\Bid`.
 */
class BidSearch extends Bid
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'question_id'], 'integer'],
            [['offer'], 'number'],
            [['comment', 'deadline', 'updated'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Bid::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'question_id' => $this->question_id,
            'offer' => $this->offer,
            'deadline' => $this->deadline,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
