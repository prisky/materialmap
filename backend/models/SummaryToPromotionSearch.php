<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToPromotion;

/**
 * SummaryToPromotionSearch represents the model behind the search form about `common\models\SummaryToPromotion`.
 */
class SummaryToPromotionSearch extends SummaryToPromotion
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'summary_id', 'promotion_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToPromotion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'summary_id' => $this->summary_id,
            'promotion_id' => $this->promotion_id,
        ]);

        return $dataProvider;
    }
}
