<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\TicketToCustomField;

/**
 * TicketToCustomFieldSearch represents the model behind the search form about `common\models\TicketToCustomField`.
 */
class TicketToCustomFieldSearch extends TicketToCustomField
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = TicketToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('custom_value', $this->custom_value);
		
        return $dataProvider;
    }
}
