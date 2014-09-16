<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\FieldSetToItemGroup;

/**
 * FieldSetToItemGroupSearch represents the model behind the search form about `common\models\FieldSetToItemGroup`.
 */
class FieldSetToItemGroupSearch extends FieldSetToItemGroup
{
    
    public function rules()
    {
        return [
            [['item_group_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = FieldSetToItemGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['item_group_id' => $this->item_group_id]);
		
        return $dataProvider;
    }
}
