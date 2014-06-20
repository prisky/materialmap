<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Navigation;

/**
 * NavigationSearch represents the model behind the search form about `common\models\Navigation`.
 */
class NavigationSearch extends Navigation
{
    public function rules()
    {
        return [
            [['id', 'parent', 'child', 'depth'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Navigation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent' => $this->parent,
            'child' => $this->child,
            'depth' => $this->depth,
        ]);

        return $dataProvider;
    }
}
