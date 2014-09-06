<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Resource;

/**
 * ResourceSearch represents the model behind the search form about `common\models\Resource`.
 */
class ResourceSearch extends Resource
{
    
    public function rules()
    {
        return [
            [['name'], 'safe'],
			[['resource_type_id'], 'integer']        ];
    }

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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterWhere(['resource_type_id' => $this->resource_type_id]);
		
        return $dataProvider;
    }
}
