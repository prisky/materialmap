<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Column;

/**
 * ColumnSearch represents the model behind the search form about `common\models\Column`.
 */
class ColumnSearch extends Column
{
    
    public function rules()
    {
        return [
            [['help', 'label', 'name'], 'safe'],
			[['model_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Column::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('help', $this->help);
		$query->andFilterGoogleStyle('label', $this->label);
		$query->andFilterWhere(['model_id' => $this->model_id]);
		$query->andFilterGoogleStyle('name', $this->name);
		
        return $dataProvider;
    }
}
