<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToCustomField;

/**
 * SummaryToCustomFieldSearch represents the model behind the search form about `common\models\SummaryToCustomField`.
 */
class SummaryToCustomFieldSearch extends SummaryToCustomField
{
    
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

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		
        return $dataProvider;
    }
}
