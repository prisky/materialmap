<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Extra;

/**
 * ExtraSearch represents the model behind the search form about `common\models\Extra`.
 */
class ExtraSearch extends Extra
{
    public $from_mandatory;
	public $to_mandatory;
	
    public function rules()
    {
        return [
            [['mandatory'], 'boolean'],
			[['maximum', 'minimum', 'name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Extra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_mandatory) && $this->from_mandatory != '') $query->andWhere('`mandatory` >= :from_mandatory', [':from_mandatory' => $this->from_mandatory]);
		if(!is_null($this->to_mandatory) && $this->to_mandatory != '') $query->andWhere('`mandatory` <= :to_mandatory', [':to_mandatory' => $this->to_mandatory]);
		$query->andFilterGoogleStyle('maximum', $this->maximum);
		$query->andFilterGoogleStyle('minimum', $this->minimum);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
