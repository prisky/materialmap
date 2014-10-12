<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MessageToMessageField;

/**
 * MessageToMessageFieldSearch represents the model behind the search form about `common\models\MessageToMessageField`.
 */
class MessageToMessageFieldSearch extends MessageToMessageField
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = MessageToMessageField::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['message_field_id' => $this->message_field_id]);

        return $dataProvider;
    }
}
