<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Coupon;

/**
 * CouponSearch represents the model behind the search form about `common\models\Coupon`.
 */
class CouponSearch extends Coupon
{
    public $from_expiry;
	public $to_expiry;
	
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

        $this->setAttributes($params);

		if(!is_null($this->from_expiry) && $this->from_expiry != '') $query->andWhere('`expiry` >= :from_expiry', [':from_expiry' => $this->from_expiry]);
		if(!is_null($this->to_expiry) && $this->to_expiry != '') $query->andWhere('`expiry` <= :to_expiry', [':to_expiry' => $this->to_expiry]);
		$query->andFilterWhere(['reseller_id' => $this->reseller_id]);
		$query->andFilterGoogleStyle('uniqueid', $this->uniqueid);
		
        return $dataProvider;
    }
}
