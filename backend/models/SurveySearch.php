<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Survey;

/**
 * SurveySearch represents the model behind the search form about `common\models\Survey`.
 */
class SurveySearch extends Survey
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Survey::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('comment', $this->comment);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
