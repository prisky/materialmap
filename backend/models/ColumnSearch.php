<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Column;

/**
 * ColumnSearch represents the model behind the search form about `common\models\Column`.
 */
class ColumnSearch extends Column
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Column::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterGoogleStyle('label', $this->label);
        $query->andFilterGoogleStyle('help_html', $this->help_html);

        return $dataProvider;
    }
}
