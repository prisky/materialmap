<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToEventToResourceToCustomField;

/**
 * TicketToEventToResourceToCustomFieldSearch represents the model behind the search form about `common\models\TicketToEventToResourceToCustomField`.
 */
class TicketToEventToResourceToCustomFieldSearch extends TicketToEventToResourceToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_value'], 'safe'],
			[['event_to_resource_to_custom_field_id', 'ticket_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToEventToResourceToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['event_to_resource_to_custom_field_id' => $this->event_to_resource_to_custom_field_id]);
		$query->andFilterWhere(['ticket_id' => $this->ticket_id]);
		
        return $dataProvider;
    }
}
