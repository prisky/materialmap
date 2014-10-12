<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToAffiliateCategory;

/**
 * AccountToAffiliateCategorySearch represents the model behind the search form about `common\models\AccountToAffiliateCategory`.
 */
class AccountToAffiliateCategorySearch extends AccountToAffiliateCategory
{
    public $from_rate;
    public $to_rate;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = AccountToAffiliateCategory::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['affiliate_category_id' => $this->affiliate_category_id]);
        if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
        if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);

        return $dataProvider;
    }
}
