<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Manufacturer;

/**
 * ManufacturerSearch represents the model behind the search form about `common\models\Manufacturer`.
 */
class ManufacturerSearch extends Manufacturer
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Manufacturer::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);

        return $dataProvider;
    }
}
