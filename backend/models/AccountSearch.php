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
    public $to_balance;
    public $from_summary_charge;
    public $to_summary_charge;
    public $from_booking_charge;
    public $to_booking_charge;
    public $from_ticket_charge;
    public $to_ticket_charge;
    public $from_seat_charge;
    public $to_seat_charge;
    public $from_sms_charge;
    public $to_sms_charge;
    public $from_annual_charge;
    public $to_annual_charge;
    public $from_rate;
    public $to_rate;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Account::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['user_id' => $this->user_id]);
        $query->andFilterGoogleStyle('phone_work', $this->phone_work);
        if(!is_null($this->from_balance) && $this->from_balance != '') $query->andWhere('`balance` >= :from_balance', [':from_balance' => $this->from_balance]);
        if(!is_null($this->to_balance) && $this->to_balance != '') $query->andWhere('`balance` <= :to_balance', [':to_balance' => $this->to_balance]);
        if(!is_null($this->from_summary_charge) && $this->from_summary_charge != '') $query->andWhere('`summary_charge` >= :from_summary_charge', [':from_summary_charge' => $this->from_summary_charge]);
        if(!is_null($this->to_summary_charge) && $this->to_summary_charge != '') $query->andWhere('`summary_charge` <= :to_summary_charge', [':to_summary_charge' => $this->to_summary_charge]);
        if(!is_null($this->from_booking_charge) && $this->from_booking_charge != '') $query->andWhere('`booking_charge` >= :from_booking_charge', [':from_booking_charge' => $this->from_booking_charge]);
        if(!is_null($this->to_booking_charge) && $this->to_booking_charge != '') $query->andWhere('`booking_charge` <= :to_booking_charge', [':to_booking_charge' => $this->to_booking_charge]);
        if(!is_null($this->from_ticket_charge) && $this->from_ticket_charge != '') $query->andWhere('`ticket_charge` >= :from_ticket_charge', [':from_ticket_charge' => $this->from_ticket_charge]);
        if(!is_null($this->to_ticket_charge) && $this->to_ticket_charge != '') $query->andWhere('`ticket_charge` <= :to_ticket_charge', [':to_ticket_charge' => $this->to_ticket_charge]);
        if(!is_null($this->from_seat_charge) && $this->from_seat_charge != '') $query->andWhere('`seat_charge` >= :from_seat_charge', [':from_seat_charge' => $this->from_seat_charge]);
        if(!is_null($this->to_seat_charge) && $this->to_seat_charge != '') $query->andWhere('`seat_charge` <= :to_seat_charge', [':to_seat_charge' => $this->to_seat_charge]);
        if(!is_null($this->from_sms_charge) && $this->from_sms_charge != '') $query->andWhere('`sms_charge` >= :from_sms_charge', [':from_sms_charge' => $this->from_sms_charge]);
        if(!is_null($this->to_sms_charge) && $this->to_sms_charge != '') $query->andWhere('`sms_charge` <= :to_sms_charge', [':to_sms_charge' => $this->to_sms_charge]);
        if(!is_null($this->from_annual_charge) && $this->from_annual_charge != '') $query->andWhere('`annual_charge` >= :from_annual_charge', [':from_annual_charge' => $this->from_annual_charge]);
        if(!is_null($this->to_annual_charge) && $this->to_annual_charge != '') $query->andWhere('`annual_charge` <= :to_annual_charge', [':to_annual_charge' => $this->to_annual_charge]);
        if(!is_null($this->from_rate) && $this->from_rate != '') $query->andWhere('`rate` >= :from_rate', [':from_rate' => $this->from_rate]);
        if(!is_null($this->to_rate) && $this->to_rate != '') $query->andWhere('`rate` <= :to_rate', [':to_rate' => $this->to_rate]);
        $query->andFilterWhere(['optimisation' => $this->optimisation]);

        return $dataProvider;
    }
}
