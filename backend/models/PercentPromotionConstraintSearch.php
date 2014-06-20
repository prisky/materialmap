<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PercentPromotionConstraint;

/**
 * PercentPromotionConstraintSearch represents the model behind the search form about `common\models\PercentPromotionConstraint`.
 */
class PercentPromotionConstraintSearch extends PercentPromotionConstraint
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'percent_promotion_id'], 'integer'],
            [['invalid_from', 'invalid_to'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = PercentPromotionConstraint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'percent_promotion_id' => $this->percent_promotion_id,
            'invalid_from' => $this->invalid_from,
            'invalid_to' => $this->invalid_to,
        ]);

        return $dataProvider;
    }
}
