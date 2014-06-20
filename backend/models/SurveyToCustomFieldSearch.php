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
            [['id', 'account_id', 'survey_id', 'custom_field_id', 'deleted'], 'integer'],
            [['order'], 'number'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'survey_id' => $this->survey_id,
            'custom_field_id' => $this->custom_field_id,
            'order' => $this->order,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
