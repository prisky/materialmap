<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Extra;

/**
 * ExtraSearch represents the model behind the search form about `common\models\Extra`.
 */
class ExtraSearch extends Extra
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'mandatory', 'minimum', 'maximum', 'deleted'], 'integer'],
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
        $query = Extra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'mandatory' => $this->mandatory,
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
