<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SurveyToResource;

/**
 * SurveyToResourceSearch represents the model behind the search form about `common\models\SurveyToResource`.
 */
class SurveyToResourceSearch extends SurveyToResource
{
    
    public function rules()
    {
        return [
            [['resource_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SurveyToResource::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['resource_id' => $this->resource_id]);
		
        return $dataProvider;
    }
}
