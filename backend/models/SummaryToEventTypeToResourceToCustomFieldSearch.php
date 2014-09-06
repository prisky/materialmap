<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SummaryToEventTypeToResourceToCustomField;

/**
 * SummaryToEventTypeToResourceToCustomFieldSearch represents the model behind the search form about `common\models\SummaryToEventTypeToResourceToCustomField`.
 */
class SummaryToEventTypeToResourceToCustomFieldSearch extends SummaryToEventTypeToResourceToCustomField
{
    
    public function rules()
    {
        return [
                    ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SummaryToEventTypeToResourceToCustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		
        return $dataProvider;
    }
}
