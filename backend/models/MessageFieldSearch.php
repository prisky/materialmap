<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MessageField;

/**
 * MessageFieldSearch represents the model behind the search form about `common\models\MessageField`.
 */
class MessageFieldSearch extends MessageField
{
    
    public function rules()
    {
        return [
            [['comment', 'name'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = MessageField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('comment', $this->comment);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
