<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToPromotion;

/**
 * SummaryToPromotionSearch represents the model behind the search form about `common\models\SummaryToPromotion`.
 */
class SummaryToPromotionSearch extends SummaryToPromotion
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = SummaryToPromotion::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['promotion_id' => $this->promotion_id]);

        return $dataProvider;
    }
}
