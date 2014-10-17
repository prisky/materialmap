<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AuthRule;

/**
 * AuthRuleSearch represents the model behind the search form about `common\models\AuthRule`.
 */
class AuthRuleSearch extends AuthRule
{
    public $from_created_at;
    public $to_created_at;
    public $from_updated_at;
    public $to_updated_at;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = AuthRule::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('data', $this->data);
        if(!is_null($this->from_created_at) && $this->from_created_at != '') $query->andWhere('`created_at` >= :from_created_at', [':from_created_at' => $this->from_created_at]);
        if(!is_null($this->to_created_at) && $this->to_created_at != '') $query->andWhere('`created_at` <= :to_created_at', [':to_created_at' => $this->to_created_at]);
        if(!is_null($this->from_updated_at) && $this->from_updated_at != '') $query->andWhere('`updated_at` >= :from_updated_at', [':from_updated_at' => $this->from_updated_at]);
        if(!is_null($this->to_updated_at) && $this->to_updated_at != '') $query->andWhere('`updated_at` <= :to_updated_at', [':to_updated_at' => $this->to_updated_at]);

        return $dataProvider;
    }
}
