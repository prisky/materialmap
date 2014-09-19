<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PaypalSubCategory;

/**
 * PaypalSubCategorySearch represents the model behind the search form about `common\models\PaypalSubCategory`.
 */
class PaypalSubCategorySearch extends PaypalSubCategory
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = PaypalSubCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterWhere(['paypal_category_id' => $this->paypal_category_id]);
		
        return $dataProvider;
    }
}
