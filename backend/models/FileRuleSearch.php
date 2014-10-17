<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\FileRule;

/**
 * FileRuleSearch represents the model behind the search form about `common\models\FileRule`.
 */
class FileRuleSearch extends FileRule
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = FileRule::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterWhere(['column_id' => $this->column_id]);
        $query->andFilterGoogleStyle('validator', $this->validator);
        $query->andFilterGoogleStyle('key', $this->key);
        $query->andFilterGoogleStyle('value', $this->value);

        return $dataProvider;
    }
}
