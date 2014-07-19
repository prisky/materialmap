<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Bid;

/**
 * BidSearch represents the model behind the search form about `common\models\Bid`.
 */
class BidSearch extends Bid
{
    public $from_deadline;
	public $to_deadline;
	public $from_deadline;
	public $to_deadline;
	public $from_offer;
	public $to_offer;
	public $from_updated;
	public $to_updated;
	public $from_updated;
	public $to_updated;
	
    public function rules()
    {
        return [
            [['comment'], 'safe'],
			[['deadline', 'from_deadline', 'to_deadline', 'offer', 'updated', 'from_updated', 'to_updated'], 'number'],
			[['question_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Bid::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('comment', $this->comment);
		if(!is_null($this->from_deadline) && $this->from_deadline != '') $query->andWhere('`deadline` >= :from_deadline', [':from_deadline' => $this->from_deadline]);
		if(!is_null($this->to_deadline) && $this->to_deadline != '') $query->andWhere('`deadline` <= :to_deadline', [':to_deadline' => $this->to_deadline]);
		if(!is_null($this->from_deadline) && $this->from_deadline != '') $query->andWhere('`deadline` >= :from_deadline', [':from_deadline' => $this->from_deadline]);
		if(!is_null($this->to_deadline) && $this->to_deadline != '') $query->andWhere('`deadline` <= :to_deadline', [':to_deadline' => $this->to_deadline]);
		if(!is_null($this->from_offer) && $this->from_offer != '') $query->andWhere('`offer` >= :from_offer', [':from_offer' => $this->from_offer]);
		if(!is_null($this->to_offer) && $this->to_offer != '') $query->andWhere('`offer` <= :to_offer', [':to_offer' => $this->to_offer]);
		$query->andFilterWhere(['question_id' => $this->question_id]);
		if(!is_null($this->from_updated) && $this->from_updated != '') $query->andWhere('`updated` >= :from_updated', [':from_updated' => $this->from_updated]);
		if(!is_null($this->to_updated) && $this->to_updated != '') $query->andWhere('`updated` <= :to_updated', [':to_updated' => $this->to_updated]);
		if(!is_null($this->from_updated) && $this->from_updated != '') $query->andWhere('`updated` >= :from_updated', [':from_updated' => $this->from_updated]);
		if(!is_null($this->to_updated) && $this->to_updated != '') $query->andWhere('`updated` <= :to_updated', [':to_updated' => $this->to_updated]);
		
        return $dataProvider;
    }
}
