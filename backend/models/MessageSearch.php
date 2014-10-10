<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Message;

/**
 * MessageSearch represents the model behind the search form about `common\models\Message`.
 */
class MessageSearch extends Message
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Message::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('email_html', $this->email_html);
		$query->andFilterGoogleStyle('email_subject', $this->email_subject);
		$query->andFilterGoogleStyle('sms_text', $this->sms_text);
		
        return $dataProvider;
    }
}
