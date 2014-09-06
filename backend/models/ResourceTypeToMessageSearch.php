<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\ResourceTypeToMessage;

/**
 * ResourceTypeToMessageSearch represents the model behind the search form about `common\models\ResourceTypeToMessage`.
 */
class ResourceTypeToMessageSearch extends ResourceTypeToMessage
{
    
    public function rules()
    {
        return [
            [['email_message', 'email_subject', 'sms_message'], 'safe'],
			[['message_id', 'resource_type_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = ResourceTypeToMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('email_message', $this->email_message);
		$query->andFilterGoogleStyle('email_subject', $this->email_subject);
		$query->andFilterWhere(['message_id' => $this->message_id]);
		$query->andFilterWhere(['resource_type_id' => $this->resource_type_id]);
		$query->andFilterGoogleStyle('sms_message', $this->sms_message);
		
        return $dataProvider;
    }
}
