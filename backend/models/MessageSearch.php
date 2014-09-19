<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Message;

/**
 * MessageSearch represents the model behind the search form about `common\models\Message`.
 */
class MessageSearch extends Message
{
    public $from_system;
	public $to_system;
	
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Message::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->setAttributes($params);

		$query->andFilterGoogleStyle('email_html', $this->email_html);
		$query->andFilterGoogleStyle('email_subject', $this->email_subject);
		$query->andFilterGoogleStyle('name', $this->name);
		$query->andFilterGoogleStyle('sms_text', $this->sms_text);
		if(!is_null($this->from_system) && $this->from_system != '') $query->andWhere('`system` >= :from_system', [':from_system' => $this->from_system]);
		if(!is_null($this->to_system) && $this->to_system != '') $query->andWhere('`system` <= :to_system', [':to_system' => $this->to_system]);
		
        return $dataProvider;
    }
}
