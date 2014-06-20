<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Message;

/**
 * MessageSearch represents the model behind the search form about `common\models\Message`.
 */
class MessageSearch extends Message
{
    public function rules()
    {
        return [
            [['id', 'system'], 'integer'],
            [['name', 'email_html', 'sms_text', 'email_subject'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Message::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'system' => $this->system,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email_html', $this->email_html])
            ->andFilterWhere(['like', 'sms_text', $this->sms_text])
            ->andFilterWhere(['like', 'email_subject', $this->email_subject]);

        return $dataProvider;
    }
}
