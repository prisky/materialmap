<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Reminder;

/**
 * ReminderSearch represents the model behind the search form about `common\models\Reminder`.
 */
class ReminderSearch extends Reminder
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Reminder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('hours_prior', $this->hours_prior);
		
        return $dataProvider;
    }
}
