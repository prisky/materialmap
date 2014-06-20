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
            [['id', 'model_id'], 'integer'],
            [['name', 'label', 'help'], 'safe'],
        ];
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

        $query->andFilterWhere([
            'id' => $this->id,
            'model_id' => $this->model_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'help', $this->help]);

        return $dataProvider;
    }
}
