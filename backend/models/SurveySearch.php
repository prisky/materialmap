<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Survey;

/**
 * SurveySearch represents the model behind the search form about `common\models\Survey`.
 */
class SurveySearch extends Survey
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['name', 'comment', 'deleted'], 'safe'],
        ];
    }

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

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'deleted', $this->deleted]);

        return $dataProvider;
    }
}
