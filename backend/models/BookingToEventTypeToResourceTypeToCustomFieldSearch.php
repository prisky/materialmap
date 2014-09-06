<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\BookingToEventTypeToResourceTypeToCustomField;

/**
 * BookingToEventTypeToResourceTypeToCustomFieldSearch represents the model behind the search form about `common\models\BookingToEventTypeToResourceTypeToCustomField`.
 */
class BookingToEventTypeToResourceTypeToCustomFieldSearch extends BookingToEventTypeToResourceTypeToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_value'], 'safe'],
			[['event_type_to_resource_type_to_custom_field_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = BookingToEventTypeToResourceTypeToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['event_type_to_resource_type_to_custom_field_id' => $this->event_type_to_resource_type_to_custom_field_id]);
		
        return $dataProvider;
    }
}
