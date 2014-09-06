<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceTypeToCustomField;

/**
 * ResourceTypeToCustomFieldSearch represents the model behind the search form about `common\models\ResourceTypeToCustomField`.
 */
class ResourceTypeToCustomFieldSearch extends ResourceTypeToCustomField
{
    
    public function rules()
    {
        return [
            [['custom_field_id', 'resource_type_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceTypeToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['custom_field_id' => $this->custom_field_id]);
		$query->andFilterWhere(['resource_type_id' => $this->resource_type_id]);
		
        return $dataProvider;
    }
}
