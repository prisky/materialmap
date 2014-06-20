<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Resource;

/**
 * ResourceSearch represents the model behind the search form about `common\models\Resource`.
 */
class ResourceSearch extends Resource
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'deleted'], 'integer'],
            [['name', 'comment'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Resource::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
