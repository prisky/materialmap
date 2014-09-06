<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceTypeToExtra;

/**
 * ResourceTypeToExtraSearch represents the model behind the search form about `common\models\ResourceTypeToExtra`.
 */
class ResourceTypeToExtraSearch extends ResourceTypeToExtra
{
    
    public function rules()
    {
        return [
            [['extra_id', 'resource_type_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceTypeToExtra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['extra_id' => $this->extra_id]);
		$query->andFilterWhere(['resource_type_id' => $this->resource_type_id]);
		
        return $dataProvider;
    }
}
