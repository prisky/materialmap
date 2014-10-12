<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\BookingToCustomField;

/**
 * BookingToCustomFieldSearch represents the model behind the search form about `common\models\BookingToCustomField`.
 */
class BookingToCustomFieldSearch extends BookingToCustomField
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = BookingToCustomField::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('custom_value', $this->custom_value);

        return $dataProvider;
    }
}
