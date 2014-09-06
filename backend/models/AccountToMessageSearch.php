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
            [['email_message', 'email_subject', 'sms_message'], 'safe'],
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

		$query->andFilterGoogleStyle('email_message', $this->email_message);
		$query->andFilterGoogleStyle('email_subject', $this->email_subject);
		$query->andFilterWhere(['message_id' => $this->message_id]);
		$query->andFilterGoogleStyle('sms_message', $this->sms_message);
		
        return $dataProvider;
    }
}
