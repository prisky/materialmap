<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToCustomField;

/**
 * ResourceToCustomFieldSearch represents the model behind the search form about `common\models\ResourceToCustomField`.
 */
class ResourceToCustomFieldSearch extends ResourceToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_field_id', 'resource_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterWhere(['resource_id' => $this->resource_id]);
		
        return $dataProvider;
    }
}
