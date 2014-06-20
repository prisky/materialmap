<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToAffiliateCategory;

/**
 * AccountToAffiliateCategorySearch represents the model behind the search form about `common\models\AccountToAffiliateCategory`.
 */
class AccountToAffiliateCategorySearch extends AccountToAffiliateCategory
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'affiliate_category_id'], 'integer'],
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
        $query = AccountToAffiliateCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'affiliate_category_id' => $this->affiliate_category_id,
            'rate' => $this->rate,
        ]);

        return $dataProvider;
    }
}
