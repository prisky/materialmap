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
            [['id', 'account_id', 'survey_to_custom_field_id'], 'integer'],
            [['custom_value', 'created'], 'safe'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'survey_to_custom_field_id' => $this->survey_to_custom_field_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'custom_value', $this->custom_value]);

        return $dataProvider;
    }
}
