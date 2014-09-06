<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventTypeToResourceTypeToCustomField;

/**
 * EventTypeToResourceTypeToCustomFieldSearch represents the model behind the search form about `common\models\EventTypeToResourceTypeToCustomField`.
 */
class EventTypeToResourceTypeToCustomFieldSearch extends EventTypeToResourceTypeToCustomField
{
    
    public function rules()
    {
        return [
            [['event_type_id', 'resource_type_to_custom_field_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventTypeToResourceTypeToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['event_type_id' => $this->event_type_id]);
		$query->andFilterWhere(['resource_type_to_custom_field_id' => $this->resource_type_to_custom_field_id]);
		
        return $dataProvider;
    }
}
