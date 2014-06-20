<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `common\models\Question`.
 */
class QuestionSearch extends Question
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'bid_id', 'answer'], 'integer'],
            [['comment', 'created'], 'safe'],
            [['offer'], 'number'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Question::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'offer' => $this->offer,
            'created' => $this->created,
            'bid_id' => $this->bid_id,
            'answer' => $this->answer,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
