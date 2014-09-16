<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventTypeToFieldSet;

/**
 * EventTypeToFieldSetSearch represents the model behind the search form about `common\models\EventTypeToFieldSet`.
 */
class EventTypeToFieldSetSearch extends EventTypeToFieldSet
{
    
    public function rules()
    {
        return [
            [['field_set_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventTypeToFieldSet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['field_set_id' => $this->field_set_id]);
		
        return $dataProvider;
    }
}