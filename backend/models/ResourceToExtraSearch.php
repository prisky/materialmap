<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToExtra;

/**
 * ResourceToExtraSearch represents the model behind the search form about `common\models\ResourceToExtra`.
 */
class ResourceToExtraSearch extends ResourceToExtra
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'resource_id', 'extra_id', 'deleted'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceToExtra::find();

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
            'extra_id' => $this->extra_id,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
