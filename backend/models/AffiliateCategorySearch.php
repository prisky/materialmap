<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\AffiliateCategory;

/**
 * AffiliateCategorySearch represents the model behind the search form about `common\models\AffiliateCategory`.
 */
class AffiliateCategorySearch extends AffiliateCategory
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'root', 'lft', 'rgt', 'level'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = AffiliateCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'root' => $this->root,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
