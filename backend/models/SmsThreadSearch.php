<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\SmsThread;

/**
 * SmsThreadSearch represents the model behind the search form about `common\models\SmsThread`.
 */
class SmsThreadSearch extends SmsThread
{
    public function rules()
    {
        return [
            [['id', 'account_id'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = SmsThread::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
        ]);

        return $dataProvider;
    }
}