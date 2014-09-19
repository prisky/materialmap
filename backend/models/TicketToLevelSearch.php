<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToLevel;

/**
 * TicketToLevelSearch represents the model behind the search form about `common\models\TicketToLevel`.
 */
class TicketToLevelSearch extends TicketToLevel
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		
        return $dataProvider;
    }
}
