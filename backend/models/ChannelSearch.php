<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Channel;

/**
 * ChannelSearch represents the model behind the search form about `common\models\Channel`.
 */
class ChannelSearch extends Channel
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Channel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
