<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\QuestionThread;

/**
 * QuestionThreadSearch represents the model behind the search form about `common\models\QuestionThread`.
 */
class QuestionThreadSearch extends QuestionThread
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'question_id'], 'integer'],
            [['comment', 'created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = QuestionThread::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'question_id' => $this->question_id,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
