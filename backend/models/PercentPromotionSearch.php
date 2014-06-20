<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentPromotion;

/**
 * PercentPromotionSearch represents the model behind the search form about `common\models\PercentPromotion`.
 */
class PercentPromotionSearch extends PercentPromotion
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['rate'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = PercentPromotion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'rate' => $this->rate,
        ]);

        return $dataProvider;
    }
}
