<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Event;

/**
 * EventSearch represents the model behind the search form about `common\models\Event`.
 */
class EventSearch extends Event
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'event_detail_id'], 'integer'],
            [['start', 'end', 'status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Event::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'event_detail_id' => $this->event_detail_id,
            'start' => $this->start,
            'end' => $this->end,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
