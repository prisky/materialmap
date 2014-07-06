<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Sms;

/**
 * SmsSearch represents the model behind the search form about `common\models\Sms`.
 */
class SmsSearch extends Sms
{
    public function rules()
    {
        return [
            [['id', 'account_id', 'contact_id', 'sms_thread_id', 'outgoing'], 'integer'],
            [['sms_message', 'created'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Sms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'account_id' => $this->account_id,
            'contact_id' => $this->contact_id,
            'sms_thread_id' => $this->sms_thread_id,
            'outgoing' => $this->outgoing,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'sms_message', $this->sms_message]);

        return $dataProvider;
    }
}