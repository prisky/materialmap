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
            [['id', 'account_id', 'ticket_id', 'event_to_resource_to_custom_field_id'], 'integer'],
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
        $query = TicketToEventToResourceToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'ticket_id' => $this->ticket_id,
            'event_to_resource_to_custom_field_id' => $this->event_to_resource_to_custom_field_id,
        ]);

        $query->andFilterWhere(['like', 'custom_value', $this->custom_value]);

        return $dataProvider;
    }
}
