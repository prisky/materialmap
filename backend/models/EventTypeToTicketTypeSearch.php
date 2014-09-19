<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventTypeToTicketType;

/**
 * EventTypeToTicketTypeSearch represents the model behind the search form about `common\models\EventTypeToTicketType`.
 */
class EventTypeToTicketTypeSearch extends EventTypeToTicketType
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = EventTypeToTicketType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['ticket_type_id' => $this->ticket_type_id]);
		
        return $dataProvider;
    }
}
