<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AccountToMessage;

/**
 * AccountToMessageSearch represents the model behind the search form about `common\models\AccountToMessage`.
 */
class AccountToMessageSearch extends AccountToMessage
{
    
    public function rules()
    {
        return [
            [['email_message', 'email_submect', 'sms_message'], 'safe'],
			[['message_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AccountToMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['like', 'email_message', $this->email_message]);
		$query->andFilterWhere(['like', 'email_submect', $this->email_submect]);
		$query->andFilterWhere(['message_id' => $this->message_id]);
		$query->andFilterWhere(['like', 'sms_message', $this->sms_message]);
		
        return $dataProvider;
    }
}
