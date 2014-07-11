<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PaypalCategory;

/**
 * PaypalCategorySearch represents the model behind the search form about `common\models\PaypalCategory`.
 */
class PaypalCategorySearch extends PaypalCategory
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
        $query = PaypalCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['like', 'name', $this->name]);
		
        return $dataProvider;
    }
}
