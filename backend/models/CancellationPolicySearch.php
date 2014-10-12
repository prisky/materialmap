<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CancellationPolicy;

/**
 * CancellationPolicySearch represents the model behind the search form about `common\models\CancellationPolicy`.
 */
class CancellationPolicySearch extends CancellationPolicy
{
    public $from_begin;
    public $to_begin;
    public $from_finish;
    public $to_finish;
    public $from_rate;
    public $to_rate;
    public $from_base_fee;
    public $to_base_fee;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = CancellationPolicy::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        if(!is_null($this->from_begin) && $this->from_begin != '') $query->andWhere('`begin` >= :from_begin', [':from_begin' => $this->from_begin]);
        if(!is_null($this->to_begin) && $this->to_begin != '') $query->andWhere('`begin` <= :to_begin', [':to_begin' => $this->to_begin]);
        if(!is_null($this->from_finish) && $this->from_finish != '') $query->andWhere('`finish` >= :from_finish', [':from_finish' => $this->from_finish]);
        if(!is_null($this->to_finish) && $this->to_finish != '') $query->andWhere('`finish` <= :to_finish', [':to_finish' => $this->to_finish]);
        $query->andFilterGoogleStyle('days', $this->days);
        if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
        if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
        if(!is_null($this->from_base_fee) && $this->from_base_fee != '') $query->andWhere('`base_fee` >= :from_base_fee', [':from_base_fee' => $this->from_base_fee]);
        if(!is_null($this->to_base_fee) && $this->to_base_fee != '') $query->andWhere('`base_fee` <= :to_base_fee', [':to_base_fee' => $this->to_base_fee]);

        return $dataProvider;
    }
}
