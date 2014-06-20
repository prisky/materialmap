<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Newsletter;

/**
 * NewsletterSearch represents the model behind the search form about `common\models\Newsletter`.
 */
class NewsletterSearch extends Newsletter
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
            [['subject', 'content', 'sent'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Newsletter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'sent' => $this->sent,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
