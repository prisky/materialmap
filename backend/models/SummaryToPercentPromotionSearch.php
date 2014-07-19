<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToPercentPromotion;

/**
 * SummaryToPercentPromotionSearch represents the model behind the search form about `common\models\SummaryToPercentPromotion`.
 */
class SummaryToPercentPromotionSearch extends SummaryToPercentPromotion
{
    
    public function rules()
    {
        return [
            [['percent_promotion_id'], 'integer']        ];
    }

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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['percent_promotion_id' => $this->percent_promotion_id]);
		
        return $dataProvider;
    }
}
