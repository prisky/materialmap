<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ItemGroup;

/**
 * ItemGroupSearch represents the model behind the search form about `common\models\ItemGroup`.
 */
class ItemGroupSearch extends ItemGroup
{
    
    public function rules()
    {
        return [
            [['name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ItemGroup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
