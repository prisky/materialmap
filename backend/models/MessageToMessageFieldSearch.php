<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MessageToMessageField;

/**
 * MessageToMessageFieldSearch represents the model behind the search form about `common\models\MessageToMessageField`.
 */
class MessageToMessageFieldSearch extends MessageToMessageField
{
    
    public function rules()
    {
        return [
            [['message_field_id', 'message_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = MessageToMessageField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['message_field_id' => $this->message_field_id]);
		$query->andFilterWhere(['message_id' => $this->message_id]);
		
        return $dataProvider;
    }
}
