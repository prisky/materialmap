<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Newsletter;

/**
 * NewsletterSearch represents the model behind the search form about `common\models\Newsletter`.
 */
class NewsletterSearch extends Newsletter
{
    public $from_sent;
	public $to_sent;
	
    public function rules()
    {
        return [
            [['content', 'subject'], 'safe'],
			[['sent', 'from_sent', 'to_sent'], 'number']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Newsletter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('content', $this->content);
		if(!is_null($this->from_sent) && $this->from_sent != '') $query->andWhere('`sent` >= :from_sent', [':from_sent' => $this->from_sent]);
		if(!is_null($this->to_sent) && $this->to_sent != '') $query->andWhere('`sent` <= :to_sent', [':to_sent' => $this->to_sent]);
		$query->andFilterGoogleStyle('subject', $this->subject);
		
        return $dataProvider;
    }
}
