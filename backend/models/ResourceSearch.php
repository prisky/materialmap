<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Resource;

/**
 * ResourceSearch represents the model behind the search form about `common\models\Resource`.
 */
class ResourceSearch extends Resource
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Resource::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
