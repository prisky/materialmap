<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToPercentPromotion;

/**
 * SummaryToPercentPromotionSearch represents the model behind the search form about `common\models\SummaryToPercentPromotion`.
 */
class SummaryToPercentPromotionSearch extends SummaryToPercentPromotion
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToPercentPromotion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterWhere(['percent_promotion_id' => $this->percent_promotion_id]);
		
        return $dataProvider;
    }
}
