<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\QuestionThread;

/**
 * QuestionThreadSearch represents the model behind the search form about `common\models\QuestionThread`.
 */
class QuestionThreadSearch extends QuestionThread
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = QuestionThread::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('comment', $this->comment);
		
        return $dataProvider;
    }
}
