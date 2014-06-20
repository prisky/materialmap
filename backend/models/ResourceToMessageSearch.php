<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceToMessage;

/**
 * ResourceToMessageSearch represents the model behind the search form about `common\models\ResourceToMessage`.
 */
class ResourceToMessageSearch extends ResourceToMessage
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'resource_id', 'message_id'], 'integer'],
            [['email_message', 'sms_message', 'email_submect'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceToMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'resource_id' => $this->resource_id,
            'message_id' => $this->message_id,
        ]);

        $query->andFilterWhere(['like', 'email_message', $this->email_message])
            ->andFilterWhere(['like', 'sms_message', $this->sms_message])
            ->andFilterWhere(['like', 'email_submect', $this->email_submect]);

        return $dataProvider;
    }
}
