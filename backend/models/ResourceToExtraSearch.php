<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToExtra;

/**
 * ResourceToExtraSearch represents the model behind the search form about `common\models\ResourceToExtra`.
 */
class ResourceToExtraSearch extends ResourceToExtra
{
    
    public function rules()
    {
        return [
            [['extra_id', 'resource_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceToExtra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['extra_id' => $this->extra_id]);
		$query->andFilterWhere(['resource_id' => $this->resource_id]);
		
        return $dataProvider;
    }
}
