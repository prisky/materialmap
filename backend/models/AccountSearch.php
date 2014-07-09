<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Account;

/**
 * AccountSearch represents the model behind the search form about `common\models\Account`.
 */
class AccountSearch extends Account
{
	public $from_balance;
	public $from_summary_charge;
	public $from_booking_charge;
	public $from_ticket_charge;
	public $from_seat_charge;
	public $from_sms_charge;
	public $from_annual_charge;
	public $from_rate;
	public $from_created;
		
	public $to_balance;
	public $to_summary_charge;
	public $to_booking_charge;
	public $to_ticket_charge;
	public $to_seat_charge;
	public $to_sms_charge;
	public $to_annual_charge;
	public $to_rate;
	public $to_created;

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
        $query = Account::find();

        $dataProvider = new ActiveDataProvider([
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
