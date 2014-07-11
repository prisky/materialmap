<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyToCustomField;

/**
 * SurveyToCustomFieldSearch represents the model behind the search form about `common\models\SurveyToCustomField`.
 */
class SurveyToCustomFieldSearch extends SurveyToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_field_id'], 'integer'],
			[['order'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterWhere(['like', 'order', $this->order]);
		
        return $dataProvider;
    }
}
