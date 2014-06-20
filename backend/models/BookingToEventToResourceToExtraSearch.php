<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\BookingToEventToResourceToExtra;

/**
 * BookingToEventToResourceToExtraSearch represents the model behind the search form about `common\models\BookingToEventToResourceToExtra`.
 */
class BookingToEventToResourceToExtraSearch extends BookingToEventToResourceToExtra
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'event_to_resource_to_extra_id', 'booking_id', 'quantity'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = BookingToEventToResourceToExtra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'event_to_resource_to_extra_id' => $this->event_to_resource_to_extra_id,
            'booking_id' => $this->booking_id,
            'amount' => $this->amount,
            'quantity' => $this->quantity,
        ]);

        return $dataProvider;
    }
}
