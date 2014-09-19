<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\FieldSetToCustomField;

/**
 * FieldSetToCustomFieldSearch represents the model behind the search form about `common\models\FieldSetToCustomField`.
 */
class FieldSetToCustomFieldSearch extends FieldSetToCustomField
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = FieldSetToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		
        return $dataProvider;
    }
}
