<?php

namespace backend\components;

/**
 * Search is added to an active record model to represents the model behind a search form.
 */
trait Search
{

    public function rules()
    {
        return [
            [['id', 'user_id', 'address_id'], 'integer'],
            [['phone_work', 'created'], 'safe'],
            [['balance', 'summary_charge', 'booking_charge', 'ticket_charge', 'seat_charge', 'sms_charge', 'annual_charge', 'rate'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = static::find();

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'address_id' => $this->address_id,
            'balance' => $this->balance,
            'summary_charge' => $this->summary_charge,
            'booking_charge' => $this->booking_charge,
            'ticket_charge' => $this->ticket_charge,
            'seat_charge' => $this->seat_charge,
            'sms_charge' => $this->sms_charge,
            'annual_charge' => $this->annual_charge,
            'rate' => $this->rate,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'phone_work', $this->phone_work]);

        return $dataProvider;
    }

}
