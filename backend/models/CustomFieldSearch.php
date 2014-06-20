<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\CustomField;

/**
 * CustomFieldSearch represents the model behind the search form about `common\models\CustomField`.
 */
class CustomFieldSearch extends CustomField
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'allow_new', 'mandatory', 'deleted'], 'integer'],
            [['label', 'validation_type', 'data_type', 'comment', 'validation_text', 'validation_error'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = CustomField::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'allow_new' => $this->allow_new,
            'mandatory' => $this->mandatory,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'validation_type', $this->validation_type])
            ->andFilterWhere(['like', 'data_type', $this->data_type])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'validation_text', $this->validation_text])
            ->andFilterWhere(['like', 'validation_error', $this->validation_error]);

        return $dataProvider;
    }
}
