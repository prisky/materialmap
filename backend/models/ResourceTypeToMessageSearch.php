<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceTypeToMessage;

/**
 * ResourceTypeToMessageSearch represents the model behind the search form about `common\models\ResourceTypeToMessage`.
 */
class ResourceTypeToMessageSearch extends ResourceTypeToMessage
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = ResourceTypeToMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('email_message', $this->email_message);
		$query->andFilterGoogleStyle('email_subject', $this->email_subject);
		$query->andFilterWhere(['message_id' => $this->message_id]);
		$query->andFilterGoogleStyle('sms_message', $this->sms_message);
		
        return $dataProvider;
    }
}
