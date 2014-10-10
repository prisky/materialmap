<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MessageField;

/**
 * MessageFieldSearch represents the model behind the search form about `common\models\MessageField`.
 */
class MessageFieldSearch extends MessageField
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = MessageField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('comment', $this->comment);
		
        return $dataProvider;
    }
}
