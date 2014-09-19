<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MessageQueue;

/**
 * MessageQueueSearch represents the model behind the search form about `common\models\MessageQueue`.
 */
class MessageQueueSearch extends MessageQueue
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = MessageQueue::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		
        return $dataProvider;
    }
}
