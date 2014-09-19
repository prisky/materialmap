<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Model;

/**
 * ModelSearch represents the model behind the search form about `common\models\Model`.
 */
class ModelSearch extends Model
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Model::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('help', $this->help);
		$query->andFilterGoogleStyle('label', $this->label);
		$query->andFilterGoogleStyle('label_plural', $this->label_plural);
		
        return $dataProvider;
    }
}
