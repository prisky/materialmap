<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyResult;

/**
 * SurveyResultSearch represents the model behind the search form about `common\models\SurveyResult`.
 */
class SurveyResultSearch extends SurveyResult
{
    
    public function rules()
    {
        return [
            [['custom_value'], 'safe'],
			[['survey_to_custom_field_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyResult::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['survey_to_custom_field_id' => $this->survey_to_custom_field_id]);
		
        return $dataProvider;
    }
}
