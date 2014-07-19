<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Sms;

/**
 * SmsSearch represents the model behind the search form about `common\models\Sms`.
 */
class SmsSearch extends Sms
{
    public $from_outgoing;
	public $to_outgoing;
	
    public function rules()
    {
        return [
            [['contact_id', 'sms_thread_id'], 'integer'],
			[['outgoing'], 'boolean'],
			[['sms_message'], 'safe']        ];
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

		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		if(!is_null($this->from_outgoing) && $this->from_outgoing != '') $query->andWhere('`outgoing` >= :from_outgoing', [':from_outgoing' => $this->from_outgoing]);
		if(!is_null($this->to_outgoing) && $this->to_outgoing != '') $query->andWhere('`outgoing` <= :to_outgoing', [':to_outgoing' => $this->to_outgoing]);
		$query->andFilterGoogleStyle('sms_message', $this->sms_message);
		$query->andFilterWhere(['sms_thread_id' => $this->sms_thread_id]);
		
        return $dataProvider;
    }
}
