<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Level;

/**
 * LevelSearch represents the model behind the search form about `common\models\Level`.
 */
class LevelSearch extends Level
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Level::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		
        return $dataProvider;
    }
}
