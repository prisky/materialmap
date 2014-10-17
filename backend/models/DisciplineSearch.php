<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Discipline;

/**
 * DisciplineSearch represents the model behind the search form about `common\models\Discipline`.
 */
class DisciplineSearch extends Discipline
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Discipline::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('discipline', $this->discipline);

        return $dataProvider;
    }
}
