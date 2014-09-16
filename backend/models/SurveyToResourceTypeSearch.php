<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyToResourceType;

/**
 * SurveyToResourceTypeSearch represents the model behind the search form about `common\models\SurveyToResourceType`.
 */
class SurveyToResourceTypeSearch extends SurveyToResourceType
{
    
    public function rules()
    {
        return [
            [['resource_type_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyToResourceType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['resource_type_id' => $this->resource_type_id]);
		
        return $dataProvider;
    }
}