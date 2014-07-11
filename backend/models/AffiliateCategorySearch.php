<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AffiliateCategory;

/**
 * AffiliateCategorySearch represents the model behind the search form about `common\models\AffiliateCategory`.
 */
class AffiliateCategorySearch extends AffiliateCategory
{
    public $from_level;
	public $to_level;
	public $from_lft;
	public $to_lft;
	public $from_rgt;
	public $to_rgt;
	public $from_root;
	public $to_root;
	
    public function rules()
    {
        return [
            [['level', 'lft', 'rgt', 'root'], 'integer'],
			[['name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AffiliateCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_level) && $this->from_level != '') $query->andWhere('`level` >= :from_level', [':from_level' => $this->from_level]);
		if(!is_null($this->to_level) && $this->to_level != '') $query->andWhere('`level` <= :to_level', [':to_level' => $this->to_level]);
		if(!is_null($this->from_lft) && $this->from_lft != '') $query->andWhere('`lft` >= :from_lft', [':from_lft' => $this->from_lft]);
		if(!is_null($this->to_lft) && $this->to_lft != '') $query->andWhere('`lft` <= :to_lft', [':to_lft' => $this->to_lft]);
		$query->andFilterWhere(['like', 'name', $this->name]);
		if(!is_null($this->from_rgt) && $this->from_rgt != '') $query->andWhere('`rgt` >= :from_rgt', [':from_rgt' => $this->from_rgt]);
		if(!is_null($this->to_rgt) && $this->to_rgt != '') $query->andWhere('`rgt` <= :to_rgt', [':to_rgt' => $this->to_rgt]);
		if(!is_null($this->from_root) && $this->from_root != '') $query->andWhere('`root` >= :from_root', [':from_root' => $this->from_root]);
		if(!is_null($this->to_root) && $this->to_root != '') $query->andWhere('`root` <= :to_root', [':to_root' => $this->to_root]);
		
        return $dataProvider;
    }
}
