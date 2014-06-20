<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\PaypalSubCategory;

/**
 * PaypalSubCategorySearch represents the model behind the search form about `common\models\PaypalSubCategory`.
 */
class PaypalSubCategorySearch extends PaypalSubCategory
{
    public function rules()
    {
        return [
            [['id', 'paypal_category_id'], 'integer'],
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
        $query = PaypalSubCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'paypal_category_id' => $this->paypal_category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
