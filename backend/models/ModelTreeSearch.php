<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ModelTree;

/**
 * ModelTreeSearch represents the model behind the search form about `common\models\ModelTree`.
 */
class ModelTreeSearch extends ModelTree
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = ModelTree::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		
        return $dataProvider;
    }
}
