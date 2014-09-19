<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToCustomField;

/**
 * TicketToSeatToCustomFieldSearch represents the model behind the search form about `common\models\TicketToSeatToCustomField`.
 */
class TicketToSeatToCustomFieldSearch extends TicketToSeatToCustomField
{
    
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

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		$query->andFilterWhere(['ticket_to_seat_id' => $this->ticket_to_seat_id]);
		
        return $dataProvider;
    }
}
