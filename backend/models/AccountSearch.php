<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Account;

/**
 * AccountSearch represents the model behind the search form about `common\models\Account`.
 */
class AccountSearch extends Account
{
    public $from_annual_charge;
	public $to_annual_charge;
	public $from_balance;
	public $to_balance;
	public $from_booking_charge;
	public $to_booking_charge;
	public $from_rate;
	public $to_rate;
	public $from_seat_charge;
	public $to_seat_charge;
	public $from_sms_charge;
	public $to_sms_charge;
	public $from_summary_charge;
	public $to_summary_charge;
	public $from_ticket_charge;
	public $to_ticket_charge;
	
    public function rules()
    {
        return [
            [['id', 'from_id', 'to_id', 'user_id', 'from_user_id', 'to_user_id', 'address_id', 'from_address_id', 'to_address_id'], 'integer'],
			[['phone_work', 'from_phone_work', 'to_phone_work', 'created', 'from_created', 'to_created'], 'safe'],
			[['balance', 'from_balance', 'to_balance', 'summary_charge', 'from_summary_charge', 'to_summary_charge', 'booking_charge', 'from_booking_charge', 'to_booking_charge', 'ticket_charge', 'from_ticket_charge', 'to_ticket_charge', 'seat_charge', 'from_seat_charge', 'to_seat_charge', 'sms_charge', 'from_sms_charge', 'to_sms_charge', 'annual_charge', 'from_annual_charge', 'to_annual_charge', 'rate', 'from_rate', 'to_rate'], 'number'],
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

		$query->andFilterWhere(['like', 'address_id', $this->address_id]);
		$query->andFilterWhere(['>=', 'from_annual_charge', $this->from_annual_charge]);
		$query->andFilterWhere(['<=', 'to_annual_charge', $this->to_annual_charge]);
		$query->andFilterWhere(['>=', 'from_balance', $this->from_balance]);
		$query->andFilterWhere(['<=', 'to_balance', $this->to_balance]);
		$query->andFilterWhere(['>=', 'from_booking_charge', $this->from_booking_charge]);
		$query->andFilterWhere(['<=', 'to_booking_charge', $this->to_booking_charge]);
		$query->andFilterWhere(['like', 'phone_work', $this->phone_work]);
		$query->andFilterWhere(['>=', 'from_rate', $this->from_rate]);
		$query->andFilterWhere(['<=', 'to_rate', $this->to_rate]);
		$query->andFilterWhere(['>=', 'from_seat_charge', $this->from_seat_charge]);
		$query->andFilterWhere(['<=', 'to_seat_charge', $this->to_seat_charge]);
		$query->andFilterWhere(['>=', 'from_sms_charge', $this->from_sms_charge]);
		$query->andFilterWhere(['<=', 'to_sms_charge', $this->to_sms_charge]);
		$query->andFilterWhere(['>=', 'from_summary_charge', $this->from_summary_charge]);
		$query->andFilterWhere(['<=', 'to_summary_charge', $this->to_summary_charge]);
		$query->andFilterWhere(['>=', 'from_ticket_charge', $this->from_ticket_charge]);
		$query->andFilterWhere(['<=', 'to_ticket_charge', $this->to_ticket_charge]);
		$query->andFilterWhere(['like', 'user_id', $this->user_id]);
		
        return $dataProvider;
    }
}
