<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CustomField;

/**
 * CustomFieldSearch represents the model behind the search form about `common\models\CustomField`.
 */
class CustomFieldSearch extends CustomField
{
    public $from_allow_new;
	public $to_allow_new;
	public $from_mandatory;
	public $to_mandatory;
	
    public function rules()
    {
        return [
            [['allow_new', 'mandatory'], 'boolean'],
			[['comment', 'label', 'validation_error', 'validation_text'], 'safe'],
			[['data_type', 'validation_type'], 'number']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = CustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		if(!is_null($this->from_allow_new) && $this->from_allow_new != '') $query->andWhere('`allow_new` >= :from_allow_new', [':from_allow_new' => $this->from_allow_new]);
		if(!is_null($this->to_allow_new) && $this->to_allow_new != '') $query->andWhere('`allow_new` <= :to_allow_new', [':to_allow_new' => $this->to_allow_new]);
		$query->andFilterWhere(['like', 'comment', $this->comment]);
		$query->andFilterWhere(['data_type' => $this->data_type]);
		$query->andFilterWhere(['like', 'label', $this->label]);
		if(!is_null($this->from_mandatory) && $this->from_mandatory != '') $query->andWhere('`mandatory` >= :from_mandatory', [':from_mandatory' => $this->from_mandatory]);
		if(!is_null($this->to_mandatory) && $this->to_mandatory != '') $query->andWhere('`mandatory` <= :to_mandatory', [':to_mandatory' => $this->to_mandatory]);
		$query->andFilterWhere(['like', 'validation_error', $this->validation_error]);
		$query->andFilterWhere(['like', 'validation_text', $this->validation_text]);
		$query->andFilterWhere(['validation_type' => $this->validation_type]);
		
        return $dataProvider;
    }
}
