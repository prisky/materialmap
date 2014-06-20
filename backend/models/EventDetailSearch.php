<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventDetail;

/**
 * EventDetailSearch represents the model behind the search form about `common\models\EventDetail`.
 */
class EventDetailSearch extends EventDetail
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'resource_id', 'seats_max', 'deposit_hours', 'seats_min', 'seats_min_hours'], 'integer'],
            [['name', 'private_note', 'tooltip'], 'safe'],
            [['deposit'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventDetail::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'resource_id' => $this->resource_id,
            'seats_max' => $this->seats_max,
            'deposit' => $this->deposit,
            'deposit_hours' => $this->deposit_hours,
            'seats_min' => $this->seats_min,
            'seats_min_hours' => $this->seats_min_hours,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'private_note', $this->private_note])
            ->andFilterWhere(['like', 'tooltip', $this->tooltip]);

        return $dataProvider;
    }
}
