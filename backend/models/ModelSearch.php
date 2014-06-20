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
            [['id'], 'integer'],
            [['auth_item_name', 'label', 'label_plural', 'help'], 'safe'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'auth_item_name', $this->auth_item_name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'label_plural', $this->label_plural])
            ->andFilterWhere(['like', 'help', $this->help]);

        return $dataProvider;
    }
}
