<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToCustomField;

/**
 * TicketToSeatToCustomFieldSearch represents the model behind the search form about `common\models\TicketToSeatToCustomField`.
 */
class TicketToSeatToCustomFieldSearch extends TicketToSeatToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_field_id', 'event_type_id', 'field_set_id', 'ticket_to_seat_id'], 'integer'],
			[['custom_value'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeatToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['event_type_id' => $this->event_type_id]);
		$query->andFilterWhere(['field_set_id' => $this->field_set_id]);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
