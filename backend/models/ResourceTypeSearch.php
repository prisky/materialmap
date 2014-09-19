<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceType;

/**
 * ResourceTypeSearch represents the model behind the search form about `common\models\ResourceType`.
 */
class ResourceTypeSearch extends ResourceType
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('comment', $this->comment);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
