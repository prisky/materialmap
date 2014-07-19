<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\EventToResourceToExtra;

/**
 * EventToResourceToExtraSearch represents the model behind the search form about `common\models\EventToResourceToExtra`.
 */
class EventToResourceToExtraSearch extends EventToResourceToExtra
{
    
    public function rules()
    {
        return [
            [['resource_to_extra_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = EventToResourceToExtra::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterWhere(['resource_to_extra_id' => $this->resource_to_extra_id]);
		
        return $dataProvider;
    }
}
