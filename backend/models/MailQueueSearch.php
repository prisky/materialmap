<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MailQueue;

/**
 * MailQueueSearch represents the model behind the search form about `common\models\MailQueue`.
 */
class MailQueueSearch extends MailQueue
{
    public function rules()
    {
        return [
            [['id', 'to', 'from'], 'integer'],
            [['email_message', 'subject', 'created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = MailQueue::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'to' => $this->to,
            'from' => $this->from,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'email_message', $this->email_message])
            ->andFilterWhere(['like', 'subject', $this->subject]);

        return $dataProvider;
    }
}
