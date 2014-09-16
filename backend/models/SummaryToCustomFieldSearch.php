<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToCustomField;

/**
 * SummaryToCustomFieldSearch represents the model behind the search form about `common\models\SummaryToCustomField`.
 */
class SummaryToCustomFieldSearch extends SummaryToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_field_id', 'field_set_id'], 'integer'],
			[['custom_value'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['field_set_id' => $this->field_set_id]);
		
        return $dataProvider;
    }
}
