<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\FieldSet;

/**
 * FieldSetSearch represents the model behind the search form about `common\models\FieldSet`.
 */
class FieldSetSearch extends FieldSet
{
    
    public function rules()
    {
        return [
            [['level'], 'string']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = FieldSet::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['level' => $this->level]);
		
        return $dataProvider;
    }
}
