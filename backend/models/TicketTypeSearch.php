<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketType;

/**
 * TicketTypeSearch represents the model behind the search form about `common\models\TicketType`.
 */
class TicketTypeSearch extends TicketType
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'seats', 'event_max', 'booking_max', 'deleted'], 'integer'],
            [['name', 'comment'], 'safe'],
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
        $query = TicketType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'seats' => $this->seats,
            'amount' => $this->amount,
            'event_max' => $this->event_max,
            'booking_max' => $this->booking_max,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
