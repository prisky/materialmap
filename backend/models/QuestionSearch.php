<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `common\models\Question`.
 */
class QuestionSearch extends Question
{
    public $from_offer;
	public $to_offer;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Question::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['answer' => $this->answer]);
		$query->andFilterWhere(['bid_id' => $this->bid_id]);
		$query->andFilterGoogleStyle('comment', $this->comment);
		if(!is_null($this->from_offer) && $this->from_offer != '') $query->andWhere('`offer` >= :from_offer', [':from_offer' => $this->from_offer]);
		if(!is_null($this->to_offer) && $this->to_offer != '') $query->andWhere('`offer` <= :to_offer', [':to_offer' => $this->to_offer]);
		
        return $dataProvider;
    }
}
