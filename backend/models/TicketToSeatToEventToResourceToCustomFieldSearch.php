<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToEventToResourceToCustomField;

/**
 * TicketToSeatToEventToResourceToCustomFieldSearch represents the model behind the search form about `common\models\TicketToSeatToEventToResourceToCustomField`.
 */
class TicketToSeatToEventToResourceToCustomFieldSearch extends TicketToSeatToEventToResourceToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_value'], 'safe'],
			[['event_to_resource_to_custom_field_id', 'ticket_to_seat_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeatToEventToResourceToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['like', 'custom_value', $this->custom_value]);
		$query->andFilterWhere(['event_to_resource_to_custom_field_id' => $this->event_to_resource_to_custom_field_id]);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
