<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToEventToResourceToCustomField;

/**
 * SummaryToEventToResourceToCustomFieldSearch represents the model behind the search form about `common\models\SummaryToEventToResourceToCustomField`.
 */
class SummaryToEventToResourceToCustomFieldSearch extends SummaryToEventToResourceToCustomField
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'summary_id', 'event_to_resource_to_custom_field_id'], 'integer'],
            [['custom_value'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToEventToResourceToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'summary_id' => $this->summary_id,
            'event_to_resource_to_custom_field_id' => $this->event_to_resource_to_custom_field_id,
        ]);

        $query->andFilterWhere(['like', 'custom_value', $this->custom_value]);

        return $dataProvider;
    }
}
