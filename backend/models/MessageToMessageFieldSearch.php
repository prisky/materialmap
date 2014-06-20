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
            [['id', 'message_id', 'message_field_id'], 'integer'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
            'message_id' => $this->message_id,
            'message_field_id' => $this->message_field_id,
        ]);

        return $dataProvider;
    }
}
