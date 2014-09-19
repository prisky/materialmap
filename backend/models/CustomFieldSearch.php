<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CustomField;

/**
 * CustomFieldSearch represents the model behind the search form about `common\models\CustomField`.
 */
class CustomFieldSearch extends CustomField
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = CustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['account_id' => $this->account_id]);
		$query->andFilterGoogleStyle('comment', $this->comment);
		$query->andFilterWhere(['data_type' => $this->data_type]);
		$query->andFilterGoogleStyle('label', $this->label);
		$query->andFilterGoogleStyle('validation_error', $this->validation_error);
		$query->andFilterGoogleStyle('validation_text', $this->validation_text);
		$query->andFilterWhere(['validation_type' => $this->validation_type]);
		
        return $dataProvider;
    }
}
