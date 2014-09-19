<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToSeatToLevel;

/**
 * TicketToSeatToLevelSearch represents the model behind the search form about `common\models\TicketToSeatToLevel`.
 */
class TicketToSeatToLevelSearch extends TicketToSeatToLevel
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToSeatToLevel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		
        return $dataProvider;
    }
}
