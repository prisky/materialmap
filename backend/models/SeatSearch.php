<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Seat;

/**
 * SeatSearch represents the model behind the search form about `common\models\Seat`.
 */
class SeatSearch extends Seat
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'resource_id', 'seat_type_id', 'root', 'lft', 'rgt', 'level', 'x', 'y', 'deleted'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Seat::find();

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
            'seat_type_id' => $this->seat_type_id,
            'root' => $this->root,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'level' => $this->level,
            'x' => $this->x,
            'y' => $this->y,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
