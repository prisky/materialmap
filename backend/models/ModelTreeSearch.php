<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ModelTree;

/**
 * ModelTreeSearch represents the model behind the search form about `common\models\ModelTree`.
 */
class ModelTreeSearch extends ModelTree
{
    public $from_depth;
    public $to_depth;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = ModelTree::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['parent' => $this->parent]);
        $query->andFilterWhere(['child' => $this->child]);
        if(!is_null($this->from_depth) && $this->from_depth != '') $query->andWhere('`depth` >= :from_depth', [':from_depth' => $this->from_depth]);
        if(!is_null($this->to_depth) && $this->to_depth != '') $query->andWhere('`depth` <= :to_depth', [':to_depth' => $this->to_depth]);

        return $dataProvider;
    }
}
