<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Summary;

/**
 * SummarySearch represents the model behind the search form about `common\models\Summary`.
 */
class SummarySearch extends Summary
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Summary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'created' => $this->created,
        ]);

        return $dataProvider;
    }
}
