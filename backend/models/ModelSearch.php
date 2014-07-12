<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Model;

/**
 * ModelSearch represents the model behind the search form about `common\models\Model`.
 */
class ModelSearch extends Model
{
    
    public function rules()
    {
        return [
            [['auth_item_name', 'help', 'label', 'label_plural'], 'safe']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Model::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('auth_item_name', $this->auth_item_name);
		$query->andFilterGoogleStyle('help', $this->help);
		$query->andFilterGoogleStyle('label', $this->label);
		$query->andFilterGoogleStyle('label_plural', $this->label_plural);
		
        return $dataProvider;
    }
}
