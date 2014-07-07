<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Account;

/**
 * AccountSearch represents the model behind the search form about `common\models\Account`.
 */
class AccountSearch extends Account
{
	public $balance_from;
	public $summary_charge_from;
	public $booking_charge_from;
	public $ticket_charge_from;
	public $seat_charge_from;
	public $sms_charge_from;
	public $annual_charge_from;
	public $rate_from;
	public $created_from;
		
	public $balance_to;
	public $summary_charge_to;
	public $booking_charge_to;
	public $ticket_charge_to;
	public $seat_charge_to;
	public $sms_charge_to;
	public $annual_charge_to;
	public $rate_to;
	public $created_to;

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
