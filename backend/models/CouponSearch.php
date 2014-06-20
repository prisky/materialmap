<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Coupon;

/**
 * CouponSearch represents the model behind the search form about `common\models\Coupon`.
 */
class CouponSearch extends Coupon
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'reseller_id'], 'integer'],
            [['uniqueid', 'expiry', 'created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Coupon::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'reseller_id' => $this->reseller_id,
            'expiry' => $this->expiry,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'uniqueid', $this->uniqueid]);

        return $dataProvider;
    }
}
